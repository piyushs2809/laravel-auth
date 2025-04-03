<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            background: #f4f4f4;
            padding: 10px;
            display: inline-block;
            margin: 10px 0;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hello!</h2>
    <p>Thank you for registering. To complete your registration, please use the verification code below:</p>
    
    <p class="code">{{ $verificationCode }}</p>

    <p>If you did not request this registration, please ignore this email.</p>

    <p class="footer">Best Regards,<br>Your Company Name</p>
</div>

</body>
</html>
