<?php
ob_start();
session_start();
require "connection.php"; // Include database connection

header("Content-Type: application/json"); // Set response type to JSON

$response = ["status" => "error", "message" => "Invalid request."];

// Guest login (no password needed)
if (isset($_POST["guest"]) && !empty($_POST["guest"])) {
    $guestRole = $_POST["guest"]; // Retrieve selected guest role

    // Validate the guest role (optional: ensure it's an allowed role)
    $allowedGuestRoles = ["guest1", "guest2", "guest3"];
    if (!in_array($guestRole, $allowedGuestRoles)) {
        echo json_encode(["status" => "error", "message" => "Invalid guest role selected."]);
        exit();
    }

    // Assign session variables based on selected guest role
    $_SESSION["user"] = ucfirst($guestRole); // e.g., "Guest1"
    $_SESSION["role"] = $guestRole;

    // Redirect based on the guest role (optional)
    $redirectPage = "guest_ncprfiling.php"; // Default page
    if ($guestRole === "guest2") {
        $redirectPage = "guest_dashboard.php"; // Example: Different page for guest2
    } elseif ($guestRole === "guest3") {
        $redirectPage = "guest_reports.php"; // Example: Different page for guest3
    }

    // Respond with JSON for AJAX handling
    echo json_encode(["status" => "success", "message" => "Guest has successfully logged in.", "redirect" => $redirectPage]);
    exit();
}

// Handle admin login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Username or password cannot be empty."]);
        exit();
    }

    // Prepare query to fetch user details and role
    $stmt = $conn->prepare("SELECT users.password, users_roles.name 
FROM users 
JOIN users_roles ON users.role_id = users_roles.id 
WHERE users.username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 0) {
        echo json_encode(["status" => "error", "message" => "User not found."]);
        exit();
    }

    $stmt->bind_result($hashed_password, $role_name);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $role_name;

        if ($role_name === "ADMIN" || $role_name === "STAFF") {
            echo json_encode(["status" => "success", "message" => "Admin has successfully logged in.", "redirect" => "admin_dashboard.php"]);
        } else if ($role_name === "SUPERADMIN") {
            echo json_encode(["status" => "success", "message" => "Superadmin has successfully logged in.", "redirect" => "superadmin_dashboard.php"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Unauthorized role."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect Password."]);
    }

    $stmt->close();
}


ob_end_flush();
