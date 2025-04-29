<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];

    $data = json_encode(["patient_id" => $patient_id]);

    $ch = curl_init('http://localhost:8000/predict'); // Or full URL to your API
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $decoded = json_decode($response, true);
    if (isset($decoded['success']) && $decoded['success']) {
        header("Location: view_patients.php?status=predicted");
    } else {
        header("Location: view_patients.php?error=api_failed");
    }
    exit();
}
?>
