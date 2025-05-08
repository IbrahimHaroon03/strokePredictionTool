<?php
include '../../SQL_PHP/db_config.php';
include '../../SQL_PHP/role_access/doctor_access.php';
include '../../SQL_PHP/additional_features/edit_note.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Note</title>
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <link rel="stylesheet" href="../../static/create_notes_styles.css">
    <script src="../../static/active.js" defer></script>
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
        <h1 class="page_titles">Edit Note</h1>

            <div class="form-wrapper">
                <form class="note-form" method="POST">
                    <div class="form-left">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>

                        <label for="note_date">Date</label>
                        <input type="date" name="note_date" value="<?= $note['note_date'] ?>" required>

                        <label for="note_time">Time</label>
                        <input type="time" name="note_time" value="<?= $note['note_time'] ?>" required>

                        <button type="submit">Update Note</button>
                    </div>

                    <div class="form-right">
                        <label for="content">Note</label>
                        <textarea name="content" id="content" required><?= htmlspecialchars($note['content']) ?></textarea>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>