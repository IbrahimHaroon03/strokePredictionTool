<?php
include 'db_config.php'; // Include database connection

// Fetch data from the patients table
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

// Display data in a table
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Hypertension</th>
            <th>Heart Disease</th>
            <th>Ever Married</th>
            <th>Work Type</th>
            <th>Residence Type</th>
            <th>Avg Glucose Level</th>
            <th>BMI</th>
            <th>Smoking Status</th>
            <th>Stroke</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['age']}</td>
                <td>" . ($row['hypertension'] ? 'Yes' : 'No') . "</td>
                <td>" . ($row['heart_disease'] ? 'Yes' : 'No') . "</td>
                <td>{$row['ever_married']}</td>
                <td>{$row['work_type']}</td>
                <td>{$row['Residence_type']}</td>
                <td>{$row['avg_glucose_level']}</td>
                <td>{$row['bmi']}</td>
                <td>{$row['smoking_status']}</td>
                <td>" . ($row['stroke'] ? 'Yes' : 'No') . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

// Close connection
$conn->close();
?>
