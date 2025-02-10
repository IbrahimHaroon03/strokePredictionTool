<?php
// Include database connection
include '../../SQL_PHP/db_config.php'; 
include '../../SQL_PHP/role_access/doctor_access.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$patient_id = intval($_GET['id']);
$sql = "SELECT * FROM patientMedicalInfo WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Patient not found.");
}

$patient = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>Edit Patient</title>
</head>
<body>
        <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li id="home"><a href="doctor_home.php">Home</a></li>
            <li id="add"><a href="add_patient.php">Add patient</a></li>
            <li id="view"><a href="view_patients.php">View Patients</a></li>
            <li id="delete"><a href="delete_patients.php">Delete Patients</a></li>
            <li id="edit"><a href="update_patients.php">Update Patients</a></li>
            <li id="predict"><a href="stroke_prediction.php">Predict Stroke</a></li>
            <li id="signout"><a href="../../SQL_PHP/logout.php">Sign Out</a></li>
        </ul>
    </nav>






    <div class="main-content">
        <h1 class="page_titles">Edit Patient Details</h1>
        <form action="../../SQL_PHP/crud/update_patient.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($patient['id']) ?>">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male" <?= $patient['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $patient['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
            </select>
            <br><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?= htmlspecialchars($patient['age']) ?>" required>
            <br><br>

            <label for="hypertension">Hypertension:</label>
            <select id="hypertension" name="hypertension" required>
                <option value="0" <?= $patient['hypertension'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $patient['hypertension'] == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
            <br><br>

            <label for="heart_disease">Heart Disease:</label>
            <select id="heart_disease" name="heart_disease" required>
                <option value="0" <?= $patient['heart_disease'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $patient['heart_disease'] == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
            <br><br>

            <label for="bmi">BMI:</label>
            <input type="number" id="bmi" name="bmi" value="<?= htmlspecialchars($patient['bmi']) ?>" step="0.1" required>
            <br><br>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
