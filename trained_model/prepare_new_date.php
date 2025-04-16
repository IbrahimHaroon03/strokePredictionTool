<?php
include '../SQL_PHP/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {
    $patient_id = intval($_POST['patient_id']);

    // 1. Fetch patient data
    $stmt = $conn->prepare("SELECT * FROM patientMedicalInfo WHERE id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if ($patient) {
        // 2. Format patient data for the model
        $formatted = [
            'age' => (int)$patient['age'],
            'hypertension' => (int)$patient['hypertension'],
            'heart_disease' => (int)$patient['heart_disease'],
            'ever_married' => $patient['ever_married'] === 'Yes' ? 1 : 0,
            'Residence_type' => $patient['residence_type'] === 'Urban' ? 1 : 0,
            'avg_glucose_level' => (float)$patient['avg_glucose_level'],
            'bmi' => (float)$patient['bmi'],

            // One-hot encoded fields
            'gender_Female' => $patient['gender'] === 'Female' ? 1 : 0,
            'gender_Male' => $patient['gender'] === 'Male' ? 1 : 0,
            'gender_Other' => 0,

            'work_type_children' => $patient['work_type'] === 'children' ? 1 : 0,
            'work_type_govt_job' => $patient['work_type'] === 'govt_job' ? 1 : 0,
            'work_type_never_worked' => $patient['work_type'] === 'never_worked' ? 1 : 0,
            'work_type_private' => $patient['work_type'] === 'private' ? 1 : 0,
            'work_type_self-employed' => $patient['work_type'] === 'self-employed' ? 1 : 0,

            'smoking_status_formerly_smoked' => $patient['smoking_status'] === 'formerly_smoked' ? 1 : 0,
            'smoking_status_never_smoked' => $patient['smoking_status'] === 'never_smoked' ? 1 : 0,
            'smoking_status_smokes' => $patient['smoking_status'] === 'smokes' ? 1 : 0,
            'smoking_status_unknown' => $patient['smoking_status'] === 'unknown' ? 1 : 0
        ];

        // 3. Convert to JSON for Python
        $json_data = escapeshellarg(json_encode($formatted));

        // 4. Call the Python script
        $command = "python3 predict_new_data.py $json_data";
        $output = shell_exec($command);
        $stroke_percent = floatval(trim($output));

        // 5. Update stroke column in DB
        $stroke_str = $stroke_percent . '%';
        $update_stmt = $conn->prepare("UPDATE patientMedicalInfo SET stroke = ? WHERE id = ?");
        $update_stmt->bind_param("si", $stroke_str, $patient_id);
        $update_stmt->execute();

        // 6. Redirect back to stroke prediction page
        header("Location: ../templates/doctor/stroke_prediction.php");
        exit();
    } else {
        echo "Patient not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
