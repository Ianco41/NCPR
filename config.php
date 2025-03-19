<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user"]) || !isset($_SESSION["role"])) {
    header("Location: loginform.php");
    exit();
}

// Define dashboard access for each role
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

// Restrict access if the role is not allowed
if (isset($page_roles[$current_page]) && !in_array($_SESSION["role"], $page_roles[$current_page])) {
    header("Location: unauthorized.php");
    exit();
}
?>

