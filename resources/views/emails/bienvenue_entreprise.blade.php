<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription confirmée</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
      color: #333;
      padding: 40px;
    }
    .container {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
      padding: 30px;
    }
    h1 {
      font-size: 24px;
      color: #1E88E5;
    }
    p {
      font-size: 16px;
      line-height: 1.6;
    }
    .password-box {
      background-color: #e3f2fd;
      color: #0d47a1;
      padding: 12px 18px;
      border-radius: 8px;
      font-weight: bold;
      font-size: 18px;
      text-align: center;
      margin: 20px 0;
    }
    .alert {
      color: #d84315;
      background-color: #fff3e0;
      padding: 10px 15px;
      border-left: 4px solid #ff9800;
      border-radius: 5px;
      font-weight: 500;
    }
    .footer {
      margin-top: 30px;
      font-size: 14px;
      color: #777;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Bonjour {{ $entreprise->firstname }},</h1>

    <p>Merci pour votre inscription sur notre plateforme.</p>

    <p>Voici votre mot de passe temporaire :</p>
    <div class="password-box">{{ $password }}</div>

    <div class="alert">
      ⚠️ Vous ne pourrez vous connecter qu’une fois que votre compte aura été validé par un administrateur.
    </div>

    <p>Merci pour votre confiance.</p>

    <div class="footer">
      &mdash; L’équipe de la plateforme
    </div>
  </div>
</body>
</html>
