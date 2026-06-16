<?php
// Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_management";

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$db) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Set character set to utf8mb4
mysqli_set_charset($db, "utf8mb4");
?>
