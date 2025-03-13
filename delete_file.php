<?php
include "connection.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["file_id"])) {
    $file_id = $_POST["file_id"];

    // Fetch file path before deletion
    $query = "SELECT file_path FROM ncpr_files WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $file_path = $row["file_path"];

        // Delete the file from server
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete record from database
        $deleteQuery = "DELETE FROM ncpr_files WHERE id = ?";
        $stmtDelete = $conn->prepare($deleteQuery);
        $stmtDelete->bind_param("i", $file_id);

        if ($stmtDelete->execute()) {
            echo json_encode(["status" => "success", "message" => "File deleted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete file."]);
        }
        
        $stmtDelete->close();
    } else {
        echo json_encode(["status" => "error", "message" => "File not found."]);
    }

    $stmt->close();
    $conn->close();
}
?>
