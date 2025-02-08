<?php
session_start();

// Checks if a value is null or not
if (isset($_SESSION['user_id'])) {
    // Redirect logged-in users to their appropriate dashboard
    switch ($_SESSION['role']) {
        case 'admin':
            header("Location: ../../templates/admin/admin_dashboard.php");
            break;
        case 'doctor':
            header("Location: ../../templates/doctor/doctor_dashboard.php");
            break;
        case 'patient':
            header("Location: ../../templates/patient/patient_dashboard.php");
            break;
        default:
            header("Location: sign_in.php"); // Fallback
    }
    exit();
}
?>
