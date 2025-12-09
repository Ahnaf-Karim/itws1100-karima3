<?php
$servername = "localhost";
$username = "karima3";
$password = "4hn4fk4r1m#";  
$dbname = "mySite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
