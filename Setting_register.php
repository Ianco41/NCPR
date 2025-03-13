<?php
ob_start();
session_start();
require_once "connection.php"; // Ensure database connection

header("Content-Type: application/json"); // Set response type to JSON

$response = ["status" => "error", "message" => "Invalid request."];

// Handle Fetching User Accounts (For AJAX)
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $result = $conn->query("SELECT id, username, role FROM users ORDER BY id ASC");

        $accounts = [];
        while ($row = $result->fetch_assoc()) {
            $accounts[] = $row;
        }

        echo json_encode($accounts);
        exit;
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
        exit;
    }
}

// Handle Adding a New User (For Form Submission)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "add_user") {
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $role = trim($_POST["role"] ?? "");

    // Basic validation
    if (empty($username) || empty($password) || empty($role)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "Username already exists."]);
            exit();
        }
        $stmt->close();

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Account successfully created!", "redirect" => "SuperAdmin_dashboard.php"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to create account."]);
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
    }
}

ob_end_flush();
?>
