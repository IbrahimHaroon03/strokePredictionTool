<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../../templates/all/login.php");
    exit();
}

$allowed_roles = ['patient']; 

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // Redirect to a default page if role is not allowed
    header("Location: ../../templates/patient/patient_dashboard.php");
    exit();
}
?>