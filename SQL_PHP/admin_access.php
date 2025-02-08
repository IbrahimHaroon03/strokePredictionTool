<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../templates/login.html");
    exit();
}

$allowed_roles = ['admin']; 

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // Redirect to a default page if role is not allowed
    header("Location: ../templates/all/index.html");
    exit();
}
?>