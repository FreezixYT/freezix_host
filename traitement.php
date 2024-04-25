<?php
$servername = "http://localhost/phpmyadmin";
$username = "nathan";
$password = "1223Colo";
$dbname = "freezix_host";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

if(isset($_POST["ok"])) {
    $prenom = $_POST["firstName"];
    $nom = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Utilisation de requête préparée pour éviter les injections SQL
    $requete = $bdd->prepare("INSERT INTO users VALUES (0, :prenom, :nom, :email, :password)");
    $requete->execute(array(
        "prenom" => $prenom,
        "nom" => $nom,
        "email" => $email,
        "password" => $password
    ));
}
?>
