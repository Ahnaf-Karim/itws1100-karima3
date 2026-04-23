<?php
declare(strict_types=1);

$servername = 'localhost';
$username = 'karima3';
$password = '4hn4fk4r1m#';
$dbname = 'mySite';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    die('Database connection failed.');
}

$conn->set_charset('utf8mb4');
