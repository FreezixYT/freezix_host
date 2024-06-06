<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# page ajout ticket support
# status : non terminer
?>

<?php

session_start();

// si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) 
{
    header('Location: connection.php');
    exit();
}

$success = false;

// Connexion à la base de données
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $servername = "localhost";
    $username = "nathan";
    $password = "Super";
    $dbname = "freezix_host";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Vérifier la connexion
    if ($conn->connect_error) 
    {
        die("Échec de la connexion : " . $conn->connect_error);
    }
    
    // Préparer et exécuter la requête d'insertion
    $contenue = $conn->real_escape_string($_POST['contenue']);
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO Ticket (user_id, date, contenue, resolue) VALUES ('$user_id', NOW(), '$contenue', FALSE)";
    
    // Si la requête est réussie, définir la variable de succès
    if ($conn->query($sql) === TRUE) 
    {
        $success = true;
    } 
    else 
    {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - Créer un Ticket</title>
    <style>
        button[type="submit"] 
        {
            background-color: #19ba19;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            padding: 10px;
            font-size: large;
            transition: background-color 500ms;
        }

        button[type="submit"]:hover 
        {
            background-color: #128d12;
            transition: background-color 500ms;
        }

        textarea 
        {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .success-message 
        {
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }

        .form-container 
        {
            display: <?php echo ($success) ? 'none' : 'block'; ?>;
        }

        .success-container 
        {
            display: <?php echo ($success) ? 'block' : 'none'; ?>;
        }
    </style>
</head>

<body>
<?php include 'header.html'; ?>

<main>
    <div class="form-container">
        <h1>Créer un Ticket de Support</h1>
        <form method="post" action="support.php">
            <label for="contenue">Description du problème:</label><br>
            <textarea id="contenue" name="contenue" rows="4" cols="50" required></textarea><br><br>
            
            <button type="submit">Envoyer</button>
        </form>
    </div>
    
    <!-- Afficher si l'envoie fonctionne -->
    <div class="success-container">
        <?php if ($success): ?>
            <p class="success-message">Succès! Votre ticket a été créé.</p>
            <a href="index.php"><button>Retour à l'accueil</button></a>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.html'; ?>
</body>

</html>
