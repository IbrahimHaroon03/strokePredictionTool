<?php
include '../../SQL_PHP/db_config.php';
include '../../SQL_PHP/role_access/doctor_access.php';
include '../../SQL_PHP/additional_features/fetch_notes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Notes</title>
    <link rel="stylesheet" href="../../static/navbar_styles.css">
    <link rel="stylesheet" href="../../static/create_notes_styles.css">
    <link rel="stylesheet" href="../../static/view_notes_styles.css">
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
    <h1 class="page_titles">Notes for Patient ID: <?= htmlspecialchars($patient_id) ?></h1>

    <h3 class="table_headers">Create a Note</h3>

    <div class="form-wrapper">
        <form class="note-form" method="POST">
            <div class="form-left">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>

                <label for="note_date">Date</label>
                <input type="date" name="note_date" id="note_date" required>

                <label for="note_time">Time</label>
                <input type="time" name="note_time" id="note_time" required>

                <button type="submit">Add Note</button>
            </div>

            <div class="form-right">
                <label for="content">Note</label>
                <textarea name="content" id="content" rows="10" required></textarea>
            </div>
        </form>
    </div>

    <h3 class="table_headers">Existing Notes</h3>

    <?php while ($note = $notes->fetch_assoc()): ?>
        <div class="note-card">
            <div class="note-header">
                <span class="note-title"><?= htmlspecialchars($note['title']) ?></span>
                <span class="note-datetime">
                    <?= htmlspecialchars($note['note_date']) ?> <?= htmlspecialchars($note['note_time']) ?>
                </span>
            </div>

            <p><?= nl2br(htmlspecialchars($note['content'])) ?></p>

            <form action="edit_note.php" method="GET">
                <input type="hidden" name="note_id" value="<?= $note['note_id'] ?>">
                <input type="hidden" name="is_external" value="<?= $is_external ? '1' : '0' ?>">
                <input type="hidden" name="patient_id" value="<?= $patient_id ?>">
                <button type="submit">Edit</button>
            </form>

            <form action="../../SQL_PHP/additional_features/delete_note.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?');">
                <input type="hidden" name="note_id" value="<?= $note['note_id'] ?>">
                <input type="hidden" name="is_external" value="<?= $is_external ? '1' : '0' ?>">
                <input type="hidden" name="patient_id" value="<?= $patient_id ?>">
                <button type="submit">Delete</button>
            </form>
        </div>
    <?php endwhile; ?>

</div>
</body>
</html>

<?php $conn->close(); ?>
