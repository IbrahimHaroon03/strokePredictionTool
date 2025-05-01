<?php
include '../role_access/admin_access.php';
include '../db_config.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer
    $action = $_GET['action'];

    if ($action == 'approve') {
        // Fetch the user details from pending_users to get the role
        $stmt = $conn->prepare("SELECT username, password, role FROM pending_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            header("Location: ../../templates/admin/approve_users.php?error=User not found");
            exit();
        }

        $user = $result->fetch_assoc();
        $username = $user['username'];
        $password = $user['password'];
        $role = $user['role'];

        $stmt->close(); // Close the select statement

        // Insert user into the users table
        $stmt = $conn->prepare("INSERT INTO users (id, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id, $username, $password, $role);

        if ($stmt->execute()) {
            $stmt->close();

            // If the user is a patient, insert into patientMedicalInfo
            if ($role === 'patient') {
                $stmt2 = $conn->prepare("INSERT INTO patientMedicalInfo (id) VALUES (?)");
                $stmt2->bind_param("i", $id);
                $stmt2->execute();
                $stmt2->close();
            }

            // Delete from pending_users only after successful insertion into users
            $stmt = $conn->prepare("DELETE FROM pending_users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();

            header("Location: ../../templates/admin/approve_users.php?status=approved");
        } else {
            header("Location: ../../templates/admin/approve_users.php?error=Failed to approve user");
        }
    } elseif ($action == 'deny') {
        // Just delete from pending_users
        $stmt = $conn->prepare("DELETE FROM pending_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header("Location: ../../templates/admin/approve_users.php?status=denied");
    }
    exit();
}
?>
