<?php

include 'db_config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role']; 

    // Validate input
    if (empty($username) || empty($password) || empty($role)) {
        die("Please fill in all fields.");
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO pending_users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $role);

    // Execute and check success
    if ($stmt->execute()) {
        echo "Registration request sent. Please wait for Admin approval.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement & connection
    $stmt->close();
    $conn->close();
}
?>