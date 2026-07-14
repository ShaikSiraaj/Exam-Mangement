<?php
// Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_management";

// Disable mysqli SQL exceptions for compatibility with PHP 8.1+
mysqli_report(MYSQLI_REPORT_OFF);

// Create connection
$db = @mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$db) {
    $current_page = basename($_SERVER['PHP_SELF'] ?? '');
    if ($current_page !== 'index.php' && $current_page !== 'login.php') {
        die("Database Connection Failed: " . mysqli_connect_error());
    }
} else {
    // Set character set to utf8mb4
    mysqli_set_charset($db, "utf8mb4");
}
?>
