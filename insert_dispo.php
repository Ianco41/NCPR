<?php
require 'connection.php';

global $CNC_mat_id; // Use the retrieved ID from main script

$QAVCIA = !empty($_POST['containment']) ? $_POST['containment'] : NULL;
$man = isset($_POST['cause']) && in_array('Man', $_POST['cause']) ? 1 : 0;
$man_id_num = !empty($_POST['id_no']) ? $_POST['id_no'] : NULL;
$name = !empty($_POST['name']) ? $_POST['name'] : NULL;
$method = isset($_POST['cause']) && in_array('Method', $_POST['cause']) ? 1 : 0;
$machine = isset($_POST['cause']) && in_array('Machine', $_POST['cause']) ? 1 : 0;

// Corrected SQL Query
$sql = "INSERT INTO dispo_table 
        (QAVCIA, man, man_id_num, name, method, machine, CNC_mat_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sissiii",
    $QAVCIA,
    $man,
    $man_id_num,
    $name,
    $method,
    $machine,
    $CNC_mat_id
);

if ($stmt->execute()) {
    $inserted_id = $stmt->insert_id;
    $stmt->close();
    return $inserted_id; // Return only the inserted ID
} else {
    //error_log("Insert Dispo Error: " . $stmt->error); // Log error for debugging
    return false; // Return false on failure
}
