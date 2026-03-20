<?php
// index.php - Landing page for school portal
?>
<!DOCTYPE html>
<html>
<head>
    <title>School USSD Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .container {
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            background: #000;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
        .status {
            color: #4ade80;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏫 School USSD Portal</h1>
        <p>Your USSD school portal is live!</p>
        <div class="code">*254#</div>
        <p>Dial this code to access school services</p>
        <p>System Status: <span class="status">✅ Active</span></p>
        <hr>
        <small>Powered by Africa's Talking USSD</small>
    </div>
</body>
</html>