<?php
include 'connection.php'; // Database connection

$query = "SELECT part_number, part_name FROM product_list";
$result = mysqli_query($conn, $query);

$parts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $parts[] = $row;
}

echo json_encode($parts);
?>
