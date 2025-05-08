<?php
include '../../SQL_PHP/db_config.php';
include '../../SQL_PHP/role_access/doctor_access.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note_id = (int)$_POST['note_id'];
    $is_external = $_POST['is_external'] == '1';
    $patient_id = (int)$_POST['patient_id'];

    if ($is_external) {
        $stmt = $conn->prepare("DELETE FROM externalPatientNotes WHERE note_id = ?");
    } else {
        $stmt = $conn->prepare("DELETE FROM patientNotes WHERE note_id = ?");
    }

    $stmt->bind_param("i", $note_id);
    $stmt->execute();
}

header("Location: ../../templates/doctor/view_notes.php?id=" . $patient_id);
exit;
?>
