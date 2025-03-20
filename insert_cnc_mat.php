<?php
require 'connection.php';

global $CAR_id; // Use the retrieved ID from main script


$nfld_item = isset($_POST['cause']) && in_array('NID Item', $_POST['cause']) ? 1 : 0;
$nfld_item_pur_item = isset($_POST['cause']) && in_array('NID Purchased Item', $_POST['cause']) ? 1 : 0;
$FE_expired = isset($_POST['cause']) && in_array('For Expiry Expired', $_POST['cause']) ? 1 : 0;
$local_supp = isset($_POST['cause']) && in_array('Local Supplier', $_POST['cause']) ? 1 : 0;
$imi = isset($_POST['cause']) && in_array('Customer Furnish Material', $_POST['cause']) ? 1 : 0;
$pff = isset($_POST['potential_failure']) ? $_POST['potential_failure'] : NULL;

$sql = "INSERT INTO cnc_mat_tbl (nfld_item, nfld_item_pur_item, FE_expired, local_supp, imi, pff, CAR_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiisi", $nfld_item, $nfld_item_pur_item, $FE_expired, $local_supp, $imi, $pff, $CAR_id);
if ($stmt->execute()) {
    return $stmt->insert_id; // Return inserted ID
} else {
    return false; // Return false on failure
}
