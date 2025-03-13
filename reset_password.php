<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $otp = $_POST["otp"];
        include_once 'connection.php';

        $sql = "SELECT * FROM register WHERE otp = :otp";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["otp" => $otp]); // ✅ Use `execute()` on `$stmt`


        $count = $stmt->rowCount(); // ✅ Assign rowCount() to a proper variable
        if ($count > 0)  // ✅ Use correct variable
         {  ?>
        <fieldset>
            <legend>
                <form action="">
                    <div>
                        <input type="password" name="email" required>
                        <span>New Password</span>

                    </div>
                    <div>
                        <input type="password" name="email" required>
                        <span>Confirm Password</span>
                    </div>

                    <button class="btnSend">Send</button>
                </form>
            </legend>
        </fieldset>

   <?php    } else {
    echo 'Inccorrect';
   }

?>
</body>
</html>