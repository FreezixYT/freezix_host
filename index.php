<?php
# Page d'accueil
# Nathan Pache
# IDA-P1A
# 16.05.2024
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
include 'header.html';
?>

<h2>Un Service d'hébergement de qualité incomparable</h2>
<div class="slogant">    
    <h1>Petit prix, grande performance</h1>
</div>

<?php
session_start();

//connection
$connection = isset($_SESSION['user_id']);

// Afficher co-toi.html uniquement si l'utilisateur n'est pas connecter
if (!$connection) {
    include 'co-toi.html';
}

?>
  <main>
        <div class="zone">
            <h1>Serveur de jeux</h1>
            <p>Hebergement de serveur Minecraft</p>
            <div class="flex">
                <img src="/img/serveur.svg" alt="serveur" width="10%"  class="svg">
                <h1>Dès 4.50 .- / mois</h1>
            </div>
        </div>

        <div class="zone">
            <h1>Site web</h1>
            <p>Hebergement de site web</p>
            <div class="flex">
                <img src="/img/web.svg" alt="web-logo" width="10%" class="svg">
                <h1>Dès 1.50 .- / mois</h1>
            </div>
        </div>

        <div class="zone">
            <h1>Cloud</h1>
            <p>Stockage de fichier a petit prix !</p>
            <div class="flex">
                <img src="/img/cloud.svg" alt="cloud" width="10%"  class="svg">
                <h1>Dès 2 .- / mois</h1>
            </div>
        </div>

    </main>

    <?php
        include 'footer.html';
    ?>

</body>
</html>
