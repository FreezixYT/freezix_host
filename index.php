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
session_start();
$_SESSION['montant'] = 0; 
?>


<?php
include 'header.html';
?>


    <h2>Un Service d'hébergement de qualité incomparable</h2>
<div class="slogant">    
    <h1>Petit prix, grande performance</h1>
</div>

<?php
$connection = false;

// Vérifier l'état de connexion
if ($connection == false)
{
    include 'co-toi.html';
}

include 'main.html';
?>

<?php
include 'footer.html';
?>
</body>
</html>
