<?php
session_start();
require 'connection.php'; // Ensure proper database connection

header("Content-Type: application/json"); // Ensure JSON response

// Check user session
if (!isset($_SESSION['role']) || !isset($_SESSION["user"])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
    exit;
}

$username = $_SESSION["user"];
$user_role = $_SESSION['role'];

// Role-based permission mapping
$allowed_roles = [
    "ENGINEER" => "QA Engineer",
    "SUPERVISOR" => "QA Manager",
    "MANAGER" => "QA Manager",
    "REPRESENTATIVE" => "NT Representative"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    $role = $_POST['role'] ?? '';
    $ncpr_num = $_POST['ncpr_num'] ?? '';

    if (empty($action) || empty($role) || empty($ncpr_num)) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required parameters.",
            "data" => [
                "action" => $action,
                "role" => $role,
                "ncpr_num" => $ncpr_num
            ]
        ]);
        exit;
    }

    // Validate role permission
    if (!isset($allowed_roles[$user_role]) || $allowed_roles[$user_role] !== $role) {
        echo json_encode(["status" => "error", "message" => "You are not authorized to perform this action."]);
        exit;
    }

    // Fetch person_id of the user
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($person_id);
    $stmt->fetch();
    $stmt->close();

    if (!$person_id) {
        echo json_encode(["status" => "error", "message" => "User not found."]);
        exit;
    }

    // Fetch ncpr_id from ncpr_table
    $stmt = $conn->prepare("SELECT ncpr_num FROM ncpr_table WHERE ncpr_num = ?");
    $stmt->bind_param("s", $ncpr_num);
    $stmt->execute();
    $stmt->bind_result($ncpr_num);
    $stmt->fetch();
    $stmt->close();

    if (!$ncpr_num) {
        echo json_encode(["status" => "error", "message" => "NCPR record not found."]);
        exit;
    }

    // Start inserting data in sequence
    try {
        $conn->begin_transaction(); // Begin Transaction

        // Step 1: Insert into prod_dispo_tbl (Get $prod_dispo_id)
        ob_start(); // Prevent unwanted output
        $prod_dispo_id = include "insert_prod_dispo.php";
        ob_end_clean(); // Clear any accidental output

        if (!is_numeric($prod_dispo_id)) {
            throw new Exception("Failed to insert into prod_dispo_tbl");
        }

        // Step 2: Insert into drf_tbl with prod_dispo_id
        ob_start();
        $DRF_id = include "insert_drf.php";
        ob_end_clean();
        if (!is_numeric($DRF_id)) {
            throw new Exception("Failed to insert into drf_tbl");
        }

        // Step 3: Insert into car_tbl with DRF_id
        ob_start();
        $CAR_id = include "insert_car.php";
        ob_end_clean();
        if (!is_numeric($CAR_id)) {
            throw new Exception("Failed to insert into car_tbl");
        }

        // Step 4: Insert into cnc_mat_tbl with CAR_id
        ob_start();
        $CNC_mat_id = include "insert_cnc_mat.php";
        ob_end_clean();
        if (!is_numeric($CNC_mat_id)) {
            throw new Exception("Failed to insert into cnc_mat_tbl");
        }

        // Step 5: Insert into dispo_table with CNC_mat_id
        ob_start();
        $dispo_id = include "insert_dispo.php";
        ob_end_clean();
        if (!is_numeric($dispo_id)) {
            throw new Exception("Failed to insert into dispo_table");
        }

        // Step 6: Insert approval action into dispo_sitioned
        $status = ucfirst(strtolower($action));  // Capitalize first letter and make sure it's lowercase
        $stmt = $conn->prepare("INSERT INTO dispo_approval (ncpr_num, approver_role, approver_id, status, approval_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssis", $ncpr_num, $user_role, $person_id, $status);

        if (!$stmt->execute()) {
            throw new Exception("Failed to insert into dispo_sitioned.");
        }
        $dispo_sitioned_id = $stmt->insert_id;
        $stmt->close();

        // Step 7: Update dispo_id in ncpr_table
        $stmt = $conn->prepare("UPDATE ncpr_table SET dispo_id = ? WHERE ncpr_num = ?");
        $stmt->bind_param("is", $dispo_id, $ncpr_num);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update ncpr_table.");
        }

        $conn->commit(); // Commit transaction

        // Example response
        $response = ["status" => "success", "message" => "All data inserted successfully!"];
        ob_clean(); // Clean any prior output
        echo json_encode($response);
    } catch (Exception $e) {
        $conn->rollback(); // Rollback in case of error
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
    $stmt->close();

    $conn->close();
}
