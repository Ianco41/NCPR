<?php
include("connection.php");

function generate_ncpr_number($conn) {
    $result = mysqli_query($conn, "SELECT ncpr_num FROM ncpr_table ORDER BY ncpr_num DESC LIMIT 1");

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastId = intval($row['ncpr_num']); // Convert to integer
        $newId = str_pad($lastId + 1, 4, '0', STR_PAD_LEFT); // Ensure 4-digit format
    } else {
        $newId = '0001'; // Start with '0001' if no records exist
    }

    echo $newId; // Output ONLY the NCPR number
}

echo generate_ncpr_number($conn); // Return the new NCPR number

mysqli_close($conn);
?>
