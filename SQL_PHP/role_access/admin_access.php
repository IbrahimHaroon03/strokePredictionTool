<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../../templates/all/sign_in.php");
    exit();
}

// Define allowed role
if ($_SESSION['role'] !== 'admin') {
    // Redirect unauthorized users to their respective dashboards
    switch ($_SESSION['role']) {
        case 'doctor':
            header("Location: ../../templates/doctor/doctor_dashboard.php");
            break;
        case 'patient':
            header("Location: ../../templates/patient/patient_dashboard.php");
            break;
        default:
            header("Location: ../../templates/all/index.php");
    }
    exit();
}
?>