<?php
include "connection.php";
$ncprNum = isset($_POST['ncpr_num']) ? intval($_POST['ncpr_num']) : 0;

$query = "SELECT * FROM dispo_table WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    include "modaldispo.php"; // This contains your modal HTML structure
} else {
    // Start with a new form if no record is found
    echo '
    <div class="modal-header">
        <h5 class="modal-title">New Approval</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="newApprovalForm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>';
}
?>
