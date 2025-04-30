<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {

    include '../QL_PHP/db_config.php'; // Use your existing DB connection

    $patient_id = $_POST['patient_id'];

    // Fetch patient info
    $stmt = $conn->prepare("SELECT * FROM patientMedicalInfo WHERE id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if (!$patient) {
        echo "Patient not found.";
        exit();
    }

    // --- PREPROCESSING ---

    // Convert and encode all features required for the model
    $features = [
        floatval($patient['age']),
        intval($patient['hypertension']),
        intval($patient['heart_disease']),
        $patient['ever_married'] === 'Yes' ? 1 : 0,
        $patient['residence_type'] === 'Urban' ? 1 : 0,
        isset($patient['avg_glucose_level']) ? floatval($patient['avg_glucose_level']) : 0,
        isset($patient['bmi']) ? floatval($patient['bmi']) : 0,

        // Gender one-hot
        $patient['gender'] === 'Female' ? 1 : 0,
        $patient['gender'] === 'Male' ? 1 : 0,
        0, // gender_Other is always 0 in your DB

        // Work type one-hot
        $patient['work_type'] === 'govt_job' ? 1 : 0,
        $patient['work_type'] === 'never_worked' ? 1 : 0,
        $patient['work_type'] === 'private' ? 1 : 0,
        $patient['work_type'] === 'self-employed' ? 1 : 0,
        $patient['work_type'] === 'children' ? 1 : 0,

        // Smoking status one-hot
        $patient['smoking_status'] === 'unknown' ? 1 : 0,
        $patient['smoking_status'] === 'formerly_smoked' ? 1 : 0,
        $patient['smoking_status'] === 'never_smoked' ? 1 : 0,
        $patient['smoking_status'] === 'smokes' ? 1 : 0
    ];

    // --- PREDICTION REQUEST ---

    $data = json_encode(["features" => $features]);

    $ch = curl_init('https://strokepredictiontool.onrender.com/predict');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (!isset($result['stroke_probability'])) {
        echo "Prediction failed. API error.";
        exit();
    }

    $stroke_probability = $result['stroke_probability'];

    // --- UPDATE DB WITH RESULT ---

    $update = $conn->prepare("UPDATE patientMedicalInfo SET stroke = ? WHERE id = ?");
    $update->bind_param("di", $stroke_probability, $patient_id);
    $update->execute();

    // Redirect
    header("Location: ../templates/doctor/stroke_prediction.php");
    exit();

} else {
    echo "No patient ID received.";
}
?>
