<?php
// Include your database connection
include '../SQL_PHP/db_config.php';

// Check if patient_id is provided
if (!isset($_POST['patient_id']) || empty($_POST['patient_id'])) {
    die("Invalid request: No patient ID provided.");
}

$patient_id = intval($_POST['patient_id']);

$sql = "SELECT * FROM patientMedicalInfo WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Patient not found for ID: " . $patient_id);
}

$patient = $result->fetch_assoc();

// After fetching the patient data
$patient = $result->fetch_assoc();

// Create the transformed data array with the required format
$transformed_data = [
    'age' => $patient['age'],
    'hypertension' => $patient['hypertension'],
    'heart_disease' => $patient['heart_disease'],
    'ever_married' => $patient['ever_married'] === 'Yes' ? 1 : 0,
    'Residence_type' => $patient['residence_type'] === 'Urban' ? 1 : 0,
    'avg_glucose_level' => $patient['avg_glucose_level'],
    'bmi' => $patient['bmi'],
    
    // One-hot encoding for gender
    'gender_Female' => $patient['gender'] === 'Female' ? 1 : 0,
    'gender_Male' => $patient['gender'] === 'Male' ? 1 : 0,
    'gender_Other' => 0, 
    
    // One-hot encoding for work_type
    'work_type_Govt_job' => $patient['work_type'] === 'govt_job' ? 1 : 0,
    'work_type_Never_worked' => $patient['work_type'] === 'never_worked' ? 1 : 0,
    'work_type_Private' => $patient['work_type'] === 'private' ? 1 : 0,
    'work_type_Self-employed' => $patient['work_type'] === 'self-employed' ? 1 : 0,
    'work_type_children' => $patient['work_type'] === 'children' ? 1 : 0,
    
    // One-hot encoding for smoking_status
    'smoking_status_Unknown' => $patient['smoking_status'] === 'unknown' ? 1 : 0,
    'smoking_status_formerly smoked' => $patient['smoking_status'] === 'formerly_smoked' ? 1 : 0,
    'smoking_status_never smoked' => $patient['smoking_status'] === 'never_smoked' ? 1 : 0,
    'smoking_status_smokes' => $patient['smoking_status'] === 'smokes' ? 1 : 0
];

// Convert the PHP array to JSON for passing to Python
$json_data = json_encode($transformed_data);

// Call the Python script with the JSON data
$command = "python3 https://strokepredictiontool.onrender.com '" . escapeshellarg($json_data) . "'";
$prediction_result = shell_exec($command);

// Parse the prediction result (assuming Python returns a percentage as a decimal)
$prediction_percentage = floatval(trim($prediction_result));

// Format as percentage string (e.g., "85.4%")
$formatted_prediction = number_format($prediction_percentage * 100, 1) . '%';

// Update the database with the prediction
$update_sql = "UPDATE patientMedicalInfo SET stroke = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("si", $formatted_prediction, $patient_id);
$update_stmt->execute();

// Close the statement
$update_stmt->close();

// Redirect to a different page after updating
header("Location: ../templates/doctor/stroke_prediction.php");
exit;