<h2>PANIER</h2>

<?php
if (!isset($_SESSION['email'])) {
    header('Location: index.php'); //si pas connect� on revient � l'accueil
    exit();
} else {

    if ( isset($_GET['retirerId']))
    {
        $action = $_GET['action'] ;
        $idArticle = $_GET['retirerId'];
        $idcommande = $_SESSION ['idcommande'];
        switch ($action) {
            case 'sup':
            $unControleur->supprimerPanier($idcommande, $idArticle);
            echo '<script type="text/javascript">window.alert("Article supprimé du panier");</script>';
            break;
            case 'plus': 
                $unControleur->updatePanier($idcommande, $idArticle, 1);
                break;
            case 'moins': 
                    $unControleur->updatePanier($idcommande, $idArticle, -1);
                    break;
            }
    }
   

    $lesArticles = $unControleur->getPanier($_SESSION['iduser']); //r�cup�rer le contenu du panier (controlleur)
    echo '<table>';
    echo '<tbody>';

    require_once("vue/vue_panier.php");
}
