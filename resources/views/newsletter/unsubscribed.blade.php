<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Désabonnement — Le Goût du Délice</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#0F0F0F;min-height:100vh;display:flex;align-items:center;font-family:'Merriweather',serif">
    <div class="container text-center" style="color:white">
        <i class="bi bi-emoji-frown" style="font-size:60px;color:#ffd700"></i>
        <h2 class="mt-4">Vous êtes désabonné(e)</h2>
        <p style="color:rgba(255,255,255,0.6)">Vous ne recevrez plus nos newsletters. N'hésitez pas à vous réabonner à tout moment.</p>
        <a href="{{ route('home') }}" class="btn btn-warning mt-3" style="border-radius:50px;padding:10px 30px">
            Retour à l'accueil
        </a>
    </div>
</body>
</html>