<?php
// Include database connection
include '../../SQL_PHP/db_config.php';
include '../../SQL_PHP/role_access/doctor_access.php'; 
include '../../SQL_PHP/additional_features/sort.php'; 
include '../../SQL_PHP/additional_features/filter.php'; 
include '../../SQL_PHP/additional_features/visual_indicators.php';

// Fetch all patient medical info
$sql = "SELECT * FROM patientMedicalInfo $where_clause ORDER BY $sort $order";
$result = $conn->query($sql);

// Fetch all external medical records
$sql2 = "SELECT * FROM externalPatientRecords $where_clause ORDER BY $sort $order";
$result2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <link rel="stylesheet" href="../../static/table_styles.css">
    <link rel="stylesheet" href="../../static/sort_styles.css">
    <link rel="stylesheet" href="../../static/toggle_styles.css">
    <script src="../../static/active.js" defer></script>
    <script src="../../static/toggle_visuals.js" defer></script>
    
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
            <li id="predict"><a href="patient_notes.php">Patient Notes</a></li>
            <li id="signout"><a href="../../SQL_PHP/authentication/logout.php">Sign Out</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <h1 class="page_titles">Stroke Prediction</h1>
                
        <h3 class="table_headers">FILTER OPTIONS</h3>
        <?php include 'filter_form.php'; ?>
        
        <h3 class="table_headers">PATIENTS WITH ACCOUNTS</h3>

        <label>
            <input type="checkbox" id="toggleIndicators" checked>
            Show Visual Indicators
        </label>

        <table border="1" id="patientTable">
            <tr>
                <th><?= sort_column('ID', 'id', $sort, $order) ?></th>
                <th><?= sort_column('Gender', 'gender', $sort, $order) ?></th>
                <th><?= sort_column('Age', 'age', $sort, $order) ?></th>
                <th><?= sort_column('Hypertension', 'hypertension', $sort, $order) ?></th>
                <th><?= sort_column('Heart Disease', 'heart_disease', $sort, $order) ?></th>
                <th><?= sort_column('Married', 'ever_married', $sort, $order) ?></th>
                <th><?= sort_column('Work Type', 'work_type', $sort, $order) ?></th>
                <th><?= sort_column('Residence', 'residence_type', $sort, $order) ?></th>
                <th><?= sort_column('Glucose Level', 'avg_glucose_level', $sort, $order) ?></th>
                <th><?= sort_column('BMI', 'bmi', $sort, $order) ?></th>
                <th><?= sort_column('Smoking Status', 'smoking_status', $sort, $order) ?></th>
                <th><?= sort_column('Stroke Likelihood', 'stroke', $sort, $order) ?></th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['gender'] ?? 'N/A') ?></td>
                        <?= style_age_cell(htmlspecialchars($row['age'] ?? 'N/A')) ?>
                        <?= style_heart_and_hyper_cell($row['hypertension'] == '1' ? 'Yes' : ($row['hypertension'] == '0' ? 'No' : 'N/A'))?>
                        <?= style_heart_and_hyper_cell($row['heart_disease'] == '1' ? 'Yes' : ($row['heart_disease'] == '0' ? 'No' : 'N/A'))?>
                        <td><?= htmlspecialchars($row['ever_married'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['work_type'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row['residence_type'] ?? 'N/A') ?></td>
                        <?= style_glucose_cell(htmlspecialchars($row['avg_glucose_level'] ?? 'N/A')) ?>
                        <?= style_bmi_cell(htmlspecialchars($row['bmi'] ?? 'N/A')) ?>
                        <?= style_smoking_cell(htmlspecialchars($row['smoking_status'] ?? 'N/A')) ?>
                        <?= style_stroke_cell(htmlspecialchars($row['stroke'] ?? 'N/A')) ?>
                        <td>
                            <form method="POST" action="../../trained_model/fetch.php" onsubmit="return confirm('Please Confirm');">
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

        <h3 class="table_headers">EXTERNAL PATIENT RECORDS</h3>
        <table border="1" id="patientTable">
            <tr>
                <th><?= sort_column('ID', 'id', $sort, $order) ?></th>
                <th><?= sort_column('Gender', 'gender', $sort, $order) ?></th>
                <th><?= sort_column('Age', 'age', $sort, $order) ?></th>
                <th><?= sort_column('Hypertension', 'hypertension', $sort, $order) ?></th>
                <th><?= sort_column('Heart Disease', 'heart_disease', $sort, $order) ?></th>
                <th><?= sort_column('Married', 'ever_married', $sort, $order) ?></th>
                <th><?= sort_column('Work Type', 'work_type', $sort, $order) ?></th>
                <th><?= sort_column('Residence', 'residence_type', $sort, $order) ?></th>
                <th><?= sort_column('Glucose Level', 'avg_glucose_level', $sort, $order) ?></th>
                <th><?= sort_column('BMI', 'bmi', $sort, $order) ?></th>
                <th><?= sort_column('Smoking Status', 'smoking_status', $sort, $order) ?></th>
                <th><?= sort_column('Stroke Likelihood', 'stroke', $sort, $order) ?></th>
            </tr>
            <?php if ($result2->num_rows > 0): ?>
                <?php while ($row2 = $result2->fetch_assoc()): ?>
                    <tr>
                    <td><?= htmlspecialchars($row2['id']) ?></td>
                        <td><?= htmlspecialchars($row2['gender'] ?? 'N/A') ?></td>
                        <?= style_age_cell(htmlspecialchars($row2['age'] ?? 'N/A')) ?>
                        <?= style_heart_and_hyper_cell($row2['hypertension'] == '1' ? 'Yes' : ($row2['hypertension'] == '0' ? 'No' : 'N/A'))?>
                        <?= style_heart_and_hyper_cell($row2['heart_disease'] == '1' ? 'Yes' : ($row2['heart_disease'] == '0' ? 'No' : 'N/A'))?>
                        <td><?= htmlspecialchars($row2['ever_married'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row2['work_type'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($row2['residence_type'] ?? 'N/A') ?></td>
                        <?= style_glucose_cell(htmlspecialchars($row2['avg_glucose_level'] ?? 'N/A')) ?>
                        <?= style_bmi_cell(htmlspecialchars($row2['bmi'] ?? 'N/A')) ?>
                        <?= style_smoking_cell(htmlspecialchars($row2['smoking_status'] ?? 'N/A')) ?>
                        <?= style_stroke_cell(htmlspecialchars($row2['stroke'] ?? 'N/A')) ?>
                        <td>
                            <form method="POST" action="../../trained_model/external_fetch.php" onsubmit="return confirm('Please Confirm');">
                                <input type="hidden" name="patient_id" value="<?= htmlspecialchars($row2['id']) ?>">
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
