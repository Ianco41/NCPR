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
try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set default fetch mode
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Return the connection object
    return $pdo;
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Return the connection object
return $conn;
