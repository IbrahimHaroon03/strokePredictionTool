<?php include '../../SQL_PHP/role_access/sign_access.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../static/navbar_styles.css">
        <link rel="stylesheet" href="../../static/sign_in_styles.css">
        <script src="../../static/active.js" defer></script>
        <script src="../../static/check_username_duplicate.js" defer></script>

        <title>Document</title>
    </head>

    <!-- <script>
        // Check URL for error query string
        const params = new URLSearchParams(window.location.search);

        if (params.get('error') === 'username_taken') {
            alert('Username already exists. Please choose another.');
        }

        if (params.get('status') === 'success') {
            alert('Registration successful! Please wait for Admin approval.');
        }
    </script> -->

    <body>
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
                <h1 class="page_titles">Sign up Page</h1>

                <form action="../../SQL_PHP/authentication/sign_up.php" method="POST">

                    <p>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="role">Role:</label>
                        <select id="role" name="role" required>
                            <option value="patient">Patient</option>
                            <option value="doctor">Doctor</option>
                            <option value="admin">Admin</option>
                        </select>
                    
                    </p>
                    <p>
                        <input type="submit" value="SIGN UP">
                    </p>
                </form>
            </section>
        </div>
    </body>
</html>