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


<body>
    <center><img src="images/logo.png" width=20% ></center>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');
        </style>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');
        </style>
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

                case 1: {
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                        require_once("pages/admin.php");
                    } else {
                        require_once("pages/categorie.php");
                    }
                } break;
                
                
                

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
    <div class="footer-container">
        <div class="footer-section footer-logo">
            <img src="images/logo.png" alt="Logo">
        </div>

        <div class="footer-section footer-info">
            <p><strong>Adresse :</strong> 13 rue gogo</p>
            <p><strong>Téléphone :</strong> +33 6 12 34 56 78</p>
            <p><strong>Email :</strong> contact@ecosport.com</p>
        </div>

        <div class="footer-section footer-links">

            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Politique de confidentialité</a></li>
                <li><a href="#">Termes et conditions</a></li>
            </ul>
        </div>

        <div class="footer-section footer-credits">
            <p>© 2023 EcoSport. Tous droits réservés.</p>
        </div>
    </div>
</footer>
</body>

</html>