<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<?php
session_start();
include 'header.html';
?>

<main>
    <h2>Paiement</h2>
    <br>
    <br>
    <?php
    // Initialiser la variable $montant si elle est définie dans la session
    $montant = isset($_SESSION['montant']) ? $_SESSION['montant'] : 0;
    echo "<h4>Montant : " . $montant . " chf.-</h4>";
    ?>

    <form action="process_payment.php" method="POST" class="zone-form">
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
</main>

<?php
include 'footer.html';
?>

</body>

</html>
