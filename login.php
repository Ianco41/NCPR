<?php
ob_start();
session_start();
require "connection.php"; // Include database connection

header("Content-Type: application/json"); // Set response type to JSON

// Function to handle guest login
function handleGuestLogin($guestRole) {
    // Allowed guest roles
    $allowedGuestRoles = ["guest1", "guest2", "guest3"];

    if (!in_array($guestRole, $allowedGuestRoles)) {
        return json_encode(["status" => "error", "message" => "Invalid guest role selected."]);
    }

    // Assign session variables based on selected guest role
    $_SESSION["user"] = ucfirst($guestRole); // Capitalize first letter
    $_SESSION["role"] = $guestRole;

    // Redirect page based on role
    $redirectPages = [
        "guest_ncprfiling.php"
    ];
    
    return json_encode([
        "status" => "success",
        "message" => "Guest has successfully logged in.",
        "redirect" => $redirectPages[$guestRole] ?? "guest_ncprfiling.php"
    ]);
}

// Function to handle admin login
function handleAdminLogin($username, $password, $conn) {
    if (empty($username) || empty($password)) {
        return json_encode(["status" => "error", "message" => "Username or password cannot be empty."]);
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
        return json_encode(["status" => "error", "message" => "User not found."]);
    }

    // Bind the result to variables
    $stmt->bind_result($hashed_password, $role_name);
    $stmt->fetch();

    if (empty($role_name)) {
        return json_encode(["status" => "error", "message" => "Role not found."]);
    }

    // Verify password
    if (password_verify($password, $hashed_password)) {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $role_name;

        // Return based on role
        $redirectPages = [
            "STAFF" => "admin_dashboard.php",
            "ADMIN" => "admin_dashboard.php",
            "ENGINEER" => "engineer_dashboard.php",
            "SUPERVISOR" => "admin_dashboard.php",
            "MANAGER" => "admin_dashboard.php",
            "REPRESENTATIVE" => "admin_dashboard.php",
            "SUPERADMIN" => "superadmin_dashboard.php"
        ];

        return json_encode([
            "status" => "success",
            "message" => ucfirst(strtolower($role_name)) . " has successfully logged in.",
            "redirect" => $redirectPages[$role_name] ?? "error.php"
        ]);
    } else {
        return json_encode(["status" => "error", "message" => "Incorrect Password."]);
    }

    $stmt->close();
}

// Main logic to handle request
$response = ["status" => "error", "message" => "Invalid request."];

// Guest login handling
if (isset($_POST["guest_role"]) && !empty($_POST["guest_role"])) {
    echo handleGuestLogin($_POST["guest_role"]);
    exit();
}

// Admin login handling
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    echo handleAdminLogin($_POST["username"], $_POST["password"], $conn);
    exit();
}

ob_end_flush();
?>