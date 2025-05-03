<?php
// Include database connection
include '../../SQL_PHP/db_config.php'; 
include '../../SQL_PHP/role_access/doctor_access.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$patient_id = intval($_GET['id']);
$sql = "SELECT * FROM externalPatientRecords WHERE id = ?";
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
    <link rel="stylesheet" href="../../static/add_patient_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>Edit Patient</title>
</head>
<body>
        <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li id="home"><a href="doctor_home.php">Home</a></li>
            <li id="add"><a href="add_patient.php">Add Patients</a></li>
            <li id="view"><a href="view_patients.php">View Patients</a></li>
            <li id="delete"><a href="delete_patients.php">Delete Patients</a></li>
            <li id="edit"><a href="update_patients.php">Update Patients</a></li>
            <li id="predict"><a href="stroke_prediction.php">Predict Stroke</a></li>
            <li id="signout"><a href="../../SQL_PHP/authentication/logout.php">Sign Out</a></li>
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
            <br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?= htmlspecialchars($patient['age']) ?>" required>
            <br>

            <label for="hypertension">Hypertension:</label>
            <select id="hypertension" name="hypertension" required>
                <option value="0" <?= $patient['hypertension'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $patient['hypertension'] == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
            <br>

            <label for="heart_disease">Heart Disease:</label>
            <select id="heart_disease" name="heart_disease" required>
                <option value="0" <?= $patient['heart_disease'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $patient['heart_disease'] == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
            <br>

            <label for="ever_married">Ever Married:</label>
            <select id="ever_married" name="ever_married" required>
                <option value="No" <?= $patient['ever_married'] == 'No' ? 'selected' : '' ?>>No</option>
                <option value="Yes" <?= $patient['ever_married'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
            </select>
            <br>

            <label for="work_type">Work Type:</label>
            <select id="work_type" name="work_type" required>
                <option value="children" <?= $patient['work_type'] == 'children' ? 'selected' : '' ?>>Children</option>
                <option value="govt_job" <?= $patient['work_type'] == 'govt_job' ? 'selected' : '' ?>>Government Job</option>
                <option value="never_worked" <?= $patient['work_type'] == 'never_worked' ? 'selected' : '' ?>>Never Worked</option>
                <option value="private" <?= $patient['work_type'] == 'private' ? 'selected' : '' ?>>Private</option>
                <option value="self-employed" <?= $patient['work_type'] == 'self-employed' ? 'selected' : '' ?>>Self-Employed</option>
            </select>
            <br>

            <label for="residence_type">Residence Type:</label>
            <select id="residence_type" name="residence_type" required>
                <option value="Rural" <?= $patient['residence_type'] == 'Rural' ? 'selected' : '' ?>>Rural</option>
                <option value="Urban" <?= $patient['residence_type'] == 'Urban' ? 'selected' : '' ?>>Urban</option>
            </select>
            <br>

            <label for="avg_glucose_level">Average Glucose Level:</label>
            <input type="number" id="avg_glucose_level" name="avg_glucose_level" value="<?= htmlspecialchars($patient['avg_glucose_level']) ?>" step="0.01" required>
            <br>

            <label for="bmi">BMI:</label>
            <input type="number" id="bmi" name="bmi" value="<?= htmlspecialchars($patient['bmi']) ?>" step="0.1" required>
            <br>

            <label for="smoking_status">Smoking Status:</label>
            <select id="smoking_status" name="smoking_status" required>
                <option value="never_smoked" <?= $patient['smoking_status'] == 'never_smoked' ? 'selected' : '' ?>>Never Smoked</option>
                <option value="formerly_smoked" <?= $patient['smoking_status'] == 'formerly_smoked' ? 'selected' : '' ?>>Formerly Smoked</option>
                <option value="smokes" <?= $patient['smoking_status'] == 'smokes' ? 'selected' : '' ?>>Smokes</option>
                <option value="unknown" <?= $patient['smoking_status'] == 'unknown' ? 'selected' : '' ?>>Unknown</option>
            </select>
            <br>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>