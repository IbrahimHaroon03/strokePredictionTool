<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../../templates/all/sign_in.php");
    exit();
}

// Define allowed role
if ($_SESSION['role'] !== 'patient') {
    // Redirect unauthorized users to their respective dashboards
    switch ($_SESSION['role']) {
        case 'doctor':
            header("Location: ../../templates/doctor/doctor_home.php");
            break;
        case 'admin':
            header("Location: ../../templates/admin/admin_home.php");
            break;
        default:
            header("Location: ../../templates/all/index.php");
    }
    exit();
}
?>