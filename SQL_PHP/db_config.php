<?php
$host = 'phpmyadmin.ecs.westminster.ac.uk';
$dbname = 'w1947892_0';
$db_user = 'w1947892';
$db_pass = 'CTKqM5YRZiC0';

// Create connection
$conn = new mysqli($host, $db_user, $db_pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>