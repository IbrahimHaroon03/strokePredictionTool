<?php

include 'db_config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role']; 

    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        die("Please fill in all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO pending_users (username, email, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

    // Execute and check success
    if ($stmt->execute()) {
        header("Location: ../templates/all/sign_up.php?");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement & connection
    $stmt->close();
    $conn->close();
}
?>