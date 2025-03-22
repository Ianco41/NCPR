<?php
ob_start();
session_start();
require "connection.php"; // Database connection

header("Content-Type: application/json"); // Set response type to JSON

// Guest Login Function
function handleGuestLogin($guestRole) {
    $allowedGuestRoles = ["guest1", "guest2", "guest3"];

    if (!in_array($guestRole, $allowedGuestRoles)) {
        return json_encode(["status" => "error", "message" => "Invalid guest role selected."]);
    }

    $_SESSION["user"] = ucfirst($guestRole);
    $_SESSION["role"] = "GUEST";

    return json_encode(["status" => "success", "message" => "Guest login successful.", "redirect" => "guest_dashboard.php"]);
}

// Admin Login Function
function handleAdminLogin($username, $password, $conn) {
    if (empty($username) || empty($password)) {
        return json_encode(["status" => "error", "message" => "Username or password cannot be empty."]);
    }

    $stmt = $conn->prepare("SELECT users.password, users_roles.name FROM users 
                            JOIN users_roles ON users.role_id = users_roles.id 
                            WHERE users.username = ?");
    if (!$stmt) {
        return json_encode(["status" => "error", "message" => "Database error."]);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $role_name);

    if (!$stmt->fetch()) {
        return json_encode(["status" => "error", "message" => "User not found or incorrect credentials."]);
    }
    
    $stmt->close();

    if (!password_verify($password, $hashed_password)) {
        return json_encode(["status" => "error", "message" => "Incorrect password."]);
    }

    $_SESSION["user"] = $username;
    $_SESSION["role"] = $role_name;

    $redirectPages = [
        "SUPERADMIN" => "superadmin_dashboard.php",
        "ADMIN" => "admin_dashboard.php",
        "STAFF" => "admin_dashboard.php",
        "ENGINEER" => "engineer_dashboard.php",
        "SUPERVISOR" => "supv&mgrDashboard.php",
        "MANAGER" => "supv&mgrDashboard.php",
        "REPRESENTATIVE" => "representative_dashboard.php",
        "GUEST" => "guest_dashboard.php"
    ];

    return json_encode(["status" => "success", "message" => ucfirst(strtolower($role_name)) . " login successful.", "redirect" => $redirectPages[$role_name] ?? "error.php"]);
}

// Handle Requests
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["guest_role"])) {
        echo handleGuestLogin($_POST["guest_role"]);
        exit();
    }
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        echo handleAdminLogin($_POST["username"], $_POST["password"], $conn);
        exit();
    }
}

// Default Error Response
echo json_encode(["status" => "error", "message" => "Invalid request."]);
ob_end_flush();
?>
