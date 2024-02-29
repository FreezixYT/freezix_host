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

session_start();
?>

<div class="slogant">
    <h2>Un Service d'hébergement de qualité incomparable</h2>
    <br>
    <h1>Petit prix, grande performance</h1>
</div>

<?php
$connection = true;

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
