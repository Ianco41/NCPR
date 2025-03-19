<?php
require 'connection.php'; // Include your database connection

header('Content-Type: application/json');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable error reporting

try {
    $sql = "SELECT id, ncpr_num, initiator, status, `date` FROM ncpr_table"; // Ensure `date` is correctly referenced
    $result = $conn->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE); // Ensure UTF-8 encoding
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]); // Return error message if query fails
}

$conn->close();
?>
