<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "photography-site";  // EXACT same as phpMyAdmin

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database Failed: " . $conn->connect_error);
}
?>
