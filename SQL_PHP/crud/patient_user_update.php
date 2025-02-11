<?php
session_start();
include '../db_config.php'; // Ensure you have a database connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../templates/all/sign_in.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get patient ID from session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $hypertension = $_POST['hypertension'];
    $heart_disease = $_POST['heart_disease'];
    $ever_married = $_POST['ever_married'];
    $work_type = $_POST['work_type'];
    $residence_type = $_POST['residence_type'];
    $avg_glucose_level = $_POST['avg_glucose_level'];
    $bmi = $_POST['bmi'];
    $smoking_status = $_POST['smoking_status'];

    // Check if patient already has medical info
    $check_query = "SELECT id FROM patientMedicalInfo WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // If record exists, update the existing one
        $update_query = "UPDATE patientMedicalInfo 
                         SET gender=?, age=?, hypertension=?, heart_disease=?, ever_married=?, 
                             work_type=?, residence_type=?, avg_glucose_level=?, bmi=?, smoking_status=? 
                         WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("siissssddsi", $gender, $age, $hypertension, $heart_disease, $ever_married, 
                                           $work_type, $residence_type, $avg_glucose_level, $bmi, $smoking_status, $user_id);
    } 

    if ($stmt->execute()) {
        header("Location: ../../templates/patient/update_info.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>