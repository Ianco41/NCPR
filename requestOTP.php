<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fieldset>
        <legend>
            Send OTP
        </legend>
        <form action="sendOTP.php" method="POST">
            <div>
                <input type="text" name="email" required>
                <span>Email</span>
            </div>
            <button class="btnSend">Send</button>
        </form>
    </fieldset>
</body>
</html>