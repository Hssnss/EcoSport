<?php
//on integre le modele
require_once("modele/modele.class.php");

class Controleur
{
    //attribut de cette classe : une instance de la classe Modele
    private $unModele ;

    public function  __construct($serveur, $serveur2, $bdd, $user, $mdp, $mdp2)
    {
        //ici : on instancie la classe Modele en créant un objet
        $this->unModele = new Modele ($serveur, $serveur2, $bdd, $user, $mdp, $mdp2);
    }

    // User

    public function selectUser($email, $mdp)
    {
        // on controle la validité des données 
        return $this->unModele->selectUser($email, $mdp);
    }

    
    // client

    public function insertClient($tab) {
        $this->unModele->insertClient($tab);
    }


    public function selectClient($email)
    {
        $unClient = $this->unModele->selectClient($email);
        return $unClient;
    }


    public function selectEntreprise($email)
    {
        $uneEntreprise = $this->unModele->selectEntreprise($email);
        return $uneEntreprise;
    }


    // entreprise

    public function insertEntreprise($tab) {
        // foreach($tab as $one) {
        //     if ($one == "") {
        //         echo "<p style='text-align: center;'>Veuillez remplir tous les champs</p>";
        //         return null;
        //     } else {
        //     }
        // }
        $this->unModele->insertEntreprise($tab);
    }

    //categorie 

    public function selectAllCategories ()//modèle pour récupérer la liste des articles complète de la base
    {
        $lesCategories = $this->unModele->selectAllCategories();
        return $lesCategories;
    }

    // article 

    public function selectAllArticles ()//modèle pour récupérer la liste des articles complète de la base
    {
        $lesArticles = $this->unModele->selectAllArticles();
        return $lesArticles;
    }

    public function selectAllArticlesPanier ()//modèle pour récupérer la liste des articles complète de la base
    {
        $lesArticlesPanier = $this->unModele->selectAllArticlesPanier();
        return $lesArticlesPanier;
    }

    public function recupArticle ($idcategorie)//modèle pour récupérer la liste des articles complète de la base
    {
        return $this->unModele->recupArticle($idcategorie);
    }

    public function getArticles ()//modèle pour récupérer la liste des articles complète de la base
    {
        return $this->unModele->getArticles();
    }

    // panier

     public function createPanier($tab) {
        $this->unModele->createPanier($tab);
    }

    
    public function GetPanier ($user)//modèle pour récupérer le contenu du panier d'un user
    {
        return $this->unModele->getPanier($user);
    }

    public function ajouterPanier($idarticle){
        $this->unModele->ajouterPanier($idarticle);
    }

    public function creerCommande($iduser)
    {
        $this->unModele->creerCommande($iduser);
    }
	public function selectCommande ($iduser)
    {
        return $this->unModele->selectCommande ($iduser);
    }

	public function insererArticlePanier ($idcommande, $idarticle)
    {
        $this->unModele->insererArticlePanier ($idcommande, $idarticle);
    }

    public function supprimerPanier($idcommande, $idarticle){ 
        $this->unModele->supprimerPanier($idcommande, $idarticle); 
    }
    public function updatePanier($idcommande, $idarticle, $nb){ 
        $this->unModele->updatePanier($idcommande, $idarticle, $nb); 
    }

    //commande

    public function ValiderPanier ($user)//modèle pour valider le panier d'un user
    {
        return $this->unModele->ValiderPanier($user);
    }

    public function GetCommandes ($user)//modèle pour récupérer la liste des commande d'un user
    {
        $commandes = $this->unModele->getCommandes($user);
        return $commandes;
    }

    
}