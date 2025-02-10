<?php
// Include database connection
include '../db_config.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patient_id = intval($_POST['id']);
    $gender = $_POST['gender'];
    $age = intval($_POST['age']);
    $hypertension = intval($_POST['hypertension']);
    $heart_disease = intval($_POST['heart_disease']);
    $ever_married = $_POST['ever_married'];
    $work_type = $_POST['work_type'];
    $residence_type = $_POST['residence_type'];
    $avg_glucose_level = floatval($_POST['avg_glucose_level']);
    $bmi = floatval($_POST['bmi']);
    $smoking_status = $_POST['smoking_status'];

    $sql = "UPDATE patientMedicalInfo SET 
                gender=?, age=?, hypertension=?, heart_disease=?, ever_married=?, 
                work_type=?, residence_type=?, avg_glucose_level=?, bmi=?, smoking_status=? 
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiisssddss", $gender, $age, $hypertension, $heart_disease, $ever_married, 
                                  $work_type, $residence_type, $avg_glucose_level, $bmi, $smoking_status, $patient_id);

    if ($stmt->execute()) {
        header("Location: ../../templates/doctor/update_patients.php?success=Patient updated successfully");
        exit();
    } else {
        header("Location: ../../templates/doctor/update_patients.php?error=Failed to update patient");
        exit();
    }
} else {
    header("Location: ../../templates/doctor/update_patients.php");
    exit();
}
?>