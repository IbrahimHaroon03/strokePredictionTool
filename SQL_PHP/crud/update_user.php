<?php
// Include database connection
include '../db_config.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Fetch current role to check if the user was previously a patient
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentRole = null;
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $currentRole = $user['role'];
    }
    $stmt->close();

    // Check if password field is empty
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username=?, password=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $hashed_password, $role, $id);
    } else {
        $sql = "UPDATE users SET username=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $role, $id);
    }

    if ($stmt->execute()) {
        // Handle adding/removing the user from the patientMedicalInfo table based on role change
        if ($currentRole === 'patient' && $role !== 'patient') {
            // User was a patient and their role has changed (remove from patientMedicalInfo)
            $stmt2 = $conn->prepare("DELETE FROM patientMedicalInfo WHERE id = ?");
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
            $stmt2->close();
        }

        if ($currentRole !== 'patient' && $role === 'patient') {
            // User was not a patient and is now a patient (add to patientMedicalInfo)
            $stmt2 = $conn->prepare("INSERT INTO patientMedicalInfo (id) VALUES (?)");
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
            $stmt2->close();
        }

        // Redirect with success message
        header("Location: ../../templates/admin/update_user.php?success=User updated successfully");
        exit();
    } else {
        // Redirect with error message if update fails
        header("Location: ../../templates/admin/update_user.php?error=Failed to update user");
        exit();
    }
} else {
    // Redirect if the form was not submitted properly
    header("Location: ../../templates/admin/update_user.php");
    exit();
}
?>
