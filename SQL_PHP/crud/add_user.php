<?php
// Include database connection
include '../db_config.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password (important for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $role);

    if ($stmt->execute()) {
        // Redirect back to the user list or another page with a success message
        header("Location: ../../templates/admin/add_user.php?success=User added successfully");
        exit();
    } else {
        // Redirect back with an error message
        header("Location: ../../templates/admin/add_user.php?error=Failed to add User");
        exit();
    }
} else {
    // If the form wasn't submitted properly, redirect to the add user page
    header("Location: ../../templates/admin/add_user.php?error=Invalid form submission");
    exit();
}
?>
