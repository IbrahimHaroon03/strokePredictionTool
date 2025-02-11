<?php
// Include database connection
include '../db_config.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Check if password field is empty
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username=?, password=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $hashed_password, $role, $id);
    } else {
        $sql = "UPDATE users SET username=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $role, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../../templates/admin/update_user.php?success=User updated successfully");
        exit();
    } else {
        header("Location: ../../templates/admin/update_user.php?error=Failed to update user");
        exit();
    }
} else {
    header("Location: ../../templates/admin/update_user.php");
    exit();
}
?>
