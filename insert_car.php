<?php
require 'connection.php';

global $DRF_id; // Use the retrieved ID from main script

$car_is_approved = isset($_POST['car']) ? 1 : 0;
$car_num_active = !empty($_POST['car_no']) ? 1 : 0;
$car_num = !empty($_POST['car_no']) ? $_POST['car_no'] : NULL;
$bd_report_active = isset($_POST['bd_report']) ? $_POST['bd_report'] : NULL;
$scar_active = isset($_POST['scar']) ? 1 : 0;
$scar_num = !empty($_POST['scar_no']) ? $_POST['scar_no'] : NULL;

$sql = "INSERT INTO car_tbl (car_is_approved, car_num_active, car_num, 8d_report_active, scar_active, scar_num, DRF_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissisi", $car_is_approved, $car_num_active, $car_num, $bd_report_active, $scar_active, $scar_num, $DRF_id);
if ($stmt->execute()) {
    return $stmt->insert_id; // Return inserted ID
} else {
    return false; // Return false on failure
}
