<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>FREEZ HOST | ADMIN</title>
</head>

<body>
    <main>
        <?php
        session_start();
        include 'header.html';
/*
        // Vérifier si l'utilisateur est connecté et est un administrateur
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
            header("Location: connexion.php");
            exit();
        }
        */

        // Connexion à la base de données
        $servername = "localhost";
        $username = "nathan";
        $password = "Super";
        $dbname = "freezix_host";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Échec de la connexion à la base de données : " . $e->getMessage());
        }

        // Requête SQL pour récupérer les données
        $sql = "SELECT Prenom, Nom, Email FROM Compte";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Vérification des résultats et affichage des données dans le tableau
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            echo "<h1>Panel Admin</h1>";
            echo "<h2>Compte</h2>";
            echo "<table>";
            echo "<tr><th>Prénom</th><th>Nom</th><th>Email</th></tr>";
            // Boucler à travers chaque ligne de résultat
            foreach ($results as $row) {
                // Afficher les données dans le tableau
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["Prenom"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Nom"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucun résultat trouvé.</p>";
        }
        // Récupérer les tickets depuis la base de données
$sql = "SELECT idTicket, user_id, date, contenue, resolue FROM Ticket";
$stmt = $conn->prepare($sql);
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher les tickets dans un tableau
if ($tickets) {
    echo "<h2>Tickets</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Utilisateur</th><th>Date</th><th>Contenu</th><th>Résolu</th><th>Action</th></tr>";
    foreach ($tickets as $ticket) {
        echo "<tr>";
        echo "<td>" . $ticket['idTicket'] . "</td>";
        echo "<td>" . $ticket['user_id'] . "</td>";
        echo "<td>" . $ticket['date'] . "</td>";
        echo "<td>" . htmlspecialchars($ticket['contenue']) . "</td>";
        echo "<td>" . ($ticket['resolue'] ? 'Oui' : 'Non') . "</td>";
        echo "<td>";
        // Bouton pour marquer comme résolu
        if (!$ticket['resolue']) {
            echo "<form method='post' action='close_ticket.php'>";
            echo "<input type='hidden' name='ticket_id' value='" . $ticket['idTicket'] . "'>";
            echo "<button type='submit'>Fermer</button>";
            echo "</form>";
        }
        // Bouton pour supprimer
        echo "<form method='post' action='delete_ticket.php'>";
        echo "<input type='hidden' name='ticket_id' value='" . $ticket['idTicket'] . "'>";
        echo "<button type='submit'>Supprimer</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Aucun ticket trouvé.</p>";
}

        // Fermer la connexion à la base de données
        $conn = null;

        include 'footer.html';
        ?>
        <style>
            h1 {
                text-align: center;
                margin-top: 10px;
                margin-bottom: 50px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 1em;
                min-width: 400px;
                border: 1px solid #dddddd;
            }
            table th, table td {
                padding: 12px 15px;
                border: 1px solid #dddddd;
                text-align: left;
            }
            table th {
                background-color: #f2f2f2;
            }
        </style>
    </main>
</body>

</html>
