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
        $user_id = $stmt->insert_id; // Get new user's ID

        // If the user is a patient, insert a blank medical record with NULL values
        if ($role === 'patient') {
            $stmt2 = $conn->prepare("INSERT INTO patientMedicalInfo (id) VALUES (?)");
            $stmt2->bind_param("i", $user_id);
            $stmt2->execute();
            $stmt2->close();
        }

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
