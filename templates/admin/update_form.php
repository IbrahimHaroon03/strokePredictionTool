<?php
// Include database connection
include '../../SQL_PHP/db_config.php'; 
include '../../SQL_PHP/role_access/admin_access.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$patient = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <link rel="stylesheet" href="../../static/add_patient_styles.css">
    <link rel="stylesheet" href="../../static/update_form.css">
    <script src="../../static/active.js" defer></script>

    <title>Edit User</title>
</head>
<body>
        <!-- Side Navbar -->
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
        <h1 class="page_titles">Update User</h1>
        <form method="POST" action="../../SQL_PHP/crud/update_user.php" onsubmit="return confirm('Are you sure you want to update this user?');">
            <input type="hidden" name="id" value="<?= htmlspecialchars($patient['id']) ?>">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($patient['username']) ?>" required>

            <label for="password">Password (Leave blank to keep current password)</label>
            <input type="password" id="password" name="password">

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="admin" <?= $patient['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="doctor" <?= $patient['role'] == 'doctor' ? 'selected' : '' ?>>Doctor</option>
                <option value="patient" <?= $patient['role'] == 'patient' ? 'selected' : '' ?>>Patient</option>
            </select>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>