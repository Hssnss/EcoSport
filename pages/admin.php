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

	<h2> Gestion Admin</h2>
	<?php
	if ( ! isset($_SESSION['email']))
	{

        session_destroy();  
        header('Location: index.php'); //si pas connect� on revient � l'accueil
		exit();
	}
	else
	{
        $lArticle=null;
        //Gestion action supprimer ou modifier article
		if(isset($_GET['action']) && isset($_GET['idarticle'])){
            $action=$_GET['action'];
            $idarticle=$_GET['idarticle'];

            switch($action){
                case 'sup':{
                    //On récupère le nom de l'image pour pouvoir la supprimer du dossier
                    $tmp=$unControleur->selectWhereArticle($idarticle);
                    $nomImage=$tmp['image'];
                    $path='images/articles/'.$nomImage;
                    if(file_exists($path)){
                        if(unlink($path)){
                            echo '<script type="text/javascript">window.alert("Image de l\'article supprimée du dossier");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.alert("Erreur lors de la suppression de l\'image de l\'article");</script>';
                        }
                    }
                    $unControleur->deleteArticle($idarticle);
                    header("Location: index.php?page=1");
                    break;
                } 
                case 'edit':
                    $lArticle=$unControleur->selectWhereArticle($idarticle);
                break;
            }
        }

        //On récupère les Categorie pour le menu deroulant
        $lesCategories=$unControleur->selectAllCategories();

        //Vue pour le formulaire d'ajout d'article
        require_once("vue/insert_admin.php");
        if(isset($_POST['Valider'])){
            //On insère un nouvel article, on récupère les données de l'image
            $image=$_FILES['image'];
            //On récupère son type
            $type=explode("/",$image['type'])[1];
            //Path=> /images/articles/[nomArticle].[formatImage]
            $path='images/articles/'.$_POST['nom'].'.'.$type;

            //Est ce que le fichier envoyé est une image ?
            /*$image_type=exif_imagetype($image['tmp_name']);
            $allowed_types=array(IMAGETYPE_PNG,IMAGETYPE_JPEG, IMAGETYPE_GIF);
            if(!in_array($image, $allowed_types)){
                echo '<script type="text/javascript">window.alert("Le fichier doit être une image de type PNG, JPG ou GIF");</script>';
                exit;
            }*/

            //On met l'image dans le dossier images/articles
            $result=move_uploaded_file($image['tmp_name'], $path);
            if($result){
                $nomImage=$_POST['nom'].'.'.$type;
                $unControleur->insertArticle($_POST, $nomImage);
                echo '<script type="text/javascript">window.alert("Article ajouté avec succès !");</script>';
            }
            else{
                echo '<script type="text/javascript">window.alert("Une erreur est survenu lors du téléchargement de l\'image");</script>';
            }
        }
        if(isset($_POST['Modifier'])){
            $unControleur->updateArticle($_POST);
            header("Location: index.php?page=1");
        }
   
		$lesArticles = $unControleur->selectAllArticles();//r�cup�rer la liste des commandes (controlleur)

        //Vue pour gérer les articles
        require_once("vue/vue_admin.php");
            
        

        if( count($lesArticles)==0 )//si on a aucune comande afficher un message
        {
            echo 'aucun article >:-(';
        }

    }
	

	
    ?>
	

</body>

