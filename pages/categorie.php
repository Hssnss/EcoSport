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

		$unControleur->creerCommande($_SESSION['iduser']);
		 
		$uneCommande = $unControleur->selectCommande ($_SESSION['iduser']);
		 
		$_SESSION['idcommande'] = $uneCommande['idcommande'];

		$unControleur->insererArticlePanier ($_SESSION['idcommande'], $idarticle);
		
		echo '<script type="text/javascript">window.alert("Article ajouté avec succès !");</script>';
	}
?>