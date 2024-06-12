<?php
# Nathan Pache
# IDA-P1A
# 06.06.2024
# page de parametre
# status : finis 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/parametres.css">
    <link rel="stylesheet" href="/css/button.css">
    <title>Paramètres</title>
</head>
<body>
    <?php
        include 'header.html';
        session_start();

        // si l'user est pas co, le rediriger vers le formulair de connection
        if (!isset($_SESSION['user_id'])) 
        {
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
        $sql = "SELECT prenom, nom, email, MotDePasse FROM Compte WHERE idCompte='$id_compte'";
        $resultat = $connexion->query($sql);

        //affichier tout les donner de l'utilisateur dans les inpute du form
        if ($resultat->num_rows > 0) 
        {
            echo "<h1>Paramètres</h1>";
            echo "<div class='form-container'>";
            echo "<form method='post'>";
            echo "<h2>Modifier les informations</h2>";
            while ($row = $resultat->fetch_assoc()) 
            {
                echo "<label for='prenom'>Prénom :</label>";
                echo "<input type='text' id='prenom' name='prenom' value='" . $row["prenom"] . "' required>";
                echo "<label for='nom'>Nom :</label>";
                echo "<input type='text' id='nom' name='nom' value='" . $row["nom"] . "' required>";
                echo "<label for='email'>Email :</label>";
                echo "<input type='email' id='email' name='email' value='" . $row["email"] . "' required>";
                echo "<label for='mpd'>Mot de passe actuel :</label>";
                echo "<input type='password' id='mpd' name='mpd' required>";
            }
            echo "<button type='submit' name='valider'>Enregistrer</button>";
            echo "</form>";
            echo "</div>";
        } 
        else 
        {
            echo "Aucun résultat trouvé.";
        }
        $connexion->close();

        // envoie des donnée a la bdd
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["valider"])) 
        {
            // Récupération des valeurs du formulaire
            $nouveau_prenom = $_POST['prenom'];
            $nouveau_nom = $_POST['nom'];
            $nouvel_email = $_POST['email'];
            $mpd = $_POST['mpd'];

            // conection pour maj
            $connexion = new mysqli($servername, $username, $password, $dbname);
            if ($connexion->connect_error) 
            {
                die("Erreur de connexion à la base de données : " . $connexion->connect_error);
            }

            // Récupération du mot de passe actuel de l'utilisateur pour vérification
            $sql = "SELECT MotDePasse FROM Compte WHERE idCompte='$id_compte'";
            $resultat = $connexion->query($sql);

            if ($resultat->num_rows > 0) {
                $row = $resultat->fetch_assoc();
                $mot_de_passe_hash = $row['MotDePasse'];

                // Vérification du mot de pass
                if (password_verify($mpd, $mot_de_passe_hash)) {
                    // Requête SQL pour mettre à jour les informations dans la base de données
                    $sql_update = "UPDATE Compte SET prenom='$nouveau_prenom', nom='$nouveau_nom', email='$nouvel_email' WHERE idCompte='$id_compte'";
                    if ($connexion->query($sql_update) === TRUE) 
                    {
                        header("Location: moncompte.php");
                        exit();
                    } 
                }
                
                //sinon ca met pas les info a jours.
                 else 
                {
                    echo "<script>alert('Mot de passe actuel incorrect. Veuiiler reasayer');</script>";
                }
            }

            $connexion->close();
        }
    ?>
    <?php include 'footer.html'; ?>
</body>
</html>