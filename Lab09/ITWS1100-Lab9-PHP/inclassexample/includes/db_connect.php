<?php
// AI-assisted: Secure database connection
$servername = "localhost";
$username = "root";  // Change to your database username
$password = "your_password";  // Change to your database password
$dbname = "mySite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>