<?php
ob_start();
session_start();
require_once "connection.php"; // Ensure database connection

header("Content-Type: application/json"); // Set response type to JSON

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "change_password") {
    $userId = isset($_POST["userId"]) ? intval($_POST["userId"]) : 0;
    $newPassword = trim($_POST["newPassword"] ?? "");
    

    if ($userId <= 0 || empty($newPassword)) {
        echo json_encode(["status" => "error", "message" => "User ID and new password are required."]);
        exit;
    }

    // Enforce password policy (e.g., min 8 chars, 1 uppercase, 1 number, 1 special character)
    /*if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $newPassword)) {
        echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters, include 1 uppercase letter, 1 number, and 1 special character."]);
        exit;
    }*/

    // Hash the new password securely
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    try {
        // Verify if user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            echo json_encode(["status" => "error", "message" => "User not found."]);
            exit;
        }

        $stmt->close();

        // Update the password
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Password updated successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update password."]);
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
    }
}

ob_end_flush();
?>
