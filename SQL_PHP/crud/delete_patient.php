<?php
// Include database connection
include '../db_config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['patient_id'])) {
        $patient_id = intval($_POST['patient_id']);

        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM patientMedicalInfo WHERE id = ?");
        $stmt->bind_param("i", $patient_id);

        if ($stmt->execute()) {
            // Redirect back to view_patients.php with success message
            header("Location: ../../templates/doctor/delete_patients.php?success=Patient deleted successfully");
            exit();
        } else {
            // Redirect back with an error message
            header("Location: ../../templates/doctor/delete_patients.php?error=Failed to delete patient");
            exit();
        }
    } else {
        header("Location: ../../templates/doctor/delete_patients.php?error=Invalid patient ID");
        exit();
    }
} else {
    header("Location: ../../templates/doctor/delete_patients.php");
    exit();
}
?>
