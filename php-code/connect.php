<?php
$servername = "localhost";
$username = "root";
$password = "Ovab2004";
$database= 'fsp_forum';

// Create connection
$conn = new mysqli($servername, $username, $password, $database, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
