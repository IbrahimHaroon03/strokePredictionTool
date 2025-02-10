<?php include '../../SQL_PHP/role_access/doctor_access.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <script src="../../static/active.js" defer></script>
    <title>Home</title>
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

    <!-- Main Content -->
    <div class="main-content">
        <section id="section1">
            <h2>Section 1</h2>
            <p>This is the content of section 1.</p>
        </section>
        <section id="section2">
            <h2>Section 2</h2>
            <p>This is the content of section 2.</p>
        </section>
        <section id="section3">
            <h2>Section 3</h2>
            <p>This is the content of section 3.</p>
        </section>
        <section id="section4">
            <h2>Section 4</h2>
            <p>This is the content of section 4.</p>
        </section>
        <section id="section4">
            <h2>Section 5</h2>
            <p>This is the content of section 4.</p>
        </section>
        <section id="section4">
            <h2>Section 6</h2>
            <p>This is the content of section 4.</p>
        </section>
        <section id="section4">
            <h2>Section 7</h2>
            <p>This is the content of section 4.</p>
        </section>
        <section id="section4">
            <h2>Section 8</h2>
            <p>This is the content of section 4.</p>
        </section>
        <section id="section4">
            <h2>Section 9</h2>
            <p>This is the content of section 4.</p>
        </section>
    </div>
</body>

</html>