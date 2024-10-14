<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "healthcare"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Set the charset to utf8mb4
$conn->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
