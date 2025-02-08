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
            <li id="home"><a href="../all/index.php">Home</a></li>
            <li id="signin"> 
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Show login and sign-up buttons only if the user is not logged in -->
                    <a href="templates/sign_in.php"><button>Sign In</button></a>
                <?php endif; ?>
            </li>
            <li id="signup">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="templates/sign_up.php"><button>Sign Up</button></a>
                <?php endif; ?>
            </li>
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