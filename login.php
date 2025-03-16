<?php
ob_start();
session_start();
require "connection.php"; // Include database connection

header("Content-Type: application/json"); // Set response type to JSON

$response = ["status" => "error", "message" => "Invalid request."];

// Guest login (no password needed)
if (isset($_POST["guest"])) {
    $_SESSION["user"] = "Guest";
    $_SESSION["role"] = "guest";
    echo json_encode(["status" => "success", "message" => "Guest have successfully logged in.", "redirect" => "guest_ncprfiling.php"]);
    exit();
}

// Handle admin login
if ($_SERVER["REQUEST_METHOD"] === "POST") { // Remove `isset($_POST["login"])`
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Username or password cannot be empty."]);
        exit();
    }

    // Prepare query
    $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 0) {
        echo json_encode(["status" => "error", "message" => "User not found."]);
        exit();
    }

    $stmt->bind_result($hashed_password, $role);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $role;

        if ($role === "admin") {
            echo json_encode(["status" => "success", "message" => "Admin have successfully logged in.", "redirect" => "admin_dashboard.php"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Unauthorized role."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect Password."]);
    }

    $stmt->close();
}

ob_end_flush();
?>
