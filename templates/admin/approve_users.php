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
    <link rel="stylesheet" href="../../static/table_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>Approve Users</title>
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
            <li id="signout"><a href="../../SQL_PHP/authentication/logout.php">Sign Out</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <section>
        <h1 class="page_titles">Pending User Approvals</h1>
            <table border="1">
                <tr>
                    <th><h3>ID</h3></th>
                    <th><h3>Username</h3></th>
                    <th><h3>Role</h3></th>
                    <th><h3>Action</h3></th>
                </tr>
                <?php while ($user = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td><?php echo $user['sent_at']; ?></td>
                    <td>            
                        <?php if ($user['email_sent']) { ?>
                            <div id = "emailsentnotif" class="button-container">
                                <button>Verification Email Sent</button> 
                            </div>
                        <?php } else { ?>
                            <div class="button-container">
                                <button onclick="location.href='../../SQL_PHP/authentication/user_approval.php?id=<?php echo $user['id']; ?>&action=approve'">Approve</button> 
                                <button onclick="location.href='../../SQL_PHP/authentication/user_approval.php?id=<?php echo $user['id']; ?>&action=deny'">Deny</button>
                            </div>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </section?
    </div>
</body>
</html>
