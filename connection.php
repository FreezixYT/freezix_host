<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST | Connection</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<?php
include 'header.html';
?>

<main>
    <h2>Connexion</h2>

    <form action="#" method="POST">
        <div class="zone-form">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="text" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>
            <label><p>Pas de compte ? <a href="compte.php">Créer un compte</a></label>
        </div>
    </form>

</main>

<?php
include 'footer.html';
?>

</body>

</html>
