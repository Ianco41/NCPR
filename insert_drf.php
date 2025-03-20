<?php
require 'connection.php';

global $prod_dispo_id; // Use the retrieved ID from main script

// Process form data for drf_tbl
$NTPI_active = isset($_POST['dispo_from']) && in_array('NTPI', $_POST['dispo_from']) ? 1 : 0;
$MRB_active = isset($_POST['mrb']) ? $_POST['mrb'] : NULL;
$NFLD_active = isset($_POST['dispo_from']) && in_array('NFLD', $_POST['dispo_from']) ? 1 : 0;
$cust_is_approve = isset($_POST['customer_approval']) ? $_POST['customer_approval'] : NULL;
$doc_alert_num = !empty($_POST['document_alert']) ? $_POST['document_alert'] : NULL;

// Insert into drf_tbl
$sql = "INSERT INTO drf_tbl (NTPI_active, MRB_active, NFLD_active, cust_is_approve, doc_alert_num) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isisi", $NTPI_active, $MRB_active, $NFLD_active, $cust_is_approve, $doc_alert_num);
if ($stmt->execute()) {
    return $stmt->insert_id; // Return inserted ID
} else {
    return false; // Return false on failure
}
