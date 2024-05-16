<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>FREEZ HOST | Mon Compte</title>
</head>
<body>
    <main>
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
        $sql = "SELECT prenom, nom, email FROM Compte WHERE idCompte='$id_compte'";
        $resultat = $connexion->query($sql);

        if ($resultat->num_rows > 0) {
            echo "<h1>Mon Compte</h1>";
            echo "<div>";
            echo "<a href='panier.php'><h3>Voir mon panier</h3></a>";
            echo "<table>";
            echo "<tr><th>Prénom</th><th>Nom</th><th>Email</th></tr>";
            while ($row = $resultat->fetch_assoc()) {
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
        } else {
            echo "Aucun résultat trouvé.";
        }
        $connexion->close();

        // Déconnexion de l'utilisateur
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deconnexion"])) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }

        include 'footer.html';
    ?>
    <style>
        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #128d12;
        }

        h1 {
            text-align: center;
            margin-top: 10px;
        }
    </style>
    </main>
</body>
</html>
