<?php
session_start(); // Start the session

include 'db_config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        die("Please enter both username and password.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header("Location: ../templates/admin/admin_home.php");
            } elseif ($user['role'] == 'doctor') {
                header("Location: ../templates/doctor/doctor_home.php");
            } else {
                header("Location: ../templates/patient/patient_home.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
