<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {

    $patient_id = $_POST['patient_id'];

    // Convert the patient ID into JSON format
    $data = json_encode(["patient_id" => $patient_id]);

    // Set up a cURL request (this is like PHP's way of sending messages to other servers)
    $ch = curl_init('https://strokepredictiontool.onrender.com/predict');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // say it's a POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // attach the patient ID
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the response
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    // Execute the request and store the result
    $response = curl_exec($ch);
    curl_close($ch);

} else {
    echo "No patient ID received.";
}
?>

