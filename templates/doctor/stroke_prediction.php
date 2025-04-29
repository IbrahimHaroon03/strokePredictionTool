<?php
// Include database connection
include '../../SQL_PHP/db_config.php';
include '../../SQL_PHP/role_access/doctor_access.php'; 

// Fetch all patient records
$sql = "SELECT * FROM patientMedicalInfo";
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
    <title>Stroke Prediction</title>
</head>
<body>
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li id="home"><a href="doctor_home.php">Home</a></li>
            <li id="add"><a href="add_patient.php">Add Patients</a></li>
            <li id="view"><a href="view_patients.php">View Patients</a></li>
            <li id="delete"><a href="delete_patients.php">Delete Patients</a></li>
            <li id="edit"><a href="update_patients.php">Update Patients</a></li>
            <li id="predict"><a href="stroke_prediction.php">Predict Stroke</a></li>
            <li id="signout"><a href="../../SQL_PHP/logout.php">Sign Out</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <h1 class="page_titles">Stroke Prediction</h1>
        <table border="1" id="patientTable">
            <tr>
                <th>ID</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Hypertension</th>
                <th>Heart Disease</th>
                <th>Married</th>
                <th>Work Type</th>
                <th>Residence</th>
                <th>Glucose Level</th>
                <th>BMI</th>
                <th>Smoking Status</th>
                <th>Stroke Likelihood</th>
                <th>Actions</th> <!-- Added for the button -->
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['gender']) ?></td>
                        <td><?= htmlspecialchars($row['age']) ?></td>
                        <td><?= $row['hypertension'] ? 'Yes' : 'No' ?></td>
                        <td><?= $row['heart_disease'] ? 'Yes' : 'No' ?></td>
                        <td><?= htmlspecialchars($row['ever_married']) ?></td>
                        <td><?= htmlspecialchars($row['work_type']) ?></td>
                        <td><?= htmlspecialchars($row['residence_type']) ?></td>
                        <td><?= htmlspecialchars($row['avg_glucose_level']) ?></td>
                        <td><?= htmlspecialchars($row['bmi']) ?></td>
                        <td><?= htmlspecialchars($row['smoking_status']) ?></td>
                        <td id="stroke-<?= $row['id'] ?>"><?= htmlspecialchars($row['stroke'] ?? 'N/A') ?></td>
                        <td>
                            <form method="POST" action="../../trained_model/predict_patient.php" onsubmit="return confirm('Please Confirm');">
                                <input type="hidden" name="patient_id" value="<?= htmlspecialchars($row['id']) ?>">
                                <button type="submit" name="predict">Predict</button>
                            </form>

                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="13">No patient records found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
