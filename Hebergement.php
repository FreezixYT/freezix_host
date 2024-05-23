<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST | Hébergement</title>
    
</head>

<body>
<?php
include 'header.html';

session_start();

include 'hebergement.html';

// chaine de connection
$servername = "localhost";
$username = "nathan";
$password = "Super";
$dbname = "freezix_host";

// connection
$conn = new mysqli($servername, $username, $password, $dbname);

// verification
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// afficher les 3 dernier commentaire avec la note de 5 etoile :)
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
                <input type="hidden" name="produit" value="Basique">
                <input type="hidden" name="prix" value="2">
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
                <input type="hidden" name="produit" value="Medium">
                <input type="hidden" name="prix" value="4">
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
                <input type="hidden" name="produit" value="Pro">
                <input type="hidden" name="prix" value="8">
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
                while ($row = $result->fetch_assoc()) {
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
include 'footer.html';
?>
</body>
<style>
        button[type="submit"] , button
        {
            background-color: #19ba19;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            min-height: 48px;
            text-align: center;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
            padding: 10px;
            font-size: x-large;
            transition: background-color 500ms;
        }

        button[type="submit"]:hover , button:hover 
        {
            background-color: #128d12;
            transition: background-color 500ms;
        }
    </style>
</html>

<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Chaine de connexion à la base de données
$servername = "localhost";
$username = "nathan";
$password = "Super";
$dbname = "freezix_host";

// Connection à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gestion de l'ajout au panier
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produit']) && isset($_POST['prix'])) {
    $user_id = $_SESSION['user_id'];
    $produit = $_POST['produit'];
    $prix = $_POST['prix'];

    // Vérifier si l'utilisateur a déjà un panier
    $sql = "SELECT * FROM Panier WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // L'utilisateur a déjà un panier, ajout de l'item
        $row = $result->fetch_assoc();
        $panier_id = $row['idPanier'];
    } else {
        // Création d'un nouveau panier pour l'utilisateur
        $sql = "INSERT INTO Panier (user_id) VALUES ($user_id)";
        if ($conn->query($sql) === TRUE) {
            $panier_id = $conn->insert_id;
        } else {
            echo "Erreur lors de la création du panier: " . $conn->error;
        }
    }

    // Ajout de l'item au panier
    $sql = "INSERT INTO PanierItem (panier_id, produit, prix) VALUES ($panier_id, '$produit', $prix)";
    if ($conn->query($sql) === TRUE) {
        echo "Item ajouté au panier avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'item au panier: " . $conn->error;
    }
}
?>
