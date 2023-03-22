<?php
session_start();
require_once("controleur/config_bdd.php");
require_once("controleur/controleur.class.php");
$unControleur = new Controleur($serveur, $serveur2, $bdd, $user, $mdp, $mdp2);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page.css">
    <title>EcoSport</title>
</head>
<img src="" 
<!--<img src="images/logo.png" >-->
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');
        </style>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');
        </style>
<body>

    <header>
        <?php require_once("composants/navbar.php");  ?>

    </header>

    <main>
        <?php
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 0;
        }

        switch ($page) {
            case 0:
                require_once("pages/home.php");
                break;

            case 1:
                require_once("pages/categorie.php");
                break;

            case 2:
                require_once("pages/panier.php");
                break;

            case 3:
                require_once("vue/vue_inscription.php");
                break;

            case 4:
                require_once("vue/vue_connexion.php");
                break;

            case 5:
                require_once("pages/deconnexion.php");
                break;
            
            case 6:
                require_once("vue/vue_commande.php");
                break;
        }
        ?>
        <!-- contenu de ta page fin -->
    </main>

    <footer>
        <!-- ton bas de page -->
    </footer>
</body>

</html>