<?php
# Nathan Pache
# IDA-P1A
# 23.05.2024
# Contacte
# status : non terminer
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>freez host | Support</title>
</head>

<body>
    <main>
    <?php
include 'header.html';
session_start();
echo "<script>
alert("! Cette page est actuellement en maintenance !")
</script>";
?>

<h1 class="slogant">Contacte</h1>

<?php
include 'footer.html';
?>
</main>
</body>

</html>