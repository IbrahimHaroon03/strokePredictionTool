<?php include '../../SQL_PHP/role_access/sign_access.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../static/navbar_styles.css">
        <link rel="stylesheet" href="../../static/sign_in_styles.css">
        <script src="../../static/active.js" defer></script>
        <title>Document</title>
    </head>
    
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="navbar-title">STROKE PREDICTION TOOL</div> 
        <ul>
            <li id="home"><a href="../all/index.php">Home</a></li>
            <li id="signin"><a href="../all/sign_in.php">Sign In</a></li>
            <li id="signup"><a href="../all/sign_up.php">Sign Up</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <section id="section1">
            <h1 class="page_titles">Sign In Page</h1>
            <form action="../../SQL_PHP/authentication/sign_in.php" method="POST">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                </p>
                <p>
                    <input type="submit" value="LOGIN">
                </p>
            </form>
        </section>
    </div>
</body>

</html>