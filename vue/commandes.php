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
	<h2> Commandes</h2>
	<?php
	if ( ! isset($_SESSION['email']))
	{

        session_destroy();  
        header('Location: index.php'); //si pas connect� on revient � l'accueil
		exit();
	}
	else
	{
		if(isset ($_GET['validerPanier']))//si on demande � valider le panier (on vient de la page panier)
        {
            $unControleur->ValiderPanier($_SESSION['iduser']);//controlleur pour valider le panier
            $message='commande validee';
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';//popup qui affiche un message
        }
   
		$factures = $unControleur->GetCommandes($_SESSION['iduser']);//r�cup�rer la liste des commandes (controlleur)
        echo '<table>';
        echo '<tbody>';
		foreach ($factures as $art)//boucler sur les commandes et g�n�rer le code html d'affichage + bouton d�tail qui redirige vers la page detailcommande avec param�tre idcommande
        {
            $datecommande = new DateTime($art['DateCommande']);//convertir en date
            $dateformatee = $datecommande->format('d/m/Y'); //formater la date pour l'affichage
            $heureformatee = $datecommande->format('H:i'); //formater l'heure pour l'affichage
            echo '	
<td>
<a href="index.php?page=30&IdCommande=' . $art['IdCommande'] . '&IdArticle='.$art['idarticle'].'">
Commande numero ' . $art['IdCommande'] . '. Article: '.$art['idarticle'].' (' . $dateformatee . ' a ' . $heureformatee . ')</tr>
</a>
</td>
<br>
	';
            
        }
        echo '</tbody>';
        echo '</table>';
        if( count($factures)==0 )//si on a aucune comande afficher un message
        {
            echo 'aucune commande :-(';
        }

    }
	

	
    ?>
	
	</center>
</body>