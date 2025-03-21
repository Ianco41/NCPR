<?php
require 'connection.php';

global $DRF_id; // Use the retrieved ID from main script

$car_is_approved = isset($_POST['car']) ? 1 : 0;
$car_num_active = !empty($_POST['car_no']) ? 1 : 0;
$car_num = !empty($_POST['car_no']) ? $_POST['car_no'] : NULL;
$eightd_report_active = isset($_POST['bd_report']) ? $_POST['bd_report'] : NULL;
$scar_active = isset($_POST['scar']) ? 1 : 0;
$scar_num = !empty($_POST['scar_no']) ? $_POST['scar_no'] : NULL;

// Corrected SQL query with backticks for `8d_report_active`
$sql = "INSERT INTO car_tbl (car_is_approved, car_num_active, car_num, `8d_report_active`, scar_active, scar_num, DRF_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "iissisi",
    $car_is_approved,
    $car_num_active,
    $car_num,
    $eightd_report_active,
    $scar_active,
    $scar_num,
    $DRF_id
);

if ($stmt->execute()) {
    $inserted_id = $stmt->insert_id;
    $stmt->close();
    return $inserted_id; // Return only the inserted ID
} else {
    //error_log("Insert CAR Error: " . $stmt->error); // Log error for debugging
    return false; // Return false on failure
}
