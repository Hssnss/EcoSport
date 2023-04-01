<?php
	$lesCategories = $unControleur->selectAllCategories();
	$lesArticles= null;

	// $unControleur->createPanier();

	if(isset($_GET['idcategorie'])){
		$idcategorie=$_GET['idcategorie'];

		$lesArticles=$unControleur->recupArticle($idcategorie);
	}
	require_once("vue/vue_categorie.php");

	if($lesArticles!=null){
		require_once("vue/vue_les_articles.php");
	}
	if(isset($_GET['ajouterArticleId'])){
		$idarticle=$_GET['ajouterArticleId'];
		$uneCommande = $unControleur->selectCommandeEnCours($_SESSION['iduser']);

		//L'user ne possède pas de commande en cours
		if($uneCommande==null){
			$unControleur->creerCommande($_SESSION['iduser']);
			$uneCommande = $unControleur->selectCommandeEnCours($_SESSION['iduser']);
		}
		$_SESSION['idcommande']=$uneCommande['idcommande'];
		$unControleur->insererArticlePanier ($_SESSION['idcommande'], $idarticle);
		
		echo '<script type="text/javascript">window.alert("Article ajouté avec succès !");</script>';
		
	}


	//Si une entreprise veut ajouter un article
	if(isset($_GET['ajouterProduit'])){
		$lArticle=null;
		require_once("vue/insert_admin.php");
	}
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
			header("Location: index.php?page=1");
		}
		else{
			echo '<script type="text/javascript">window.alert("Une erreur est survenu lors du téléchargement de l\'image");</script>';
		}
	}
?>