<?php
include "connection.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    header('Content-Type: application/json'); // Ensure JSON response
    $email = $_POST['email'];
    $_SESSION['email'] = $email;

    $response = ['status' => 'error', 'message' => '']; // Default response

    // Fetch email username and password
    $result = $conn->query("SELECT smtpUsername, smtpPass FROM email_settings WHERE id = 1");
    $emailConfig = $result->fetch_assoc();

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Static
        $mail->SMTPAuth = true;
        $mail->Username = $emailConfig['smtpUsername']; // From database
        $mail->Password = $emailConfig['smtpPass']; // From database (App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Static
        $mail->Port = 465; // Static

        $mail->setFrom($emailConfig['smtpUsername'], 'RSL Food Product');
        $mail->addAddress($email);

        $code = substr(str_shuffle('1234567890'), 0, 5);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Your OTP code is: ' . $code;

        $verifyQuery = $conn->query("SELECT * FROM staffs WHERE email = '$email'");
        if ($verifyQuery->num_rows) {
            $conn->query("UPDATE staffs SET code = '$code' WHERE email = '$email'");
            $mail->send();
            $response = ['status' => 'success', 'message' => 'Code sent to your email'];
        } else {
            $response['message'] = 'Email not found';
        }
    } catch (Exception $e) {
        // Log detailed error information
        error_log("Mailer Error: " . $mail->ErrorInfo);
        $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Clear any previous output
    if (ob_get_length()) {
        ob_clean();
    }
    
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['code'])) {
    $email = $_SESSION['email'];
    $input_code = $_POST['code'];

    $result = $conn->query("SELECT code FROM staffs WHERE email = '$email' AND code = '$input_code'");
    if ($result->num_rows > 0) {
        $conn->query("UPDATE staffs SET code = NULL WHERE email = '$email'");
        echo '<script>alert("Code verified successfully!");</script>';
        echo '<script>window.location.href = "changeForgotPass.php";</script>';
    } else {
        echo '<script>alert("Invalid code. Please try again.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="#" method="post">
          <div class="input-box">
              <input type="email" name="email" id="emailInput" class="form-control" placeholder="Enter your email" required>
          </div>
          <button type="submit" class="submit-btn" name="reset">Reset</button>
        </form>
        <script>
        const resetForm = document.querySelector('form');

        resetForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(resetForm);
            fetch('forgotPass.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message); // Optional alert for success

                    // Get the entered email value
                    const email = document.getElementById("emailInput").value;

                    // Mask the email (hide part before @ and reveal the domain)
                    const maskedEmail = maskEmail(email);

                    // Set the masked email in the modal
                    document.getElementById("emailDisplay").textContent = maskedEmail;

                    // Show the modal
                    const otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
                    otpModal.show();
                } else {
                    alert(data.message); // Display error messages
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });

        // Function to mask the email
        function maskEmail(email) {
            const [localPart, domain] = email.split('@');
            
            // Mask the local part (before the @) with asterisks
            const maskedLocalPart = localPart.replace(/.(?=.{2})/g, '*'); // Only reveal the last 2 chars
            
            return `${maskedLocalPart}@${domain}`;
        }
        document.querySelectorAll('.form-input').forEach((input, index, inputs) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && index > 0 && !e.target.value) {
                    inputs[index - 1].focus();
                }
            });
        });
        document.getElementById('otpForm').addEventListener('submit', function (event) {
          const inputs = document.querySelectorAll('.form-input');
          const hiddenCode = document.getElementById('hiddenCode');
          let code = '';

          // Combine the values of all input fields
          inputs.forEach(input => {
              code += input.value;
          });

          // Set the combined code as the value of the hidden input
          hiddenCode.value = code;

          // You can add validation to ensure all inputs are filled
          if (code.length < inputs.length) {
              event.preventDefault();
              alert('Please complete the OTP code.');
          }
        });
    </script>
</body>
</html>