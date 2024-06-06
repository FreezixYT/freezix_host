<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# ajout page panier
# status : non Terminer
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Panier</title>
</head>

<body>
    <main>
    <?php
    include 'header.html';

    session_start();

    if (!isset($_SESSION['user_id'])) 
    {
        // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
        header("Location: connection.php");
        exit();
    }

    // Connexion à la base de données
    $servername = "localhost";
    $username = "nathan";
    $password = "Super";
    $dbname = "freezix_host";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produit'], $_POST['prix'])) {
            // Récupérer les données du formulaire
            $produit = $_POST['produit'];
            $prix = $_POST['prix'];
            $user_id = $_SESSION['user_id'];

            // Insérer le produit dans le panier de l'utilisateur
            $sql = "INSERT INTO panier (user_id, produit, prix) VALUES (:user_id, :produit, :prix)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':produit', $produit);
            $stmt->bindParam(':prix', $prix);
            $stmt->execute();

            echo "<p>Produit ajouté au panier avec succès.</p>";
        }

        // Afficher le contenu du panier
        $sql = "SELECT produit, prix FROM Panier WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $panier = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($panier) 
        {
            echo "<h2>Votre panier</h2>";
            echo "<table>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                    </tr>";
            foreach ($panier as $item) {
                echo "<tr>
                        <td>" . htmlspecialchars($item['produit']) . "</td>
                        <td>" . htmlspecialchars($item['prix']) . " CHF</td>
                      </tr>";
            }
            echo "</table>";
        } 

        else 
        {
            echo "<p>Votre panier est vide.</p>";
        }

    } 
    
    catch (PDOException $e) 
    {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
    ?>

    <?php include 'footer.html'; ?>
    </main>
</body>
</html>