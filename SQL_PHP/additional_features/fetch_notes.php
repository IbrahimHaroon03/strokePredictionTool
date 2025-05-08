<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enables exception handling

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$patient_id = (int)$_GET['id'];
$is_external = false;

// Check if patient_id exists in externalPatientRecords
$stmt = $conn->prepare("SELECT id FROM externalPatientRecords WHERE id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $is_external = true;
}

// Handle new note submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $note_date = $_POST['note_date'];
    $note_time = $_POST['note_time'];
    $content = $_POST['content'];

    if ($is_external) {
        $stmt = $conn->prepare("INSERT INTO externalPatientNotes (patient_id, title, note_date, note_time, content) VALUES (?, ?, ?, ?, ?)");
    } else {
        $stmt = $conn->prepare("INSERT INTO patientNotes (patient_id, title, note_date, note_time, content) VALUES (?, ?, ?, ?, ?)");
    }
    $stmt->bind_param("issss", $patient_id, $title, $note_date, $note_time, $content);
    $stmt->execute();
}

// Fetch all notes for this patient
if ($is_external) {
    $stmt = $conn->prepare("SELECT * FROM externalPatientNotes WHERE patient_id = ? ORDER BY note_date DESC, note_time DESC");
} else {
    $stmt = $conn->prepare("SELECT * FROM patientNotes WHERE patient_id = ? ORDER BY note_date DESC, note_time DESC");
}
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$notes = $stmt->get_result();

?>