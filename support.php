<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connection.php");
    exit();
}

// Traitez le formulaire lorsqu'il est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $contenue = $_POST['contenue'];

    // Chaine de connection
    $servername = "localhost";
    $username = "nathan";
    $password = "Super";
    $dbname = "freezix_host";

    // Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Ticket (user_id, contenue) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $contenue);
    if ($stmt->execute()) {
        echo "Ticket créé avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Ticket</title>
</head>
<body>
    <?php include 'header.html'; ?>

    <h1>Créer un Ticket de Support</h1>
    <form method="post" action="moncompte.php">
        <label for="contenue">Description du problème:</label><br>
        <textarea id="contenue" name="contenue" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Envoyer</button>
    </form>

    <?php include 'footer.html'; ?>
</body>
</html>
<style>
    h1, p, label {
        color: #fff;
        text-align: center; 
    }


    input, button {
        display: block; 
        margin: 0 auto; 
    }
</style>

