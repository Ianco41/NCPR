<?php
include 'connection.php';

if (isset($_POST['ncpr_num'])) {
    $ncpr_num = $_POST['ncpr_num'];

    $query = "SELECT dispo_id FROM ncpr_table WHERE ncpr_num = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $ncpr_num);
    $stmt->execute();
    $stmt->bind_result($dispo_id);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['has_dispo' => !empty($dispo_id)]);
}
?>
