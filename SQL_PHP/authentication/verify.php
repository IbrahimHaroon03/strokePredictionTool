<?php
include '../db_config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT * FROM pending_users WHERE verification_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        $id = $user['id'];
        $username = $user['username'];
        $password = $user['password'];
        $role = $user['role'];
        $email = $user['email'];

        // Move to users table
        $stmt2 = $conn->prepare("INSERT INTO users (username, password, role, email) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("ssss", $username, $password, $role, $email);
        $stmt2->execute();
        $stmt2->close();

        // Create patientMedicalInfo row if patient
        if ($role === 'patient') {
            $stmt3 = $conn->prepare("INSERT INTO patientMedicalInfo (id) VALUES (?)");
            $stmt3->bind_param("i", $id);
            $stmt3->execute();
            $stmt3->close();
        }

        // Remove from pending_users
        $stmt4 = $conn->prepare("DELETE FROM pending_users WHERE id = ?");
        $stmt4->bind_param("i", $id);
        $stmt4->execute();
        $stmt4->close();

        header("Location: logout.php");  
        exit();
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}
?>
