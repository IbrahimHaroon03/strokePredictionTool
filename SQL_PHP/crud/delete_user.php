<?php
// Include database connection
include '../db_config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        $patient_id = intval($_POST['id']);

        // First, fetch the user's role before deleting
        $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the role
            $user = $result->fetch_assoc();
            $role = $user['role'];

            // Proceed with deleting from the users table
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $patient_id);

            if ($stmt->execute()) {
                // If the role is 'patient', delete from patientMedicalInfo
                if ($role === 'patient') {
                    $stmt2 = $conn->prepare("DELETE FROM patientMedicalInfo WHERE id = ?");
                    $stmt2->bind_param("i", $patient_id);
                    $stmt2->execute();
                    $stmt2->close();
                }

                // Redirect back to view_patients.php with success message
                header("Location: ../../templates/admin/delete_user.php?success=User deleted successfully");
                exit();
            } else {
                // Redirect back with an error message if user deletion fails
                header("Location: ../../templates/admin/delete_user.php?error=Failed to delete User");
                exit();
            }
        } else {
            // If no user is found with the given ID
            header("Location: ../../templates/admin/delete_user.php?error=User not found");
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

