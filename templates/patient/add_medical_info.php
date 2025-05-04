<?php include '../../SQL_PHP/role_access/patient_access.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <link rel="stylesheet" href="../../static/add_patient_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>Add Patients</title>
</head>
<body>
    <!-- Side Navbar -->
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

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page_titles">Add Patient</h1>
        <section id="section1">
            <form action="../../SQL_PHP/crud/add_medical_info.php" method="post">
                <!-- Gender -->
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <br>
                <!-- Age -->
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
                <br>
                <!-- Hypertension -->
                <label for="hypertension">Hypertension:</label>
                <select id="hypertension" name="hypertension" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <br>
                <!-- Heart Disease -->
                <label for="heart_disease">Heart Disease:</label>
                <select id="heart_disease" name="heart_disease" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <br>
                <!-- Ever Married -->
                <label for="ever_married">Ever Married:</label>
                <select id="ever_married" name="ever_married" required>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
                <br>
                <!-- Work Type -->
                <label for="work_type">Work Type:</label>
                <select id="work_type" name="work_type" required>
                    <option value="children">Children</option>
                    <option value="govt_job">Government Job</option>
                    <option value="never_worked">Never Worked</option>
                    <option value="private">Private</option>
                    <option value="self-employed">Self-Employed</option>
                </select>
                <br>
                <!-- Residence Type -->
                <label for="residence_type">Residence Type:</label>
                <select id="residence_type" name="residence_type" required>
                    <option value="Rural">Rural</option>
                    <option value="Urban">Urban</option>
                </select>
                <br>
                <!-- Avg Glucose Level -->
                <label for="avg_glucose_level">Average Glucose Level:</label>
                <input type="number" id="avg_glucose_level" name="avg_glucose_level" step="0.01" required>
                <br>
                <!-- BMI -->
                <label for="bmi">Body Mass Index (BMI):</label>
                <input type="number" id="bmi" name="bmi" step="0.1" required>
                <br>
                <!-- Smoking Status -->
                <label for="smoking_status">Smoking Status:</label>
                <select id="smoking_status" name="smoking_status" required>
                    <option value="never_smoked">Never Smoked</option>
                    <option value="formerly_smoked">Formerly Smoked</option>
                    <option value="smokes">Smokes</option>
                    <option value="unknown">Unknown</option>
                </select>
                <br>
        
                <button type="submit">Submit</button>
            </form>
        </section>

    </div>
</body>