<?php
include '../../SQL_PHP/role_access/admin_access.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <link rel="stylesheet" href="../../static/table_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>View Patients</title>
</head>
<body>
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li id="home"><a href="admin_home.php">Home</a></li>
            <li id="approve"><a href="approve_users.php">Approve New User</a></li>
            <li id="add"><a href="add_user.php">Add New User</a></li>
            <li id="view"><a href="view_users.php">View Users</a></li>
            <li id="update"><a href="update_user.php">Update Users</a></li>
            <li id="delete"><a href="delete_user.php">Delete Users</a></li>
            <li id="signout"><a href="../../SQL_PHP/logout.php">Sign Out</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <h1 class="page_titles">Add New User</h1>
        <form method="POST" action="../../SQL_PHP/crud/add_user.php" onsubmit="return confirm('Are you sure you want to add this user?');">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="doctor">Doctor</option>
                <option value="patient">Patient</option>
            </select>

            <button type="submit">Add User</button>
        </form>
    </div>
</body>
</html>