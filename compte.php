<?php
# Nathan Pache
# IDA-P1A
# 02.05.2024
# page creation compte
# status : Terminer
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<?php include 'header.html'; ?>
<body>
    <main>
        <h2>Créer un compte</h2>

        <form action="compte.php" method="post" class="zone-form">
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

</body>
</html>

<?php
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

if (isset($_POST["envoyer"])) 
{
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    // par defaul, user pas en admin. 
    $isAdmin = false; 

    //requete sql 
    $sql = "INSERT INTO Compte (Prenom, Nom, Email, MotDePasse, isAdmin) VALUES (:prenom, :nom, :email, :password, :isAdmin)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":isAdmin", $isAdmin, PDO::PARAM_BOOL);

    if ($stmt->execute()) 
    {
        // Redirection après création réussie du compte
        header("Location: Hebergement.php");
        exit(); 
    } 
    else 
    {
        echo "Erreur lors de la création du compte.";
    }
}
include 'footer.html'; 
?>