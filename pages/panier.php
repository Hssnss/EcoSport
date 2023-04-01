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
        $idcommande = $unControleur->getPanierCommandeEnCours($_SESSION['iduser']);
        $qteArticle=0;
        //Si dans l'url de la page la décision existe (on veut retirer un article mais sa quantité est à 1)
        //On indique à la variable qteArticle pour permettre la condition dans le switch
        if(isset($_GET['decision'])){
            $qteArticle=1;
        }
        switch ($action) {
            case 'sup':
            $unControleur->supprimerPanier($idcommande, $idArticle);
            echo '<script type="text/javascript">window.alert("Article supprimé du panier");</script>';
            break;
            case 'plus': 
                $unControleur->updatePanier($idcommande, $idArticle, 1);
                break;
            case 'moins': {
                    if($qteArticle==1){
                        $unControleur->supprimerPanier($idcommande, $idArticle);
                    }
                    else{
                        $unControleur->updatePanier($idcommande, $idArticle, -1);
                    }
                }break;
                    
                    
            }
    }
   

    $lesArticles = $unControleur->getPanierCommandeEnCours($_SESSION['iduser']); //r�cup�rer le contenu du panier (controlleur)
    echo '<table>';
    echo '<tbody>';

    require_once("vue/vue_panier.php");
}
