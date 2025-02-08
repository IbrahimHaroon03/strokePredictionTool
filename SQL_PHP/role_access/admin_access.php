<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../../templates/all/sign_in.php");
    exit();
}

$allowed_roles = ['admin']; 

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // Redirect to a default page if role is not allowed
    header("Location: ../../templates/admin/admin_dashboard.php");
    exit();
}
?>