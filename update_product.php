<?php
include 'connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $part_number = $_POST['part_number'];
    $part_name = $_POST['part_name'];

    // Update query
    $sql = "UPDATE product_list SET part_name=? WHERE part_number=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $part_name, $part_number);

    if ($stmt->execute()) {
        echo "<script>
                alert('Product updated successfully');
                window.location.href = 'productkey.php';
              </script>";
    } else {
        echo "<script>alert('Error updating product');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
