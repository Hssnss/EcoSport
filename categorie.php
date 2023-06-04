<?php
	$lesCategories = $unControleur -> getCategorie();
	$lesArticles=null;
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
		$ArticlePaniers= $unControleur->GetPanier($_SESSION['iduser']);
		$exist=false;
		//On récupère le panier de l'user
		foreach ($ArticlePaniers as $ArticlePanier) {
			//Pour tous les articles dans le panier de l'User on regarde s'il existe déjà
			if($ArticlePanier['idarticle']==$idarticle){
				//S'il exist déjà on ajoute 1 à sa quantité
				$unControleur->ajoutQuantite($_SESSION['idpanier'], $idarticle);
				$exist=true;
			}
		}
		if($exist!=true){
			//Si l'article n'existe pas dans le panier de l'User on l'ajoute
			$unControleur->ajouterPanier($_SESSION['idpanier'], $idarticle);
		}
		
		echo '<script type="text/javascript">window.alert("Article ajouté avec succès !");</script>';
	}
?>