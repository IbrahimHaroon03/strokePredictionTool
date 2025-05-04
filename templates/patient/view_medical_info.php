<?php
// Include database connection
include '../../SQL_PHP/db_config.php'; 
include '../../SQL_PHP/role_access/patient_access.php';
include '../../SQL_PHP/additional_features/visual_indicators.php';

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
    <link rel="stylesheet" href="../../static/table_styles.css">
    <link rel="stylesheet" href="../../static/toggle_styles.css">
    <script src="../../static/active.js" defer></script>
    <script src="../../static/toggle_visuals.js" defer></script>
    <title>My Medical Info</title>
</head>
<body>
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li><a href="patient_home.php">Home</a></li>
            <li><a href="add_medical_info.php">Add Medical Info</a></li>
            <li><a href="view_medical_info.php">My Medical Info</a></li>
            <li><a href="update_form.php">Update My Medical Info</a></li>
            <li><a href="../../SQL_PHP/authentication/logout.php">Sign Out</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <h1 class="page_titles">My Medical Info</h1>

        <label>
            <input type="checkbox" id="toggleIndicators" checked>
            Show Visual Indicators
        </label>

        <table border="1">
            <tr>
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
            </tr>
            <?php if ($patient): ?>
                <tr>
                    <td><?= htmlspecialchars($patient['gender'] ?? 'N/A') ?></td>
                    <?= style_age_cell(htmlspecialchars($patient['age'] ?? 'N/A')) ?>
                    <?= style_heart_and_hyper_cell(htmlspecialchars($patient['hypertension'] ? 'Yes' : 'No')) ?>
                    <?= style_heart_and_hyper_cell(htmlspecialchars($patient['heart_disease'] ? 'Yes' : 'No')) ?>
                    <td><?= htmlspecialchars($patient['ever_married'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($patient['work_type'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($patient['residence_type'] ?? 'N/A') ?></td>
                    <?= style_glucose_cell(htmlspecialchars($patient['avg_glucose_level'] ?? 'N/A')) ?>
                    <?= style_bmi_cell(htmlspecialchars($patient['bmi'] ?? 'N/A')) ?>
                    <?= style_smoking_cell(htmlspecialchars($patient['smoking_status'] ?? 'N/A')) ?>
                    <?= style_stroke_cell(htmlspecialchars($patient['stroke'] ?? 'N/A')) ?>
                </tr>
            <?php else: ?>
                <tr><td colspan="11">No medical records found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
// Close connection
$stmt->close();
$conn->close();
?>
