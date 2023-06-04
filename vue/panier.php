<?php

require_once ("controleur/controleur.class.php");
//instancier la classe controleur en cr�ant un objet
$unControleur = new Controleur();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
	<center>
	<h2> Panier</h2>
	<?php
	if ( ! isset($_SESSION['email']))
	{
        
        session_destroy();  
        header('Location: index.php'); //si pas connect� on revient � l'accueil
		exit();
	}
	else
	{


        if(isset ($_GET['retirerId']) && isset($_GET['quantite']))//i on demande � supprimer l'article (vient de la page panier)
        {
            $idArticle=$_GET['retirerId'];
            $PanierArticles= $unControleur->GetPanier($_SESSION['iduser']);


            foreach($PanierArticles as $ArticlePanier) {
            //Pour tous les articles dans le panier de l'User on regarde celui qui existe déjà
                if($ArticlePanier['idarticle']==$idArticle){
                    //Si l'article existant existe plus d'un fois on enlève seuelement une quantité
                    if($ArticlePanier['quantite']!=1){
                        //S'il exist déjà on ajoute 1 à sa quantité
                        $unControleur->soustraireQuantite($_SESSION['idpanier'], $idArticle);
                    }
                    else{
                        //L'article a supprimé n'a qu'une seule quantité, on supprime l'article en entier du panier
                        $unControleur->SupprimerDuPanier($_SESSION['idpanier'], $idArticle);
                        echo '<script type="text/javascript">window.alert("Article supprimé du panier");</script>';
                    }
                    
                }
            }
            
        }

		$articles = $unControleur->GetPanier($_SESSION['iduser']);//r�cup�rer le contenu du panier (controlleur)
        echo '<table>';
        echo '<tbody>';
		foreach ($articles as $art)//boucler sur les articles du panier et cr�er le code html d'affichage
        {
            echo '	
<td>
<tr>' . $art['Nom'] . '</tr>
<tr>   <img src="./images/articles/' . $art['nomImage'] . '" width="100" height="100"> </tr>
<tr>' . $art['prix'] . ' </br>Quantité :'.$art['quantite'].'</tr>
<tr> <a href="index.php?page=2&retirerId=' . $art['idarticle'] . '&quantite='.$art['quantite'].'"> <img src="images/delete.png" width="20" height="20"></a></tr>
</td>
<br>
	';
            
        }
        echo '</body>';
        echo '</table>';

        if( count($articles)>0 )//si on a plus d'un article on affiche le bouton commander (lien vers commandes avec param�tre validerpanier=1), sinon panier vide
        {
            echo '<tr> <a href="index.php?page=3&validerPanier=1"> <img src="images/valider.png" width="100" height="100"></a></tr>';
        }
        else
        {
            echo 'panier vide';
        }

    }
	

	
    ?>
	
	</center>
</body>