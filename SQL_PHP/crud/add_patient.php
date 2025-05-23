<?php
// Include database connection
include '../db_config.php'; // Ensure this contains a valid `$conn` connection object.

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $hypertension = $_POST['hypertension'];
    $heart_disease = $_POST['heart_disease'];
    $ever_married = $_POST['ever_married'];
    $work_type = $_POST['work_type'];
    $residence_type = $_POST['residence_type']; 
    $avg_glucose_level = $_POST['avg_glucose_level'];
    $bmi = $_POST['bmi'];
    $smoking_status = $_POST['smoking_status'];

    if ($gender === "" || $age === "" || $hypertension === "" || $heart_disease === "" || $ever_married === "" || $work_type === "" || $residence_type === "" || 
    $avg_glucose_level === "" || $bmi === "" || $smoking_status === "")
    {
        die("All fields are required.");
    }


    // Validate numeric values
    if (!is_numeric($age) || !is_numeric($hypertension) || !is_numeric($heart_disease) ||
        !is_numeric($avg_glucose_level) || !is_numeric($bmi)) {
        die("Invalid input: Age, Hypertension, Heart Disease, Avg Glucose Level, and BMI must be numbers.");
    }

    // SQL query to insert data
    $sql = "INSERT INTO externalPatientRecords (gender, age, hypertension, heart_disease, ever_married, work_type, residence_type, avg_glucose_level, bmi, smoking_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("siiisssdds", $gender, $age, $hypertension, $heart_disease, $ever_married, 
        $work_type, $residence_type, $avg_glucose_level, $bmi, $smoking_status);

        // Execute query
        if ($stmt->execute()) {
            header("Location: ../../templates/doctor/add_patient.php?success=Patient updated successfully");
            exit();
        } else {
            header("Location: ../../templates/doctor/add_patient.php?error=Failed to update patient");
            exit();
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
