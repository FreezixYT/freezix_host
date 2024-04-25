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
session_start();
include 'header.html';

// Connexion à la base de données
$servername = "localhost";
$username = "nathan";
$password = "Super";
$dbname = "freezix_host";

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch (PDOException $e)
{
    echo "La connexion a échoué : " . $e->getMessage(); 
}

if (isset($_POST["email"]) && isset($_POST["password"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `compte` WHERE `email` = :email AND `password` = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user)
    {
        // si connecection reussi redirection vers l'aceuil
        header("Location: index.php");
        exit();
    }

    else
    {
        echo "Identifiants incorrects";
    }
}
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
