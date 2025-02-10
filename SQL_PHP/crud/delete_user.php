<?php
// Include database connection
include '../db_config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        $patient_id = intval($_POST['id']);

        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $patient_id);

        if ($stmt->execute()) {
            // Redirect back to view_patients.php with success message
            header("Location: ../../templates/admin/delete_user.php?success=User deleted successfully");
            exit();
        } else {
            // Redirect back with an error message
            header("Location: ../../templates/admin/delete_user.php?error=Failed to delete User");
            exit();
        }
    } else {
        header("Location: ../../templates/admin/delete_user.php?error=Invalid User ID");
        exit();
    }
} else {
    header("Location: ../../templates/admin/delete_user.php");
    exit();
}
?>
