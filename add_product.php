<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $part_number = $_POST['part_number'];
    $part_name = $_POST['part_name'];

    $sql = "INSERT INTO product_list (part_number, part_name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $part_number, $part_name);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php"); // Redirect back to index page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
