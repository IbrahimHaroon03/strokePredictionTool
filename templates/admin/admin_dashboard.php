<?php include '../../SQL_PHP/role_access/admin_access.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <title>Document</title>
</head>
<body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li><a href="../all/index.php">Home</a></li>
            <li><a href="">Manage Users</a></li>
            <li><a href="">Manage Patient Database</a></li>
    </nav>

    <div class="main-content">
        <section id="section1">
            <h2>Patient Medical Data</h2>
            <?php include 'fetch_data.php'; ?> 
        </section>
    </div>

</body>

</html>