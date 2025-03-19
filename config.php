<?php
session_start();

// Define dashboard redirections for each role
$role_dashboard = [
    "SUPERADMIN" => "superadmin_dashboard.php",
    "ADMIN" => "admin_dashboard.php",
    "STAFF" => "admin_dashboard.php",
    "ENGINEER" => "engineer_dashboard.php",
    "SUPERVISOR" => "supervisor_dashboard.php",
    "MANAGER" => "manager_dashboard.php",
    "REPRESENTATIVE" => "representative_dashboard.php",
    "GUEST" => "guest_dashboard.php"
];

// Define access control for pages
$page_roles = [
    "superadmin_dashboard.php" => ["SUPERADMIN"],
    "admin_dashboard.php" => ["STAFF", "ADMIN", "SUPERADMIN"],
    "engineer_dashboard.php" => ["ENGINEER", "SUPERVISOR", "SUPERADMIN"],
    "supervisor_dashboard.php" => ["SUPERVISOR", "SUPERADMIN"],
    "manager_dashboard.php" => ["MANAGER", "SUPERADMIN"],
    "representative_dashboard.php" => ["REPRESENTATIVE", "SUPERADMIN"],
    "guest_dashboard.php" => ["GUEST"]
];

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);

// If logged in and on an entry page, redirect to the respective dashboard
$entry_pages = ["index.php", "loginform.php"]; // Adjust based on your setup

if (isset($_SESSION["role"]) && in_array($current_page, $entry_pages)) {
    if (isset($role_dashboard[$_SESSION["role"]])) {
        header("Location: " . $role_dashboard[$_SESSION["role"]]);
        exit();
    }
}

// Restrict access if the user role is not allowed on the current page
if (isset($page_roles[$current_page])) {
    if (!isset($_SESSION["role"]) || !in_array($_SESSION["role"], $page_roles[$current_page])) {
        header("Location: unauthorized.php");
        exit();
    }
}
?>
