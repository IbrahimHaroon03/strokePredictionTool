<?php
include '../../SQL_PHP/db_config.php';

$note_id = (int)$_GET['note_id'];
$is_external = $_GET['is_external'] == '1';
$patient_id = (int)$_GET['patient_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $note_date = $_POST['note_date'];
    $note_time = $_POST['note_time'];
    $content = $_POST['content'];

    if ($is_external) {
        $stmt = $conn->prepare("UPDATE externalPatientNotes SET title=?, note_date=?, note_time=?, content=? WHERE note_id=?");
    } else {
        $stmt = $conn->prepare("UPDATE patientNotes SET title=?, note_date=?, note_time=?, content=? WHERE note_id=?");
    }

    $stmt->bind_param("ssssi", $title, $note_date, $note_time, $content, $note_id);
    $stmt->execute();

    header("Location: ../../templates/doctor/view_notes.php?id=" . $patient_id);
    exit;
}

// Fetch the existing note
if ($is_external) {
    $stmt = $conn->prepare("SELECT * FROM externalPatientNotes WHERE note_id = ?");
} else {
    $stmt = $conn->prepare("SELECT * FROM patientNotes WHERE note_id = ?");
}
$stmt->bind_param("i", $note_id);
$stmt->execute();
$note = $stmt->get_result()->fetch_assoc();
?>
