<?php
require 'connection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $actions_taken = isset($_POST['actions_taken']) ? implode(", ", $_POST['actions_taken']) : "";
    $process_dispo = isset($_POST['process_dispo']) ? implode(", ", $_POST['process_dispo']) : "";
    $affected_process = $_POST['affected_process'] ?? "";
    $further_eval = $_POST['further_eval'] ?? "";
    $resumption_reason = isset($_POST['resumption_reason']) ? implode(", ", $_POST['resumption_reason']) : "";
    $other_resumption = $_POST['other_resumption'] ?? "";
    $process_instruction = $_POST['process_instruction'] ?? "";
    $instructions_detail = isset($_POST['instructions_detail']) ? implode(", ", $_POST['instructions_detail']) : "";
    $document_alert = $_POST['document_alert'] ?? "";
    $other_specify = $_POST['other_specify'] ?? "";
    $documents_revision = isset($_POST['documents_revision']) ? implode(", ", $_POST['documents_revision']) : "";
    $released_by = $_POST['released_by'] ?? "";
    $acknowledgment_signature = $_POST['acknowledgment_signature'] ?? "";
    $pe_ee_head_signature = $_POST['pe_ee_head_signature'] ?? "";
    $prod_manager_signature = $_POST['prod_manager_signature'] ?? "";
    $action = $_POST['action'] ?? "";

    // File Upload Handling
    $attachments = [];
    if (!empty($_FILES['attachments']['name'][0])) {
        $uploadDir = "uploads/"; // Ensure this directory exists
        foreach ($_FILES['attachments']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['attachments']['name'][$key]);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($tmp_name, $filePath)) {
                $attachments[] = $filePath;
            }
        }
    }
    $attachmentsList = implode(", ", $attachments);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO approval_records 
        (actions_taken, process_dispo, affected_process, further_eval, resumption_reason, other_resumption, 
        process_instruction, instructions_detail, document_alert, other_specify, documents_revision, released_by, 
        acknowledgment_signature, pe_ee_head_signature, prod_manager_signature, action, attachments) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssssss", 
        $actions_taken, $process_dispo, $affected_process, $further_eval, $resumption_reason, 
        $other_resumption, $process_instruction, $instructions_detail, $document_alert, $other_specify, 
        $documents_revision, $released_by, $acknowledgment_signature, $pe_ee_head_signature, 
        $prod_manager_signature, $action, $attachmentsList);

    if ($stmt->execute()) {
        echo "Data successfully saved!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
