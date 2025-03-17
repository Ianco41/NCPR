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
    $redirectPage = "guest_ncprfiling.php"; // Default page
    if ($guestRole === "guest2") {
        $redirectPage = "guest_dashboard.php"; // Example for guest2
    } elseif ($guestRole === "guest3") {
        $redirectPage = "guest_reports.php"; // Example for guest3
    }

    // Successful guest login
    return json_encode(["status" => "success", "message" => "Guest has successfully logged in.", "redirect" => $redirectPage]);
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
    $stmt->bind_result($hashed_password, $role_name); // Ensure role_name is bound correctly
    $stmt->fetch(); // Fetch the data into the bound variables

    // Ensure $role_name is not empty before using it
    if (empty($role_name)) {
        return json_encode(["status" => "error", "message" => "Role not found."]);
    }

    // Verify password
    if (password_verify($password, $hashed_password)) {
        $_SESSION["user"] = $username;
        $_SESSION["role"] = $role_name;

        // Return based on role
        if ($role_name === "ADMIN" || $role_name === "STAFF") {
            return json_encode(["status" => "success", "message" => "Admin has successfully logged in.", "redirect" => "admin_dashboard.php"]);
        } else if ($role_name === "SUPERADMIN") {
            return json_encode(["status" => "success", "message" => "Superadmin has successfully logged in.", "redirect" => "superadmin_dashboard.php"]);
        } else {
            return json_encode(["status" => "error", "message" => "Unauthorized role."]);
        }
    } else {
        return json_encode(["status" => "error", "message" => "Incorrect Password."]);
    }

    $stmt->close();
}


// Main logic to handle request
$response = ["status" => "error", "message" => "Invalid request."];

// Guest login handling
if (isset($_POST["guest"]) && !empty($_POST["guest"])) {
    $guestRole = $_POST["guest"];
    echo handleGuestLogin($guestRole);
    exit();
}

// Admin login handling
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    echo handleAdminLogin($username, $password, $conn);
    exit();
}

ob_end_flush();
?>
