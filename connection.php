<?php
$servername = "localhost"; // XAMPP default
$username = "root"; // Default username
$password = ""; // Default password (empty in XAMPP)
$database = "ncpr_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Return the connection object
return $conn;
