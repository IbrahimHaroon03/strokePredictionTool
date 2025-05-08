<?php

$note_id = (int)$_GET['id'];
$patient_id = (int)$_GET['patient_id'];
$is_external = isset($_GET['external']) && $_GET['external'] == 1;

$table = $is_external ? "externalPatientNotes" : "patientNotes";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $note_date = $_POST['note_date'];
    $note_time = $_POST['note_time'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE $table SET title = ?, note_date = ?, note_time = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $note_date, $note_time, $content, $note_id);
    $stmt->execute();

    header("Location: view_notes.php?id=$patient_id");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
$stmt->bind_param("i", $note_id);
$stmt->execute();
$note = $stmt->get_result()->fetch_assoc();

?>