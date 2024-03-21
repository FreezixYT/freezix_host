<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>



    <main>
        <h2>Créer un compte</h2>

        <form action="traitement.php" method="POST" class="zone-form">
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="ok">Créer</button>
            </div>
        </form>
    </main>


    <?php
include 'footer.html';
?>

</body>

</html>