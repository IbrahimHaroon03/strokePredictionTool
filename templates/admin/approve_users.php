<?php
include '../../SQL_PHP/role_access/admin_access.php';
include '../../SQL_PHP/db_config.php';

// Fetch all pending users
$result = $conn->query("SELECT * FROM pending_users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <title>Approve Users</title>
</head>
<body>
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li id="home"><a href="admin_home.php">Home</a></li>
            <li id="dashboard"><a href="admin_dashboard.php">Dashboard</a></li>
            <li id="approveusers"><a href="approve_users.php">Approve New Users</a></li>
            <li id="signout"><a href="../../SQL_PHP/logout.php">Sign Out</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <h2>Pending User Approvals</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php while ($user = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="../../SQL_PHP/user_approval.php?id=<?php echo $user['id']; ?>&action=approve">Approve</a> | 
                    <a href="../../SQL_PHP/user_approval.php?id=<?php echo $user['id']; ?>&action=deny">Deny</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
