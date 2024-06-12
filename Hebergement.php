<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# hébergement
# status : non teminer
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST | Hébergement</title>
    <link rel="stylesheet" href="/css/button.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<?php
include 'header.html';

session_start();

// chaine de connection
$servername = "localhost";
$username = "nathan";
$password = "Super";
$dbname = "freezix_host";

// connection
$conn = new mysqli($servername, $username, $password, $dbname);

// verification
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

// afficher les 3 dernier commentaire.
$sql = "SELECT Commentaire.Contenu, Commentaire.DateCommentaire, Compte.Nom, Commentaire.note
        FROM Commentaire
        JOIN Compte ON Commentaire.idUtilisateur = Compte.idCompte
        ORDER BY Commentaire.DateCommentaire DESC
        LIMIT 3";

$result = $conn->query($sql);
?>

<main class="hebergement">
    <style>
        .svg 
        {
            width: 200%;
        }
    </style>
    <h1>Nos services d'hébergement</h1>
    <p class="centre">Découvrez nos 3 formules web</p>

    <p class="best">Le plus vendu</p>
    <div class="offres">
        <div class="zone-gray">
            <h2>Basique</h2>
            <p class="centre">Parfait pour les sites web personnels et petits blogs</p>
            <br>
            <ul>
                <li>&#10004; 100 Go stockage</li>
                <li>&#10004; 50 G0 bande passante</li>
                <li>&#10004; DNS protégé</li>
                <li>&#10004; 1 Email gratuit</li>
                <li>&#10004; Support 24/7</li>
            </ul>
            <hr>
            <p class="centre">2 CHF / mois</p>
            <form action="panier.php" method="post">
    <input type="hidden" name="idProduit" value="1">
    <button type="submit">Acheter</button>
</form>

            <br>
            <hr>
            <br>
            <ul>
                <li>&#10004; 1 site web hébergé</li>
                <li>&#10004; Version basique de WordPress</li>
                <li>&#10004; Protection Anti DDOS standard</li>
                <li>&#10004; Formule IA basique</li>
                <li>&#10004; Remboursement sous 24 heures</li>
            </ul>
        </div>
        
        <div class="zone-gray">
            <h2>Medium</h2>
            <p class="centre">Pour les sites de petites entreprises désirant de la puissance</p>
            <br>
            <ul>
                <li>&#10004; 200 Go stockage</li>
                <li>&#10004; 100 Go bande passante</li>
                <li>&#10004; DNS protégé</li>
                <li>&#10004; 10 Emails gratuits</li>
                <li>&#10004; Support 24/7</li>
            </ul>
            <hr>
            <p class="centre">4 CHF / mois</p>
            <form action="panier.php" method="post">
    <!-- Champ hidden pour stocker l'ID du produit -->
    <input type="hidden" name="idProduit" value="2">
    <!-- Bouton "Acheter" -->
    <button type="submit">Acheter</button>
</form>

            <br>
            <hr>
            <br>
            <ul>
                <li>&#10004; 1 site web hébergé</li>
                <li>&#10004; Version basique de WordPress</li>
                <li>&#10004; Protection Anti DDOS standard</li>
                <li>&#10004; Formule IA basique</li>
                <li>&#10004; Remboursement sous 24 heures</li>
                <li>&#10004; Booster avec l'IA</li>
            </ul>
        </div>

        <div class="zone-gray">
            <h2>Pro</h2>
            <p class="centre">Profitez d'un maximum de performances</p>
            <br>
            <ul>
                <li>&#10004; 300 Go stockage</li>
                <li>&#10004; 200 Go bande passante</li>
                <li>&#10004; DNS protégé</li>
                <li>&#10004; 100 Emails gratuits</li>
                <li>&#10004; Support 24/7</li>
            </ul>
            <hr>
            <p class="centre">8 CHF / mois</p>
            <form action="panier.php" method="post">
    <input type="hidden" name="idProduit" value="3">
    <!-- Bouton "Acheter" -->
    <button type="submit">Acheter</button>
</form>
            <br>
            <hr>
            <br>
            <ul>
                <li>&#10004; 1 site web hébergé</li>
                <li>&#10004; Version basique de WordPress</li>
                <li>&#10004; Protection Anti DDOS standard</li>
                <li>&#10004; Formule IA basique</li>
                <li>&#10004; Remboursement sous 24 heures</li>
            </ul>
        </div>
    </div>
    <div class="block-demo">
        <h1>Nos services sont disponibles dans le monde entier</h1>
        <img src="img/map.svg" alt="world" width="50%" class="svg">
    </div>
    <div class="block-demo">
        <h1>Un service client de qualité</h1>
        <div class="sav">
            <ol>
                <li>&#10004; Service client compétent</li>
                <li>&#10004; Disponible 24h/24 et 7j/7</li>
                <li>&#10004; Tutos de qualité sur YouTube</li>
                <li>&#10004; Dépannage en moins de 5 minutes</li>
            </ol>
            <img src="/img/sav.svg" alt="sav" width="20%" class="svg">        
        </div>
    </div>
    <hr>

 <!-- ESPACE COMMENTAIRE-->
 <h1>Avis</h1>
    <div class="zone-avis">
    <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) 
                {
                    echo '<div class="avis">';
                    echo '<div class="pseudo">';
                    echo '<p>@' . htmlspecialchars($row["Nom"]) . '</p>';

                    // Affichager des étoiles en fonction de la note
                    $note = intval($row["note"]); // Convertir la note en entier
                    echo '<p>';
                    for ($i = 0; $i < $note; $i++) {
                        echo '&#9733;'; // Afficher une étoile
                    }
                    echo '</p>';

                    echo '</div>';
                    echo '<p>' . htmlspecialchars($row["Contenu"]) . '</p>';
                    echo '<br>';
                    echo '<p>' . htmlspecialchars($row["DateCommentaire"]) . '</p>';
                    echo '</div>';
                }
            } 
            else 
            {
                echo '<p>aucun commentaire trouvé</p>';
            }
            ?>
    </div>
    <?php if (isset($_SESSION['user_id'])): ?>
            <div class="add-comment">
                <button onclick="window.location.href='commentaire.php'">Ajouter un commentaire</button>
            </div>
        <?php endif; ?>
</main>
<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérez l'ID du produit à partir du formulaire
if (isset($_POST['idProduit'])) {
    $idProduit = $_POST['idProduit'];

    // Ajoutez le produit au panier dans la base de données
    // Ici, vous pouvez exécuter une requête SQL pour ajouter le produit au panier
    // Assurez-vous de remplacer "votre_requete_sql" par votre propre requête SQL pour ajouter le produit au panier
    // et de gérer les erreurs de requête SQL si nécessaire
    // Exemple :
    /*
    $sql = "INSERT INTO Panier (idUtilisateur, idProduit, Quantite) VALUES ($_SESSION['user_id'], $idProduit, 1)";
    if ($conn->query($sql) === TRUE) {
        echo "Produit ajouté au panier avec succès.";
    } else {
        echo "Erreur lors de l'ajout du produit au panier: " . $conn->error;
    }
    */
} else {
    // Redirigez l'utilisateur vers la page précédente si l'ID du produit n'est pas défini
    header("Location: javascript://history.go(-1)");
    exit();
}
?>

<?php
include 'footer.html';
?>
</body>
</html>