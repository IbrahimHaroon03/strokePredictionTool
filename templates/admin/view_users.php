<?php
// Include database connection
include '../../SQL_PHP/db_config.php'; 
include '../../SQL_PHP/role_access/admin_access.php';

// Fetch all patient records
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
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
        <h1 class="page_titles">View Patients</h1>
        <table border="1">
            <tr>
                <th><h4>ID</h4></th>
                <th><h4>Username</h4></th>
                <th><h4>Role</h4></th>
                <th><h4>Date Approved</h4></th>

            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['role']) ?></td>
                        <td><?= htmlspecialchars($row['date_approved']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="11">No patient records found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
