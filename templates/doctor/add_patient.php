<?php include '../../SQL_PHP/role_access/doctor_access.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>Document</title>
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
            <li id="predict"><a href="stroke_prediction.php">Predict Stroke</a></li>
            <li id="signout"><a href="../../SQL_PHP/logout.php">Sign Out</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page_titles">Patient Management</h1>
        <section id="section1">
            <form action="../../SQL_PHP/crud/add_patient.php" method="post">
                <!-- Gender -->
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <br><br>
        
                <!-- Age -->
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
                <br><br>
        
                <!-- Hypertension -->
                <label for="hypertension">Hypertension:</label>
                <select id="hypertension" name="hypertension" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <br><br>
        
                <!-- Heart Disease -->
                <label for="heart_disease">Heart Disease:</label>
                <select id="heart_disease" name="heart_disease" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <br><br>
        
                <!-- Ever Married -->
                <label for="ever_married">Ever Married:</label>
                <select id="ever_married" name="ever_married" required>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
                <br><br>
        
                <!-- Work Type -->
                <label for="work_type">Work Type:</label>
                <select id="work_type" name="work_type" required>
                    <option value="children">Children</option>
                    <option value="govt_job">Government Job</option>
                    <option value="never_worked">Never Worked</option>
                    <option value="private">Private</option>
                    <option value="self-employed">Self-Employed</option>
                </select>
                <br><br>
        
                <!-- Residence Type -->
                <label for="residence_type">Residence Type:</label>
                <select id="residence_type" name="residence_type" required>
                    <option value="Rural">Rural</option>
                    <option value="Urban">Urban</option>
                </select>
                <br><br>
        
                <!-- Avg Glucose Level -->
                <label for="avg_glucose_level">Average Glucose Level:</label>
                <input type="number" id="avg_glucose_level" name="avg_glucose_level" step="0.01" required>
                <br><br>
        
                <!-- BMI -->
                <label for="bmi">Body Mass Index (BMI):</label>
                <input type="number" id="bmi" name="bmi" step="0.1" required>
                <br><br>
        
                <!-- Smoking Status -->
                <label for="smoking_status">Smoking Status:</label>
                <select id="smoking_status" name="smoking_status" required>
                    <option value="never_smoked">Never Smoked</option>
                    <option value="formerly_smoked">Formerly Smoked</option>
                    <option value="smokes">Smokes</option>
                    <option value="unknown">Unknown</option>
                </select>
                <br><br>
        
                <button type="submit">Submit</button>
            </form>
        </section>

    </div>
</body>