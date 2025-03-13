<?php

require 'setting.php'; // Load SMTP settings

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = $host;
$mail->SMTPAuth = true;
$mail->Username = $username;
$mail->Password = $hostPassword;
$mail->SMTPSecure = $smtpSecure;
$mail->Port = $port;

$mail->setFrom($sender, $senderName);

$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable debug output
$mail->Debugoutput = 'html'; // Show output in HTML format


