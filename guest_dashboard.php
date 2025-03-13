<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "guest") {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Guest Dashboard</title>
</head>
<body>
    <h2>Welcome, Guest!</h2>
    <p>You are logged in as a guest.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
