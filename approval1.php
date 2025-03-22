<?php
$response = ["status" => "error", "message" => "Unknown error occurred."];

try {
    require 'connection.php'; // Include database connection

    // Capture POST data
    $ncpr_num = $_POST['ncpr_num'] ?? '';
    $action = $_POST['action'] ?? '';
    $role = $_POST['role'] ?? '';

    // Debugging: Log received data
    file_put_contents('debug.log', "Received Data: " . json_encode($_POST) . PHP_EOL, FILE_APPEND);

    if (!$ncpr_num) {
        throw new Exception("NCPR Number is missing.");
    }

    // Check if `dispo_id` exists in `ncpr_table`
    $stmt = $conn->prepare("SELECT dispo_id FROM ncpr_table WHERE ncpr_num = ?");
    $stmt->bind_param("s", $ncpr_num);
    $stmt->execute();
    $stmt->bind_result($dispo_id);
    $stmt->fetch();
    $stmt->close();

    file_put_contents('debug.log', "Fetched dispo_id: " . ($dispo_id ?? 'NULL') . PHP_EOL, FILE_APPEND);

    if (!empty($dispo_id)) {
        $response = ["status" => "error", "message" => "This NCPR already has a disposition ID."];
    } else {
        // Continue with approval logic...
        $response = ["status" => "success", "message" => "Approval processed."];
    }

} catch (Exception $e) {
    file_put_contents('debug.log', "Error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    $response = ["status" => "error", "message" => $e->getMessage()];
}

echo json_encode($response);
?>