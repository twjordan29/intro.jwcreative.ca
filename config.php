<?php
$host = 'localhost';
$user = 'root';
$pass = 'Nadroj09!';
$db = 'jwcreative';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}
?>
