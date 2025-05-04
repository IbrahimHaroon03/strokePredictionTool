<?php
// Include database connection
include '../../SQL_PHP/db_config.php'; 
include '../../SQL_PHP/role_access/patient_access.php';

$user_id = $_SESSION['user_id']; // Get patient ID from session

// Fetch the patient's medical info using a prepared statement
$sql = "SELECT * FROM patientMedicalInfo WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc(); // Fetch single row
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <link rel="stylesheet" href="../../static/add_patient_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>Update Patients</title>
</head>
<body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li><a href="patient_home.php">Home</a></li>
            <li><a href="add_medical_info.php">Add Medical Info</a></li>
            <li><a href="view_medical_info.php">My Medical Info</a></li>
            <li><a href="update_info.php">Update My Medical Info</a></li>
            <li><a href="../../SQL_PHP/authentication/logout.php">Sign Out</a></li>
        </ul>
    </nav>

 <!-- Main Content -->
 <div class="main-content">
        <h1 class="page_titles">Update My Medical Info</h1>
        <section id="section1">
            <form action="../../SQL_PHP/crud/patient_user_update.php" method="post">
                <!-- Gender -->
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?= ($patient['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($patient['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
                <br>
                
                <!-- Age -->
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?= htmlspecialchars($patient['age']) ?>" required>
                <br>

                <!-- Hypertension -->
                <label for="hypertension">Hypertension:</label>
                <select id="hypertension" name="hypertension" required>
                    <option value="0" <?= ($patient['hypertension'] == 0) ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= ($patient['hypertension'] == 1) ? 'selected' : '' ?>>Yes</option>
                </select>
                <br>

                <!-- Heart Disease -->
                <label for="heart_disease">Heart Disease:</label>
                <select id="heart_disease" name="heart_disease" required>
                    <option value="0" <?= ($patient['heart_disease'] == 0) ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= ($patient['heart_disease'] == 1) ? 'selected' : '' ?>>Yes</option>
                </select>
                <br>

                <!-- Ever Married -->
                <label for="ever_married">Ever Married:</label>
                <select id="ever_married" name="ever_married" required>
                    <option value="No" <?= ($patient['ever_married'] == 'No') ? 'selected' : '' ?>>No</option>
                    <option value="Yes" <?= ($patient['ever_married'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
                </select>
                <br>

                <!-- Work Type -->
                <label for="work_type">Work Type:</label>
                <select id="work_type" name="work_type" required>
                    <option value="children" <?= ($patient['work_type'] == 'children') ? 'selected' : '' ?>>Children</option>
                    <option value="govt_job" <?= ($patient['work_type'] == 'govt_job') ? 'selected' : '' ?>>Government Job</option>
                    <option value="never_worked" <?= ($patient['work_type'] == 'never_worked') ? 'selected' : '' ?>>Never Worked</option>
                    <option value="private" <?= ($patient['work_type'] == 'private') ? 'selected' : '' ?>>Private</option>
                    <option value="self-employed" <?= ($patient['work_type'] == 'self-employed') ? 'selected' : '' ?>>Self-Employed</option>
                </select>
                <br>

                <!-- Residence Type -->
                <label for="residence_type">Residence Type:</label>
                <select id="residence_type" name="residence_type" required>
                    <option value="Rural" <?= ($patient['residence_type'] == 'Rural') ? 'selected' : '' ?>>Rural</option>
                    <option value="Urban" <?= ($patient['residence_type'] == 'Urban') ? 'selected' : '' ?>>Urban</option>
                </select>
                <br>

                <!-- Avg Glucose Level -->
                <label for="avg_glucose_level">Average Glucose Level:</label>
                <input type="number" id="avg_glucose_level" name="avg_glucose_level" step="0.01" value="<?= htmlspecialchars($patient['avg_glucose_level']) ?>" required>
                <br>

                <!-- BMI -->
                <label for="bmi">Body Mass Index (BMI):</label>
                <input type="number" id="bmi" name="bmi" step="0.1" value="<?= htmlspecialchars($patient['bmi']) ?>" required>
                <br>

                <!-- Smoking Status -->
                <label for="smoking_status">Smoking Status:</label>
                <select id="smoking_status" name="smoking_status" required>
                    <option value="never_smoked" <?= ($patient['smoking_status'] == 'never_smoked') ? 'selected' : '' ?>>Never Smoked</option>
                    <option value="formerly_smoked" <?= ($patient['smoking_status'] == 'formerly_smoked') ? 'selected' : '' ?>>Formerly Smoked</option>
                    <option value="smokes" <?= ($patient['smoking_status'] == 'smokes') ? 'selected' : '' ?>>Smokes</option>
                    <option value="unknown" <?= ($patient['smoking_status'] == 'unknown') ? 'selected' : '' ?>>Unknown</option>
                </select>
                <br>
        
                <button type="submit">Update</button>
            </form>
        </section>
    </div>
</body>