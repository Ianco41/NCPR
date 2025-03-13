<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        die("Error: Email is required.");
    }

    $otp = rand(100000, 999999); // Generate a 6-digit OTP

    include 'connection.php';
    
    if (!isset($conn)) {
        die("Error: Database connection failed.");
    }

    // Check if email exists
    $sql = "SELECT * FROM register WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $sql_update_statement = "UPDATE register SET otp = ? WHERE email = ?";
        $statement = $conn->prepare($sql_update_statement);
        $statement->bind_param("is", $otp, $email);
        $statement->execute();

        try {
            require 'emailAPI.php';

            $mail->setFrom($sender, 'OTP Sender');
            $mail->addAddress($email, 'Syntax Flow');
            $mail->addReplyTo($sender, 'OTP Sender');

            $mail->isHTML(true);
            $mail->Subject = 'One Time Password - OTP';
            $mail->Body = 'Hi, here is your One-Time Password <br/><b>' . $otp . '</b>';

            if ($mail->send()) {
                echo 'Hi, your OTP has been sent.<br/>';
                echo '<a href="enterOTP.php">Enter your OTP to reset password</a>';
            } else {
                echo "Email sending failed.";
            }
        } catch (Exception $e) {
            echo "An error occurred. The message could not be sent: {$mail->ErrorInfo}";
        }
    } else {
        echo "The email address does not exist in our database.";
    }

    $stmt->close();
    $conn->close();
?>
