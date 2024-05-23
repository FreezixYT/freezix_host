<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# page ajout commentaire

session_start();

// si l'user est pas loger le rediriger sur la page de connection
if (!isset($_SESSION['user_id'])) 
{
    header('Location: connection.php');
    exit();
}

//connection a la base de donner
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $servername = "localhost";
    $username = "nathan";
    $password = "Super";
    $dbname = "freezix_host";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
// requete d'insertion
    $contenu = $conn->real_escape_string($_POST['contenu']);
    $note = (int) $_POST['note'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO Commentaire (Contenu, DateCommentaire, Note, idUtilisateur) VALUES ('$contenu', NOW(), '$note', '$user_id')";
    
    // si la requete est bien envoyer, rediriger vers la page d^héberegement
    if ($conn->query($sql) === TRUE) {
        header('Location: hebergement.php');
        exit();
    } 
    
    // sinon afficher l'erreur
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Commentaire</title>

    <!-- formualir de notation étoile génerer par chatgpt-->
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

        .rating 
        {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            padding: 10px;
        }

        .rating input 
        {
            display: none;
        }

        .rating label 
        {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
        }

        .rating input:checked ~ label,
        .rating input:hover ~ label,
        .rating label:hover,
        .rating label:hover ~ label 
        {
            color: #f5b301;
        }
    </style>
</head>

<body>
<?php include 'header.html'; ?>

<main>
    <h1>Ajouter un Commentaire</h1>
    <form method="post" action="commentaire.php">
        <label for="contenu">Votre commentaire:</label><br>
        <textarea id="contenu" name="contenu" rows="4" cols="50" required></textarea><br><br>
        
        <label for="note">Votre note:</label><br>
        <div class="rating">
            <input type="radio" id="star5" name="note" value="5" required /><label for="star5">&#9733;</label>
            <input type="radio" id="star4" name="note" value="4" /><label for="star4">&#9733;</label>
            <input type="radio" id="star3" name="note" value="3" /><label for="star3">&#9733;</label>
            <input type="radio" id="star2" name="note" value="2" /><label for="star2">&#9733;</label>
            <input type="radio" id="star1" name="note" value="1" /><label for="star1">&#9733;</label>
        </div><br><br>
        
        <button type="submit">Envoyer</button>
    </form>
</main>

<?php include 'footer.html'; ?>
</body>

</html>
