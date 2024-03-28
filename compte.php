<?php
// Connexion à la base de données
$servername = "localhost";
$username = "nathan";
$password = "1223Colo";
$dbname = "freezix_host";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    echo "La connexion a bien été établie";
}
catch (PDOException $e){
    echo "La connexion a échoué : " . $e->getMessage(); 
}

if(isset($_POST["envoyer"]))
{
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "INSERT INTO `compte`(`prenom`, `nom`, `email`, `password`) VALUES (:prenom, :nom, :email, :password)";
    $stml = $conn->prepare($sql);

    $stml->bindParam(":prenom", $prenom);
    $stml->bindParam(":nom", $nom);
    $stml->bindParam(":email", $email);
    $stml->bindParam(":password", $password);
    $stml->execute();
}
?>


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

        <form action="" method="post" class="zone-form">
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
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
                <button type="submit" name="envoyer">Créer</button>
            </div>
        </form>
    </main>


    <?php include 'footer.html'; ?>

</body>

</html>
