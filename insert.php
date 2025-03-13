<?php
    include 'connection.php'; // Database connection

    function getNextNcprNum($conn) {
        $year = date("y"); // Get the last two digits of the year (e.g., "25" for 2025)
    
        mysqli_begin_transaction($conn); // Start transaction
    
        do {
            // Get the latest NCPR number for the year
            $query = "SELECT MAX(ncpr_num) AS last_num FROM ncpr_table WHERE ncpr_num LIKE '$year-%' FOR UPDATE";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
    
            $lastNum = $row['last_num'];
            $newNum = ($lastNum === NULL) ? 1 : intval(substr($lastNum, 3)) + 1;
            $newNcprNum = $year . '-' . str_pad($newNum, 4, "0", STR_PAD_LEFT);
    
            // Check if the generated NCPR number already exists
            $checkQuery = "SELECT COUNT(*) AS count FROM ncpr_table WHERE ncpr_num = '$newNcprNum'";
            $checkResult = mysqli_query($conn, $checkQuery);
            $checkRow = mysqli_fetch_assoc($checkResult);
        } while ($checkRow['count'] > 0); // Keep incrementing if duplicate exists
    
        mysqli_commit($conn); // Commit transaction
    
        return $newNcprNum;
    }
    
    // Handle AJAX request for NCPR Number
    if (isset($_GET['get_ncpr'])) {
        echo json_encode(["status" => "success", "ncpr_num" => getNextNcprNum($conn)]);
        exit;
    }
    

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $initiator = $_POST['initiator'];
        $date = $_POST['date'];
        $part_number = $_POST['part_number'];
        $part_name = $_POST['part_name'];
        $process = $_POST['process'];
        $urgent = $_POST['urgent'];

        // New Fields
        $issue = $_POST['issue'];
        $awpi = $_POST['awpi'];
        $dc = $_POST['dc'];
        $deviation = $_POST['deviation'];
        $repeating = $_POST['repeating'];
        $cavity = $_POST['cavity'];
        $machine = $_POST['machine'];
        $ref = $_POST['ref'];
        $bg = $_POST['bg'];

        // Additional New Form Fields
        $recall = isset($_POST['recall']) ? $_POST['recall'] : NULL;
        $fgparts = isset($_POST['fgparts']) ? 'yes' : NULL;
        $shipment = isset($_POST['shipment']) ? $_POST['shipment'] : NULL;
        $ship_sched = isset($_POST['ship_sched']) ? $_POST['ship_sched'] : NULL;
        $wip = isset($_POST['wip']) ? 'yes' : NULL;
        $stop_proc = isset($_POST['stop_proc']) ? $_POST['stop_proc'] : NULL;
        $location = isset($_POST['location']) ? $_POST['location'] : NULL;
        $mcs = isset($_POST['mcs']) ? 'yes' : NULL;
        $mcs_details = isset($_POST['mcs_details']) ? $_POST['mcs_details'] : NULL;
        $customer_notif = isset($_POST['customer_notif']) ? 'yes' : NULL;
        $one = isset($_POST['one']) ? 'yes' : NULL;
        $one_one = isset($_POST['one_one']) ? 'yes' : NULL;
        $two = isset($_POST['two']) ? 'yes' : NULL;
        $two_one = isset($_POST['two_one']) ? $_POST['two_one'] : NULL;
        $three = isset($_POST['three']) ? 'yes' : NULL;
        $three_one = isset($_POST['three_one']) ? $_POST['three_one'] : NULL;
        $four = isset($_POST['four']) ? 'yes' : NULL;
        $five = isset($_POST['five']) ? 'yes' : NULL;
        $six = isset($_POST['six']) ? 'yes' : NULL;
        $seven = isset($_POST['seven']) ? $_POST['seven'] : NULL;
        $seven_one = isset($_POST['seven_one']) ? $_POST['seven_one'] : NULL;
        $seven_two = isset($_POST['seven_two']) ? $_POST['seven_two'] : NULL;
        $eight = isset($_POST['eight']) ? 'yes' : NULL;
        $eight_one = isset($_POST['eight_one']) ? $_POST['eight_one'] : NULL;
        $nine = isset($_POST['nine']) ? 'yes' : NULL;
        $nine_one = isset($_POST['nine_one']) ? $_POST['nine_one'] : NULL;

    

        // ✅ Ensure part_number exists in product_list
        $check_query = "SELECT part_name FROM product_list WHERE part_number = ?";
        $stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($stmt, "s", $part_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) == 0) {
            // Insert new part number & name into product_list
            $insert_query = "INSERT INTO product_list (part_number, part_name) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($stmt, "ss", $part_number, $part_name);
            mysqli_stmt_execute($stmt);
        }

        // Get the next ncpr_num
        $ncpr_num = getNextNcprNum($conn);


        $sql = "INSERT INTO ncpr_table (
            initiator, ncpr_num, date, part_number, part_name, process, urgent, 
            issue, awpi, dc, deviation, repeating, cavity, machine, ref, bg, 
            recall, fgparts, shipment, ship_sched, wip, stop_proc, location, 
            mcs, mcs_details, customer_notif, 
            one, one_one, two, two_one, three, three_one, four, five, six, 
            seven, seven_one, seven_two, eight, eight_one, nine, nine_one, status
        ) VALUES (
            '$initiator', '$ncpr_num', '$date', '$part_number', '$part_name', '$process', '$urgent',
            '$issue', '$awpi', '$dc', '$deviation', '$repeating', '$cavity', '$machine', '$ref', '$bg',
            '$recall', '$fgparts', '$shipment', '$ship_sched', '$wip', '$stop_proc', '$location', 
            '$mcs', '$mcs_details', '$customer_notif', 
            '$one', '$one_one', '$two', '$two_one', '$three', '$three_one', '$four', '$five', '$six', 
            '$seven', '$seven_one', '$seven_two', '$eight', '$eight_one', '$nine', '$nine_one', 'open'
        )";
        
    

        if (mysqli_query($conn, $sql)) {
            $ncpr_id = mysqli_insert_id($conn);

            if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] == 0) {
                $image_name = $_FILES['image_name']['name'];
                $image_tmp = $_FILES['image_name']['tmp_name'];
                $image_path = 'asset/images/' . time() . '_' . $image_name; // Unique file name
            
                if (move_uploaded_file($image_tmp, $image_path)) {
                    $img_sql = "INSERT INTO uploaded_file (ncpr_id, file_name, file_path, file_type, uploaded_at) 
                                VALUES ('$ncpr_id', '$image_name', '$image_path', 'image', NOW())";
                    mysqli_query($conn, $img_sql);
                } else {
                    error_log("Image upload failed");
                }
            }
            
            if (!empty($_FILES['excel_name']['name'][0])) {
                foreach ($_FILES['excel_name']['name'] as $key => $excel_name) {
                    if ($_FILES['excel_name']['error'][$key] == 0) {
                        $excel_tmp = $_FILES['excel_name']['tmp_name'][$key];
                        $excel_path = 'asset/excel/' . time() . '_' . $excel_name; // Unique file name
            
                        if (move_uploaded_file($excel_tmp, $excel_path)) {
                            $excel_sql = "INSERT INTO uploaded_file (ncpr_id, file_name, file_path, file_type, uploaded_at) 
                                          VALUES ('$ncpr_id', '$excel_name', '$excel_path', 'excel', NOW())";
                            mysqli_query($conn, $excel_sql);
                        } else {
                            error_log("Excel file upload failed");
                        }
                    }
                }
            }
            

            // Insert into fomo_table (if supplier details exist)
            if (
                isset($_POST['supplier'], $_POST['supplier_part_name'], $_POST['supplier_part_number'], $_POST['invoice_num'], $_POST['purchase_order']) &&
                !empty($_POST['supplier']) &&
                !empty($_POST['supplier_part_name']) &&
                !empty($_POST['supplier_part_number']) &&
                !empty($_POST['invoice_num']) &&
                !empty($_POST['purchase_order'])
            ) {
                $supplier = $_POST['supplier'];
                $supplier_part_name = $_POST['supplier_part_name'];
                $supplier_part_number = $_POST['supplier_part_number'];
                $invoice_num = $_POST['invoice_num'];
                $purchase_order = $_POST['purchase_order'];

                $fomo_sql = "INSERT INTO fomo (ncpr_id, supplier, supplier_part_name, supplier_part_number, invoice_num, purchase_order)
                            VALUES ('$ncpr_id', '$supplier', '$supplier_part_name', '$supplier_part_number', '$invoice_num', '$purchase_order')";

                mysqli_query($conn, $fomo_sql);
            }

            // Insert multiple material details
            if (
                isset($_POST['ntdj_num'], $_POST['mns_num'], $_POST['lot_sublot_qty'], $_POST['qty_affected'], $_POST['defect_rate'])
            ) {
                $ntdj_nums = $_POST['ntdj_num'];
                $mns_nums = $_POST['mns_num'];
                $lot_sublot_qtys = $_POST['lot_sublot_qty'];
                $qty_affecteds = $_POST['qty_affected'];
                $qty_affected_texts = $_POST['qty_affected_text']; // This is an array
                $defect_rates = $_POST['defect_rate'];

                for ($i = 0; $i < count($ntdj_nums); $i++) {
                    $ntdj_num = $ntdj_nums[$i];
                    $mns_num = $mns_nums[$i];
                    $lot_sublot_qty = $lot_sublot_qtys[$i];
                    $qty_affected = $qty_affecteds[$i];
                    $qty_affected_text = $qty_affected_texts[$i]; // Get value from array
                    $defect_rate = $defect_rates[$i];
                
                    $material_sql = "INSERT INTO material (ncpr_id, ntdj_num, mns_num, lot_sublot_qty, qty_affected, qty_affected_text, defect_rate)
                                    VALUES ('$ncpr_id', '$ntdj_num', '$mns_num', '$lot_sublot_qty', '$qty_affected', '$qty_affected_text', '$defect_rate')";
                
                    mysqli_query($conn, $material_sql);
                }
            }

            echo json_encode(["status" => "success", "new_ncpr_num" => $ncpr_num]);

        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
    }
?>
