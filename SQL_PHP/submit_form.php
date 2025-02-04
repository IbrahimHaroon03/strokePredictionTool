<?php
// Database connection
$host = 'phpmyadmin.ecs.westminster.ac.uk';
$dbname = 'w1947892_0';
$username = 'w1947892';
$password = 'CTKqM5YRZiC0';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";

// Close the connection
$conn->close();

?>