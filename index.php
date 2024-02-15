<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST</title>
</head>
<body>

<?php
include 'header.html';

$connecter = false;

if ($connecter == false)
{
    include 'co-toi.html';
}
else if ($connecter == true)
{
    include 'main.html';
}
else
{
    include 'co-toi.html';
}
?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
include 'footer.html';
?>
</body>
</html>
