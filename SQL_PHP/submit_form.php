<?php
// Database connection
$host = 'phpmyadmin.ecs.westminster.ac.uk';
$dbname = 'w1947892_0';
$username = 'w1947892';
$password = 'CTKqM5YRZiC0';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role']; // Should be either 'admin' or 'user'

    // Validate input
    if (empty($username) || empty($password) || empty($role)) {
        die("Please fill in all fields.");
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $role);

    // Execute and check success
    if ($stmt->execute()) {
        echo "User registered successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement & connection
    $stmt->close();
    $conn->close();
}
?>