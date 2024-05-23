<?php
include 'header.html';
// Connexion à la base de données
$servername = "localhost";
$username = "nathan";
$password = "Super";
$dbname = "freezix_host";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}

if (isset($_POST["envoyer"])) {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Sécuriser le mot de passe avec un hash
    $isAdmin = false; // Définir isAdmin sur false

    $sql = "INSERT INTO Compte (Prenom, Nom, Email, MotDePasse, isAdmin) VALUES (:prenom, :nom, :email, :password, :isAdmin)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":isAdmin", $isAdmin, PDO::PARAM_BOOL);

    if ($stmt->execute()) {
        // Redirection après création réussie du compte
        header("Location: Hebergement.php");
      
        $to = "nathan.pch2@eduge.ch";
        $subject = "vaildation";
        $message = "Bienvenue parmis nous ! "

        mail(
            string $to,
            string $subject,
            string $message,
            array|string $additional_headers = [],
            string $additional_params = ""
        ): bool
        exit(); 
    } else {
        echo "Erreur lors de la création du compte.";
    }
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

        <form action="Hebergement.php" method="post" class="zone-form">
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
