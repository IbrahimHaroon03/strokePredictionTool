<?php
include '../role_access/admin_access.php';
include '../db_config.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer
    $action = $_GET['action'];

    if ($action == 'approve') {
        $stmt = $conn->prepare("SELECT username, password, role, email, verification_token FROM pending_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 0) {
            header("Location: ../../templates/admin/approve_users.php?error=User not found");
            exit();
        }
    
        $user = $result->fetch_assoc();
        $username = $user['username'];
        $email = $user['email'];
        $token = $user['verification_token'];
    
        // Create verification link
        $verification_link = "https://w1947892.users.ecs.westminster.ac.uk/stroke_prediction_tool/SQL_PHP/authentication/verify.php?token=$token"; 
    
        // Prepare email headers
        $subject = "Verify Your Email - Stroke Prediction Tool";
        $message = "
            <h3>Hello, $username</h3>
            <p>Your account has been approved. Please verify your email to complete registration:</p>
            <a href='$verification_link'>Click here to verify</a>
        ";
        
        // Email headers for HTML email and 'From' address
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: ibrahimsignups@gmail.com" . "\r\n"; // Your 'From' email
        
        // Send email
        if (mail($email, $subject, $message, $headers)) {
            // Mark email as sent
            $updateStmt = $conn->prepare("UPDATE pending_users SET email_sent = 1 WHERE id = ?");
            $updateStmt->bind_param("i", $id);
            $updateStmt->execute();
            $updateStmt->close();

            header("Location: ../../templates/admin/approve_users.php?status=verification_sent");
        } else {
            echo "Error: Failed to send email.";
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