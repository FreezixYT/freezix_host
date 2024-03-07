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
//// connexion.php
//
//session_start(); // Déplacez cette ligne au début
//
//// Vérifier si le formulaire est soumis
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    // Récupérer les données du formulaire
//    $nomUtilisateur = $_POST['username'];
//    $motDePasse = $_POST['password'];
//
//    // Effectuer la vérification de l'utilisateur (vous devrez implémenter cela en fonction de votre logique d'authentification)
//    // Si l'authentification réussit, définissez la variable de session et redirigez l'utilisateur
//    if (/* Votre logique d'authentification */) {
//        $_SESSION['nomUtilisateur'] = $nomUtilisateur;
//        header('Location: index.php');
//        exit();
//    } else {
//        // Afficher un message d'erreur si l'authentification échoue
//        echo "Erreur d'authentification";
//    }
//}
?>

<?php
include 'header.html';
?>

<main>
    <h2>Connexion</h2>

    <form action="connexion.php" method="POST"> <!-- Modifiez l'action pour pointer vers le bon fichier -->
        <div class="zone-form">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
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
