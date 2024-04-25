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
        include 'header.html';

        session_start();

        //connection a la base
        $servername = "localhost";
        $username = "nathan";
        $password = "Super";
        $dbname = "freezix_host";

        $connexion = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($connexion->connect_error) 
        {
            die("Échec de la connexion à la base de données : " . $connexion->connect_error);
        }

        // Requête SQL pour récupérer les données
        $sql = "SELECT prenom, nom, email FROM compte";

        // Exécution de la requête
        $resultat = $connexion->query($sql);

        // Vérification des résultats et affichage des données dans le tableau
        if ($resultat->num_rows > 0) {
            echo "<h1>Panel Admin</h1>";
            echo "<table>";
            echo "<tr><th>Prénom</th><th>Nom</th><th>Email</th></tr>";
            // Boucler à travers chaque ligne de résultat
            while ($row = $resultat->fetch_assoc()) {
                // Afficher les données dans le tableau
                echo "<tr>";
                echo "<td>" . $row["prenom"] . "</td>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else 
        {
            echo "Aucun résultat trouvé.";
        }

        // Fermer la connexion à la base de données
        $connexion->close();

        include 'footer.html';
        ?>
        <style>
    h1 
    {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 50px;
    }
    </style>
    </main>
</body>

</html>
