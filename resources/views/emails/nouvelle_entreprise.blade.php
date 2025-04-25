<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nouvelle inscription entreprise</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
      color: #333;
      padding: 40px 0;
      margin: 0;
    }
    .container {
      background-color: #ffffff;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 22px;
      color: #1E88E5;
      margin-bottom: 20px;
    }
    p {
      font-size: 16px;
      line-height: 1.6;
    }
    ul {
      list-style: none;
      padding: 0;
      margin: 20px 0;
    }
    ul li {
      background-color: #f1f8ff;
      margin-bottom: 10px;
      padding: 10px 15px;
      border-left: 4px solid #1E88E5;
      border-radius: 6px;
      font-size: 15px;
    }
    strong {
      color: #0d47a1;
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
    <h1>Bonjour cher administrateur,</h1>

    <p>Une nouvelle entreprise vient de s'inscrire :</p>

    <ul>
      <li><strong>Nom :</strong> {{ $entreprise->firstname }}</li>
      <li><strong>Email :</strong> {{ $entreprise->email }}</li>
      <li><strong>Téléphone :</strong> {{ $entreprise->phone }}</li>
    </ul>

    <p>Merci de bien vouloir valider son inscription depuis votre interface admin.</p>

    <div class="footer">
      &mdash; Notification automatique de la plateforme
    </div>
  </div>
</body>
</html>
