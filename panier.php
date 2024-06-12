<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# Panier
# status : Terminer
?>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$servername = "localhost";
$username = "nathan";
$password = "Super";
$dbname = "freezix_host";

// Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idProduit'])) {
        $idProduit = $_POST['idProduit'];
        $sql = "INSERT INTO Panier (idUtilisateur, idProduit, Quantite, Prix)
                SELECT $userId, $idProduit, 1, PrixMensuel FROM Produit WHERE idProduit = $idProduit";
        $conn->query($sql);
    } elseif (isset($_POST['vider'])) {
        $sql = "DELETE FROM Panier WHERE idUtilisateur = $userId";
        $conn->query($sql);
    }
}

$sql = "SELECT Produit.NomProduit, Produit.PrixMensuel, Panier.Quantite
        FROM Panier
        JOIN Produit ON Panier.idProduit = Produit.idProduit
        WHERE Panier.idUtilisateur = $userId";
$result = $conn->query($sql);

$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/button.css">
</head>
<body>
<?php include 'header.html'; ?>
<main>
    <h2>Votre Panier</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix Mensuel</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['NomProduit']); ?></td>
                        <td><?php echo htmlspecialchars($row['PrixMensuel']); ?> CHF</td>
                        <td><?php echo htmlspecialchars($row['Quantite']); ?></td>
                    </tr>
                    <?php $total += $row['PrixMensuel'] * $row['Quantite']; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p>Total: <?php echo $total; ?> CHF</p>
        <form action="paiement.php" method="post">
            <button type="submit">Payer</button>
        </form>
        <form action="panier.php" method="post">
            <input type="hidden" name="vider" value="1">
            <button type="submit">Vider le panier</button>
        </form>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
</main>
<?php include 'footer.html'; ?>
</body>
</html>

<?php
$_SESSION['montant'] = $total;
$conn->close();
?>
