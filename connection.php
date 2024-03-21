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
include 'header.html';
?>
<?php 
   session_start() ;
  if(isset($_POST['boutton-valider']))
  { 
    if(isset($_POST['email']) && isset($_POST['mdp'])) 
    {
      $email = $_POST['email'] ;
      $mdp = $_POST['mdp'] ;
      $erreur = "" ;
       
       $nom_serveur = "localhost";
       $utilisateur = "root";
       $mot_de_passe ="Super";
       $nom_base_données ="freezix_host" ;
       $con = mysqli_connect($nom_serveur , $utilisateur ,$mot_de_passe , $nom_base_données);
       
        $req = mysqli_query($con , "SELECT * FROM compte WHERE email = '$email' AND mdp ='$mdp' ") ;
        $num_ligne = mysqli_num_rows($req) ;
        if($num_ligne > 0)
        {
            header("Location:bienvenue.php") ;
           
            $_SESSION['email'] = $email ;
        }
        else 
        {
            $erreur = "Adresse Mail ou Mots de passe incorrectes !";
        }
    }
  }
?>

<main>
    <h2>Connexion</h2>

    <form action="#" method="POST">
        <div class="zone-form">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="text" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>
            <label><p>Pas de compte ? <a href="compte.php">Créer un compte</a></label>
        </div>
    </form>

</main>

<?php
include 'footer.html';
?>

</body>

</html>
