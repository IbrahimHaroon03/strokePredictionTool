<?php
session_start(); // Start the session to check login status

// Check if the user is logged in by verifying session data
if (isset($_SESSION['user'])) {
    // Redirect based on the user's role if already logged in
    $user = $_SESSION['user']; // Get user data from session

    if ($user['role'] == 'admin') {
        header("Location: ../../templates/admin/admin_dashboard.php");
        exit; // Stop further execution after redirect
    } elseif ($user['role'] == 'doctor') {
        header("Location: ../../templates/doctor/doctor_dashboard.php");
        exit;
    } elseif ($user['role'] == 'patient') {
        header("Location: ../../templates/patient/patient_dashboard.php");
        exit;
    }
}
?>