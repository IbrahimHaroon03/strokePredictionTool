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
    <title>View Patients</title>
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
        <h1 class="page_titles">View Patients</h1>
        <table border="1">
            <tr>
                <th><h4>ID</h4></th>
                <th><h4>Gender</h4></th>
                <th><h4>Age</h4></th>
                <th><h4>Hypertension</h4></th>
                <th><h4>Heart Disease</h4></th>
                <th><h4>Married</h4></th>
                <th><h4>Work Type</h4></th>
                <th><h4>Residence</h4></th>
                <th><h4>Glucose Level</h4></th>
                <th><h4>BMI</h4></th>
                <th><h4>Smoking Status</h4></th>
                <th><h4>Stroke Likelihood</h4></th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['gender'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['age'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['hypertension'] ?? 'N/A')?></td>
                        <td><?= htmlspecialchars($row['heart_disease'] ?? 'N/A')?></td>
                        <td><?= htmlspecialchars($row['ever_married'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['work_type'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['residence_type'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['avg_glucose_level'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['bmi'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['smoking_status'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['stroke'] ?? 'N/A') ?></td>
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
