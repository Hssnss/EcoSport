<?php

require_once ("controleur/controleur.class.php");
//instancier la classe controleur en cr�ant un objet
$unControleur = new Controleur($serveur, $serveur2, $bdd, $user, $mdp, $mdp2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>

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

        require_once("vue/vue_commande.php");
            
        

        if( count($factures)==0 )//si on a aucune comande afficher un message
        {
            echo 'aucune commande :-(';
        }

    }
	

	
    ?>
	

</body>

