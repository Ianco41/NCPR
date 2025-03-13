<?php
include "connection.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $initiator = $_POST["initiator"];
    $ncpr_num = $_POST["ncpr_num"];
    $date = $_POST["date"];
    $part_number = $_POST["part_number"];
    $part_name = $_POST["part_name"];
    $process = $_POST["process"];
    $urgent = $_POST["urgent"];
    $issue = $_POST["issue"];
    $repeating = $_POST["repeating"];
    $machine = $_POST["machine"];
    $ref = $_POST["ref"];
    $location = $_POST["location"];
    $supplier = $_POST["supplier"];
    $supplier_part_name = $_POST["supplier_part_name"];
    $supplier_part_number = $_POST["supplier_part_number"];

    // Update NCPR details in the database
    $sql = "UPDATE ncpr_table SET 
            initiator = ?, ncpr_num = ?, date = ?, part_number = ?, part_name = ?, 
            process = ?, urgent = ?, issue = ?, repeating = ?, machine = ?, ref = ?, 
            location = ?, supplier = ?, supplier_part_name = ?, supplier_part_number = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssi", 
        $initiator, $ncpr_num, $date, $part_number, $part_name, 
        $process, $urgent, $issue, $repeating, $machine, $ref, 
        $location, $supplier, $supplier_part_name, $supplier_part_number, $id
    );

    if ($stmt->execute()) {
        // Handle file uploads
        if (!empty($_FILES["files"]["name"][0])) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
                $file_name = $_FILES["files"]["name"][$key];
                $file_tmp = $_FILES["files"]["tmp_name"][$key];
                $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_path = $uploadDir . time() . "_" . basename($file_name);

                if (move_uploaded_file($file_tmp, $file_path)) {
                    $insertFile = "INSERT INTO uploaded_file (ncpr_id, file_name, file_path, file_type) VALUES (?, ?, ?, ?)";
                    $stmtFile = $conn->prepare($insertFile);
                    $stmtFile->bind_param("isss", $id, $file_name, $file_path, $file_type);
                    $stmtFile->execute();
                }
            }
        }
        echo json_encode(["status" => "success", "message" => "NCPR updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update NCPR."]);
    }
    
    $stmt->close();
    $conn->close();
}
?>
