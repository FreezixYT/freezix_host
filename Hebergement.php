<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREEZ HOST | Hébergement</title>
    
</head>

<body>
<?php
include 'header.html';

session_start();

include 'hebergement.html';
?>

<main class="hebergement">
    <style>
        .svg {
            width: 200%;
        }
    </style>
    <h1>Nos services d'hébergement</h1>
    <p class="centre">Découvrez nos 3 formules web</p>

    <p class="best">Le plus vendu</p>
    <div class="offres">
        <div class="zone-gray">
            <h2>Basique</h2>
            <p class="centre">Parfait pour les sites web personnels et petits blogs</p>
            <br>
            <ul>
                <li>&#10004; 100 Go stockage</li>
                <li>&#10004; 50 G0 bande passante</li>
                <li>&#10004; DNS protégé</li>
                <li>&#10004; 1 Email gratuit</li>
                <li>&#10004; Support 24/7</li>
            </ul>
            <hr>
            <p class="centre">2 CHF / mois</p>
            <form action="panier.php" method="post">
                <input type="hidden" name="produit" value="Basique">
                <input type="hidden" name="prix" value="2">
                <button type="submit">Acheter</button>
            </form>
            <br>
            <hr>
            <br>
            <ul>
                <li>&#10004; 1 site web hébergé</li>
                <li>&#10004; Version basique de WordPress</li>
                <li>&#10004; Protection Anti DDOS standard</li>
                <li>&#10004; Formule IA basique</li>
                <li>&#10004; Remboursement sous 24 heures</li>
            </ul>
        </div>
        
        <div class="zone-gray">
            <h2>Medium</h2>
            <p class="centre">Pour les sites de petites entreprises désirant de la puissance</p>
            <br>
            <ul>
                <li>&#10004; 200 Go stockage</li>
                <li>&#10004; 100 Go bande passante</li>
                <li>&#10004; DNS protégé</li>
                <li>&#10004; 10 Emails gratuits</li>
                <li>&#10004; Support 24/7</li>
            </ul>
            <hr>
            <p class="centre">4 CHF / mois</p>
            <form action="panier.php" method="post">
                <input type="hidden" name="produit" value="Medium">
                <input type="hidden" name="prix" value="4">
                <button type="submit">Acheter</button>
            </form>
            <br>
            <hr>
            <br>
            <ul>
                <li>&#10004; 1 site web hébergé</li>
                <li>&#10004; Version basique de WordPress</li>
                <li>&#10004; Protection Anti DDOS standard</li>
                <li>&#10004; Formule IA basique</li>
                <li>&#10004; Remboursement sous 24 heures</li>
                <li>&#10004; Booster avec l'IA</li>
            </ul>
        </div>

        <div class="zone-gray">
            <h2>Pro</h2>
            <p class="centre">Profitez d'un maximum de performances</p>
            <br>
            <ul>
                <li>&#10004; 300 Go stockage</li>
                <li>&#10004; 200 Go bande passante</li>
                <li>&#10004; DNS protégé</li>
                <li>&#10004; 100 Emails gratuits</li>
                <li>&#10004; Support 24/7</li>
            </ul>
            <hr>
            <p class="centre">8 CHF / mois</p>
            <form action="panier.php" method="post">
                <input type="hidden" name="produit" value="Pro">
                <input type="hidden" name="prix" value="8">
                <button type="submit">Acheter</button>
            </form>
            <br>
            <hr>
            <br>
            <ul>
                <li>&#10004; 1 site web hébergé</li>
                <li>&#10004; Version basique de WordPress</li>
                <li>&#10004; Protection Anti DDOS standard</li>
                <li>&#10004; Formule IA basique</li>
                <li>&#10004; Remboursement sous 24 heures</li>
            </ul>
        </div>
    </div>
    <div class="block-demo">
        <h1>Nos services sont disponibles dans le monde entier</h1>
        <img src="img/map.svg" alt="world" width="50%" class="svg">
    </div>
    <div class="block-demo">
        <h1>Un service client de qualité</h1>
        <div class="sav">
            <ol>
                <li>&#10004; Service client compétent</li>
                <li>&#10004; Disponible 24h/24 et 7j/7</li>
                <li>&#10004; Tutos de qualité sur YouTube</li>
                <li>&#10004; Dépannage en moins de 5 minutes</li>
            </ol>
            <img src="/img/sav.svg" alt="sav" width="20%" class="svg">        
        </div>
    </div>
    <hr>
    <h1>Avis</h1>
    <div class="zone-avis">
        <div class="avis">
            <div class="pseudo">
                <p>@michell34</p>
                <p>&#9733;&#9733;&#9733;&#9733;</p>
            </div>
            <p>Service de qualité, bon support</p>
            <br>
            <p>21/03/2024</p>
        </div>

        <div class="avis">
            <div class="pseudo">
                <p>@freezix</p>
                <p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
            </div>
            <p>Le meilleur service d'hébergement du monde ! Le support est de très bonne qualité</p>
            <br>
            <p>21/03/2024</p>
        </div>

        <div class="avis">
            <div class="pseudo">
                <p>@freeVebuck</p>
                <p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
            </div>
            <p>Le meilleur service d'hébergement du monde ! Le support est de très bonne qualité</p>
            <br>
            <p>21/03/2024</p>
        </div>
    </div>
</main>

<?php
include 'footer.html';
?>
</body>
<style>
        button[type="submit"] 
        {
            background-color: #19ba19;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            min-height: 48px;
            text-align: center;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
            padding: 10px;
            font-size: x-large;
            transition: background-color 500ms;
        }

        button[type="submit"]:hover 
        {
            background-color: #128d12;
            transition: background-color 500ms;
        }
    </style>
</html>
