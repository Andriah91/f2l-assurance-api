<!DOCTYPE html>
<html>
<head>
    <title>Carte tiers - {{ $emailData['carte'] }}</title>
</head>
<body>
    <h1>Message</h1>
    F&eacute;licitation {{ $emailData['nom'] }}, votre carte - {{ $emailData['carte'] }} a &eacute;t&eacute; activ&eacute; avec succ&egrave;s.
    Vous pouvez voir votre carte avec notre application mobile.

    <img src="https://api.app.assurances-f2l.fr/public/storage/filaka/{{ $emailData['path'] }}" style="width:300px; height: auto">
</body>
</html>
