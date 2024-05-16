<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST | Connexion</title>
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

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "La connexion a bien été établie";
} catch (PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM Compte WHERE Email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["MotDePasse"])) {
        // Authentification réussie, démarrer une session utilisateur
        $_SESSION["user_id"] = $user["idCompte"];
        $_SESSION["user_name"] = $user["Prenom"];
        header("Location: hebergement.php");
        exit();
    } else {
        // Authentification échouée
        $login_error = "Email ou mot de passe incorrect.";
    }
}
?>

<main>
    <h2>Connexion</h2>
    <?php if (isset($login_error)): ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
    <?php endif; ?>

    <form action="" method="POST"> <!-- Modifié pour pointer vers la même page -->
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
            <p style="color: white;">Pas de compte ? <a href="compte.php">Créer un compte</a></p>
        </div>
    </form>
</main>

<?php include 'footer.html'; ?>

</body>

</html>
