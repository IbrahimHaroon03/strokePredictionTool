<?php
include '../db_config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role']; 
    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(16));

    // Validate input
    if (empty($username) || empty($password) || empty($role) || empty($email)) {
        die("Please fill in all fields.");
    }

    // Check if username already exists in users or pending_users
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ? UNION SELECT id FROM pending_users WHERE username = ?");
    $checkStmt->bind_param("ss", $username, $username);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Redirect back with an error
        header("Location: ../../templates/all/sign_up.php?error=username_taken");
        exit();
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO pending_users (username, password, role, email, verification_token) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $hashed_password, $role, $email, $token);

    // Execute and check success
    if ($stmt->execute()) {
        header("Location: ../../templates/all/sign_up.php?status=success");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement & connection
    $stmt->close();
    $conn->close();
}
?>