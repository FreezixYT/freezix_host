<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# page mon compte
# status : Terminer
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/button.css">
</head>
<body>
    
</body>
</html>
<?php
include 'header.html';
session_start();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['user_id'])) {
    header("Location: connection.php");
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "nathan";
$password = "Super";
$dbname = "freezix_host";

$connexion = new mysqli($servername, $username, $password, $dbname);
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}

// Récupération des données de l'utilisateur connecté depuis la base de données
$id_compte = $_SESSION['user_id'];
$sql_user = "SELECT prenom, nom, email FROM Compte WHERE idCompte='$id_compte'";
$resultat_user = $connexion->query($sql_user);

if ($resultat_user->num_rows > 0) {
    echo "<h1>Mon Compte</h1>";
    echo "<div>";
    echo "<a href='panier.php'><h3>Voir mon panier</h3></a>";
    echo "<table>";
    echo "<tr><th>Prénom</th><th>Nom</th><th>Email</th></tr>";
    while ($row = $resultat_user->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["prenom"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "<form method='post'>";
    echo "<button type='submit' name='deconnexion'>Déconnexion</button>";
    echo "</form>";
    echo "<form method='post' action='parametres.php'>";
    echo "<button type='submit' name='reglages'>Réglages</button>";
    echo "</form>";

    // Récupération des tickets de l'utilisateur depuis la base de données
    $sql_tickets = "SELECT idTicket, date, contenue, resolue FROM Ticket WHERE user_id='$id_compte'";
    $resultat_tickets = $connexion->query($sql_tickets);

    if ($resultat_tickets->num_rows > 0) {
        echo "<h2>Mes Tickets</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Date</th><th>Contenu</th><th>Résolu</th></tr>";
        while ($row = $resultat_tickets->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idTicket"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . htmlspecialchars($row["contenue"]) . "</td>";
            echo "<td>" . ($row["resolue"] ? 'Oui' : 'Non') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun ticket trouvé.</p>";
    }
} else {
    echo "Aucun résultat trouvé.";
}

$connexion->close();

// Déconnexion de l'utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deconnexion"])) 
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

include 'footer.html';
?>
<style>
h1
{
    color: white;
    text-align: center;
    margin-top: 10px;
    margin-bottom: 15px;
}
</style>
