<?php
$servername = "localhost";
$username = "root";       // default XAMPP username
$password = "";           // default XAMPP password (blank)
$dbname = "registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}
?>
