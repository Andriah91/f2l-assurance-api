<!DOCTYPE html>
<html>
<head>
    <title>Carte tiers - {{ $emailData['carte'] }}</title>
</head>
<body>
    <h2>Bonjour {{ $emailData['nom'] }},</h2>
    {{ $emailData['message'] }}
    Vous pouvez voir votre carte avec notre application mobile.

    <img src="https://api.app.assurances-f2l.fr/public/storage/filaka/{{ $emailData['path'] }}" style="width:300px; height: auto">
</body>
</html>
