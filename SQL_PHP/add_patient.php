<?php
// Include database connection
include 'db_config.php'; // Make sure this file contains your connection details.

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $hypertension = $_POST['hypertension'];
    $heart_disease = $_POST['heart_disease'];
    $ever_married = $_POST['ever_married'];
    $work_type = $_POST['work_type'];
    $residence_type = $_POST['Residence_type'];
    $avg_glucose_level = $_POST['avg_glucose_level'];
    $bmi = $_POST['bmi'];
    $smoking_status = $_POST['smoking_status'];
    $stroke = $_POST['stroke'];

    // Sanitize and validate data (if necessary)
    if (empty($gender) || empty($age) || empty($hypertension) || empty($heart_disease) || empty($ever_married) || empty($work_type) || empty($residence_type) || empty($avg_glucose_level) || empty($bmi) || empty($smoking_status) || empty($stroke)) {
        die("All fields are required.");
    }

    // Insert data into the database
    $sql = "INSERT INTO patients (gender, age, hypertension, heart_disease, ever_married, work_type, Residence_type, avg_glucose_level, bmi, smoking_status, stroke)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("siiisssdss", $gender, $age, $hypertension, $heart_disease, $ever_married, $work_type, $residence_type, $avg_glucose_level, $bmi, $smoking_status, $stroke);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Data submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
