<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture checkbox values
    $use_as_is = isset($_POST['product_dispo']) && in_array("Use as is", $_POST['product_dispo']) ? 1 : 0;
    $re_inspection = isset($_POST['product_dispo']) && in_array("Re-inspection", $_POST['product_dispo']) ? 1 : 0;
    $run_normal = isset($_POST['product_dispo']) && in_array("Run under normal process", $_POST['product_dispo']) ? 1 : 0;
    $regrade = isset($_POST['product_dispo']) && in_array("Re-grade", $_POST['product_dispo']) ? 1 : 0;
    $rework = isset($_POST['product_dispo']) && in_array("Rework", $_POST['product_dispo']) ? 1 : 0;
    $repair = isset($_POST['product_dispo']) && in_array("Repair", $_POST['product_dispo']) ? 1 : 0;
    $rework_traveler = isset($_POST['product_dispo']) && in_array("Rework Traveler", $_POST['product_dispo']) ? 1 : 0;
    $scrap = isset($_POST['product_dispo']) && in_array("Scrap", $_POST['product_dispo']) ? 1 : 0;
    $rtv = isset($_POST['product_dispo']) && in_array("RTV", $_POST['product_dispo']) ? 1 : 0;

    // Capture text input values safely
    $yield_off = !empty($_POST['yield_off']) ? $_POST['yield_off'] : null;
    $da_no = !empty($_POST['da_no']) ? $_POST['da_no'] : null;
    $rework_da_no = !empty($_POST['rework_da_no']) ? $_POST['rework_da_no'] : null;
    $wis_no = !empty($_POST['wis_no']) ? $_POST['wis_no'] : null;
    $scrap_amount = !empty($_POST['scrap_amount']) ? $_POST['scrap_amount'] : null;
    $shipment_date = !empty($_POST['shipment_date']) ? $_POST['shipment_date'] : null;
    $intervention_id = !empty($_POST['intervention_id']) ? $_POST['intervention_id'] : null;

    // Check if any rework options are selected
    $rework_active = 0;
    $rework_options = ["Re-press", "Re-plate", "Re-Etest", "Re-measure", "Rework Traveler"];

    foreach ($rework_options as $option) {
        if (isset($_POST['product_dispo']) && in_array($option, $_POST['product_dispo'])) {
            $rework_active = 1;
            break;
        }
    }

    // Fetch corresponding rework type ID
    $rework_type_id = null;
    if ($rework_active) {
        $stmt = $conn->prepare("SELECT id FROM rework_type_tbl WHERE type IN ('" . implode("','", $rework_options) . "')");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $rework_type_id = $row['id'];
        }
        $stmt->close();
    }

    // SQL Insert Query
    $sql = "INSERT INTO prod_dispo_tbl 
        (use_as_isActive, re_inspectionActive, run_normalActive, regrade_Active, rework_Active, repair_Active, rework_traveler_Active, scrap_Active, RTV_Active, 
        yield_off, da_no, rework_da_no, wis_no, scrap_amount, shipment_date, intervention_id, rework_type_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iiiiiiiiiisssssii",
        $use_as_is,
        $re_inspection,
        $run_normal,
        $regrade,
        $rework_active,
        $repair,
        $rework_traveler,
        $scrap,
        $rtv,
        $yield_off,
        $da_no,
        $rework_da_no,
        $wis_no,
        $scrap_amount,
        $shipment_date,
        $intervention_id,
        $rework_type_id
    );

    if ($stmt->execute()) {
        $inserted_id = $stmt->insert_id;
        $stmt->close();
        return $inserted_id; // Return only the inserted ID
    } else {
        return false; // Return false on failure
    }
}
?>
