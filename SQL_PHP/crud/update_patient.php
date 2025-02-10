<?php
// Include database connection
include '../db_config.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patient_id = intval($_POST['id']);
    $gender = $_POST['gender'];
    $age = intval($_POST['age']);
    $hypertension = intval($_POST['hypertension']);
    $heart_disease = intval($_POST['heart_disease']);
    $bmi = floatval($_POST['bmi']);

    $sql = "UPDATE patientMedicalInfo SET gender=?, age=?, hypertension=?, heart_disease=?, bmi=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiidi", $gender, $age, $hypertension, $heart_disease, $bmi, $patient_id);

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
