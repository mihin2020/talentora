<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 0;
      color: #333;
    }
    .container {
      background-color: #ffffff;
      max-width: 600px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 28px;
      color: #1E88E5;
      text-align: center;
      margin-bottom: 20px;
    }
    p {
      font-size: 16px;
      line-height: 1.6;
      color: #333;
    }
    .message-content {
      background-color: #f1f8ff;
      border-left: 4px solid #1E88E5;
      padding: 15px 20px;
      margin-top: 20px;
      font-size: 16px;
      color: #333;
      border-radius: 8px;
      box-sizing: border-box;
    }
    .footer {
      font-size: 14px;
      color: #777;
      text-align: center;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Message de Contact</h1>
    
    <div class="message-content">
      <p>{!! nl2br(e($messageContent)) !!}</p>
    </div>

    <div class="footer">
      &mdash; L’équipe de votre plateforme
    </div>
  </div>
</body>
</html>
