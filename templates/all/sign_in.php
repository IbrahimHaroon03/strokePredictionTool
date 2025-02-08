<?php
session_start(); // Start the session to check login status

// Check if the user is logged in by verifying session data
if (isset($_SESSION['user'])) {
    // Redirect based on the user's role if already logged in
    $user = $_SESSION['user']; // Get user data from session

    if ($user['role'] == 'admin') {
        header("Location: ../admin/admin_dashboard.php");
        exit; // Stop further execution after redirect
    } elseif ($user['role'] == 'doctor') {
        header("Location: ../doctor/doctor_dashboard.php");
        exit;
    } elseif ($user['role'] == 'patient') {
        header("Location: ../patient/patient_dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../static/navbar_styles.css">
        <link rel="stylesheet" href="../../static/sign_styles.css">
        <script src="../../static/active.js" defer></script>
        <title>Document</title>
    </head>
    
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li id="home"><a href="../all/index.php">Home</a></li>
            <li id="signin"><a href="../all/sign_in.php">Log In</a></li>
            <li id="signup"><a href="../all/sign_up.php">Sign Up</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <section id="section1">
            <h1 class="page_titles">Log In Page</h1>
            <form action="../../SQL_PHP/sign_in.php" method="POST">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </p>
                <p>
                    <input type="submit" value="LOGIN">
                </p>
            </form>
        </section>
    </div>
</body>

</html>