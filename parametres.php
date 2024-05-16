<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Paramètres</title>
</head>
<body>
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
            echo "<h1>Paramètres</h1>";
            echo "<form method='post'>";
            echo "Modifier les info";
            while ($row = $resultat->fetch_assoc()) {
                echo "<label for='prenom'>Prénom :</label>";
                echo "<input type='text' id='prenom' name='prenom' value='" . $row["prenom"] . "'>";
                echo "<label for='nom'>Nom :</label>";
                echo "<input type='text' id='nom' name='nom' value='" . $row["nom"] . "'>";
                echo "<label for='email'>Email :</label>";
                echo "<input type='email' id='email' name='email' value='" . $row["email"] . "'>";
                echo "<label for='mot_de_passe'>Mot de passe :</label>";
                echo "<input type='password' id='mot_de_passe' name='mot_de_passe'>";
            }
            echo "<button type='submit' name='modifier_parametres'>Enregistrer</button>";
            echo "</form>";
        } else {
            echo "Aucun résultat trouvé.";
        }
        $connexion->close();

        // Traitement de la mise à jour des paramètres
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier_parametres"])) {
            // Récupération des valeurs soumises par le formulaire
            $nouveau_prenom = $_POST['prenom'];
            $nouveau_nom = $_POST['nom'];
            $nouvel_email = $_POST['email'];
            $nouveau_mot_de_passe = $_POST['mot_de_passe'];

            // Requête SQL pour mettre à jour les informations dans la base de données
            $sql_update = "UPDATE Compte SET prenom='$nouveau_prenom', nom='$nouveau_nom', email='$nouvel_email'";
            // Vérification si le mot de passe a été modifié
            if (!empty($nouveau_mot_de_passe)) {
                $hash_mot_de_passe = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
                $sql_update .= ", MotDePasse='$hash_mot_de_passe'";
            }
            $sql_update .= " WHERE idCompte='$id_compte'";

            if ($connexion->query($sql_update) === TRUE) {
                echo "Paramètres mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des paramètres : " . $connexion->error;
            }
        }
    ?>
    <?php include 'footer.html'; ?>
</body>
</html>
