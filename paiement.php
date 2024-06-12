<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# formulair de payement
# status : Terminer
?>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$success = false;
$montant = isset($_SESSION['montant']) ? $_SESSION['montant'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cartnumber']) && isset($_POST['cvc']) && isset($_POST['date'])) {
    // Vérifier que tous les champs du formulaire sont remplis
    $cartNumber = $_POST['cartnumber'];
    $cvc = $_POST['cvc'];
    $date = $_POST['date'];

    if (!empty($cartNumber) && !empty($cvc) && !empty($date)) {
        $servername = "localhost";
        $username = "nathan";
        $password = "Super";
        $dbname = "freezix_host";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }

        $userId = $_SESSION['user_id'];
        $cartNumber = $conn->real_escape_string($cartNumber);
        $cvc = $conn->real_escape_string($cvc);
        $date = $conn->real_escape_string($date);

        // Simulation de validation de paiement réussi
        $datePaiement = date('Y-m-d H:i:s'); 

        // Enregistrement des informations de paiement dans la base de données
        $sql = "INSERT INTO Paiement (idUtilisateur, Montant, DatePaiement, MethodePaiement, StatutPaiement)
                VALUES ($userId, $montant, '$datePaiement', 'Carte de crédit', 'Réussi')";

        if ($conn->query($sql) === TRUE) {
            $success = true;
            
            // Vider le panier après paiement réussi
            $sql = "DELETE FROM Panier WHERE idUtilisateur = $userId";
            if ($conn->query($sql) !== TRUE) {
                echo "Erreur lors du vidage du panier: " . $conn->error;
            }
        } else {
            echo "Erreur lors de l'enregistrement du paiement : " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Veuillez remplir tous les champs du formulaire de paiement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST | Paiement</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php include 'header.html'; ?>
<main>
    <h2>Paiement</h2>
    <br>
    <br>
    <?php if ($success): ?>
        <p class="success-message">Paiement réussi! Merci pour votre achat.</p>
        <a href="index.php"><button>Retour à l'accueil</button></a>
    <?php else: ?>
        <h4>Montant : <?php echo $montant; ?> CHF</h4>
        <form method="post" class="zone-form">
            <div class="form-group">
                <label for="cartnumber">Numéro de carte</label>
                <input type="text" id="cartnumber" name="cartnumber" required>
            </div>
            <div class="form-group">
                <label for="cvc">CVC</label>
                <input type="text" id="cvc" name="cvc" required>
            </div>
            <div class="form-group">
                <label for="date">Expiration</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <button type="submit">Payer</button>
            </div>
        </form>
    <?php endif; ?>
</main>
<?php include 'footer.html'; ?>
</body>
</html>
