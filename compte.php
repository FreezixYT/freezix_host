<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <?php
include 'header.html';

session_start();
?>

    <main>
        <h2>Créer un compte</h2>

        <form action="index.php" method="POST" class="zone-form">
            <div class="form-group">
                <label for="username">Prénom</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="prenom">Nom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Créer</button>
            </div>
        </form>
    </main>


    <?php
include 'footer.html';
?>

</body>

</html>