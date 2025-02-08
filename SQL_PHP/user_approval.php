<?php
include '/role_access/admin_access.php';
include 'db_config.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        // Move user from pending_users to users
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) 
                                SELECT username, password, role FROM pending_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Delete from pending_users
        $stmt = $conn->prepare("DELETE FROM pending_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../templates/admin/approve_users.php?status=approved");
    } elseif ($action == 'deny') {
        // Just delete from pending_users
        $stmt = $conn->prepare("DELETE FROM pending_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../templates/admin/approve_users.php?status=denied");
    }
    exit();
}
?>
