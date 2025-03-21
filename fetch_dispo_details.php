<?php
require 'connection.php'; // Include your DB connection

header('Content-Type: application/json'); // Ensure the response is JSON

if (isset($_POST['ncpr_num'])) {
    $ncpr_num = $_POST['ncpr_num'];

    // Debugging: Log received NCPR number
    error_log("Received NCPR number: " . $ncpr_num);

    if ($conn) {
        // Fetch data from ncpr_table, dispo_table, cnc_mat_tbl, car_tbl, drf_tbl, and prod_dispo_tbl
        $stmt = $conn->prepare("
            SELECT 
                ncpr.dispo_id, ncpr.ncpr_num,

                -- Data from dispo_table
                dispo.id AS dispo_table_id, dispo.QAVCIA, dispo.man, dispo.man_id_num, dispo.name AS dispo_name, 
                dispo.method, dispo.machine, dispo.CNC_mat_id, dispo.created_at AS dispo_created_at, dispo.updated_at AS dispo_updated_at,

                -- Data from cnc_mat_tbl
                cnc.id AS cnc_id, cnc.nfld_item, cnc.nfld_item_pur_item, cnc.FE_expired, cnc.local_supp, 
                cnc.imi, cnc.pff, cnc.CAR_id, cnc.created_at AS cnc_created_at, cnc.updated_at AS cnc_updated_at,

                -- Data from car_tbl
                car.id AS car_id, car.car_is_approved, car.car_num_active, car.car_num, car.8d_report_active, 
                car.scar_active, car.scar_num, car.DRF_id, car.created_at AS car_created_at, car.updated_at AS car_updated_at,

                -- Data from drf_tbl
                drf.id AS drf_id, drf.NTPI_active, drf.MRB_active, drf.NFLD_active, drf.cust_is_approve, 
                drf.doc_alert_num, drf.prod_dispo_id, drf.created_at AS drf_created_at, drf.updated_at AS drf_updated_at,

                -- Data from prod_dispo_tbl
                prod.id AS prod_dispo_id, prod.use_as_isActive, prod.re_inspectionActive, prod.run_normalActive, 
                prod.regrade_Active, prod.rework_Active, prod.repair_Active, prod.rework_traveler_Active, 
                prod.scrap_Active, prod.RTV_Active, prod.yield_off, prod.da_no, prod.rework_da_no, prod.wis_no, 
                prod.scrap_amount, prod.shipment_date, prod.intervention_id, prod.rework_type_id, 
                prod.created_at AS prod_created_at, prod.updated_at AS prod_updated_at

            FROM ncpr_table ncpr
            LEFT JOIN dispo_table dispo ON ncpr.dispo_id = dispo.id
            LEFT JOIN cnc_mat_tbl cnc ON dispo.CNC_mat_id = cnc.id  -- Join cnc_mat_tbl
            LEFT JOIN car_tbl car ON cnc.CAR_id = car.id  -- Join car_tbl
            LEFT JOIN drf_tbl drf ON car.DRF_id = drf.id  -- Join drf_tbl
            LEFT JOIN prod_dispo_tbl prod ON drf.prod_dispo_id = prod.id  -- Join prod_dispo_tbl

            WHERE ncpr.ncpr_num = ?
        ");
        
        if ($stmt) {
            $stmt->bind_param("s", $ncpr_num);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // Debugging: Log fetched row
                error_log("Fetched Data: " . print_r($row, true));

                echo json_encode([
                    "has_dispo" => isset($row['dispo_id']) && !empty($row['dispo_id']), // More reliable check
                    "dispo_id" => $row['dispo_id'] ?? null,
                    "ncpr_num" => $row['ncpr_num'],

                    // Data from dispo_table
                    "dispo_table_id" => $row['dispo_table_id'] ?? null,
                    "QAVCIA" => $row['QAVCIA'] ?? null,
                    "man" => $row['man'] ?? null,
                    "man_id_num" => $row['man_id_num'] ?? null,
                    "dispo_name" => $row['dispo_name'] ?? null,
                    "method" => $row['method'] ?? null,
                    "machine" => $row['machine'] ?? null,
                    "CNC_mat_id" => $row['CNC_mat_id'] ?? null,
                    "dispo_created_at" => $row['dispo_created_at'] ?? null,
                    "dispo_updated_at" => $row['dispo_updated_at'] ?? null,

                    // Data from cnc_mat_tbl
                    "cnc_id" => $row['cnc_id'] ?? null,
                    "nfld_item" => $row['nfld_item'] ?? null,
                    "nfld_item_pur_item" => $row['nfld_item_pur_item'] ?? null,
                    "FE_expired" => $row['FE_expired'] ?? null,
                    "local_supp" => $row['local_supp'] ?? null,
                    "imi" => $row['imi'] ?? null,
                    "pff" => $row['pff'] ?? null,
                    "CAR_id" => $row['CAR_id'] ?? null,
                    "cnc_created_at" => $row['cnc_created_at'] ?? null,
                    "cnc_updated_at" => $row['cnc_updated_at'] ?? null,

                    // Data from car_tbl
                    "car_id" => $row['car_id'] ?? null,
                    "car_is_approved" => $row['car_is_approved'] ?? null,
                    "car_num_active" => $row['car_num_active'] ?? null,
                    "car_num" => $row['car_num'] ?? null,
                    "8d_report_active" => $row['8d_report_active'] ?? null,
                    "scar_active" => $row['scar_active'] ?? null,
                    "scar_num" => $row['scar_num'] ?? null,
                    "DRF_id" => $row['DRF_id'] ?? null,
                    "car_created_at" => $row['car_created_at'] ?? null,
                    "car_updated_at" => $row['car_updated_at'] ?? null,

                    // Data from drf_tbl
                    "drf_id" => $row['drf_id'] ?? null,
                    "NTPI_active" => $row['NTPI_active'] ?? null,
                    "MRB_active" => $row['MRB_active'] ?? null,
                    "NFLD_active" => $row['NFLD_active'] ?? null,
                    "cust_is_approve" => $row['cust_is_approve'] ?? null,
                    "doc_alert_num" => $row['doc_alert_num'] ?? null,
                    "prod_dispo_id" => $row['prod_dispo_id'] ?? null,
                    "drf_created_at" => $row['drf_created_at'] ?? null,
                    "drf_updated_at" => $row['drf_updated_at'] ?? null,

                    // Data from prod_dispo_tbl
                    "prod_dispo_id" => $row['prod_dispo_id'] ?? null,
                    "use_as_isActive" => $row['use_as_isActive'] ?? null,
                    "re_inspectionActive" => $row['re_inspectionActive'] ?? null,
                    "run_normalActive" => $row['run_normalActive'] ?? null,
                    "regrade_Active" => $row['regrade_Active'] ?? null,
                    "rework_Active" => $row['rework_Active'] ?? null,
                    "repair_Active" => $row['repair_Active'] ?? null,
                    "rework_traveler_Active" => $row['rework_traveler_Active'] ?? null,
                    "scrap_Active" => $row['scrap_Active'] ?? null,
                    "RTV_Active" => $row['RTV_Active'] ?? null,
                    "yield_off" => $row['yield_off'] ?? null,
                    "da_no" => $row['da_no'] ?? null,
                    "rework_da_no" => $row['rework_da_no'] ?? null,
                    "wis_no" => $row['wis_no'] ?? null,
                    "scrap_amount" => $row['scrap_amount'] ?? null,
                    "shipment_date" => $row['shipment_date'] ?? null
                ]);
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>
