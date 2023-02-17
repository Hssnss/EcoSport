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

      public function AjouterAuPanier ($user, $article)//modèle pour ajouter un article au panier pour un user
    {
        $this->unModele->AjouterAuPanier($user, $article);
    }

    

    public function GetPanier ($user)//modèle pour récupérer le contenu du panier d'un user
    {
        return $this->unModele->getPanier($user);
    }

    public function GetCommandes ($user)//modèle pour récupérer la liste des commande d'un user
    {
        return $this->unModele->getCommandes($user);
    }

    public function GetDetailCommande($commande)//modèle pour récupérer la liste des articles d'une commande
    {
        return $this->unModele->GetDetailCommande($commande);
    }

    public function getArticles ()//modèle pour récupérer la liste des articles complète de la base
    {
        return $this->unModele->getArticles();
    }

    public function getCategorie ()//modèle pour récupérer la liste des articles complète de la base
    {
        return $this->unModele->getCategorie();
    }

    public function recupArticle ($idcategorie)//modèle pour récupérer la liste des articles complète de la base
    {
        return $this->unModele->recupArticle($idcategorie);
    }

    public function verifConnexion ($email, $mdp)//modèle pour vérifier le user et son mdp
    {
        return $this->unModele->verifConnexion($email, $mdp);
    }

    //Récupère l'id panier de l'utilisateur connecté
    public function getIdPanier($iduser){
        return $this->unModele->getIdPanier($iduser);
    }

    public function AjouterClient ($nom, $prenom , $email, $mdp, $role, $siret, $adresse, $telephone)//modèle pour ajouter un nouveau user
    {
        return $this->unModele->AjouterClient($nom, $prenom , $email, $mdp, $role, $siret, $adresse, $telephone);
    }

    public function ajouterPanier($idpanier, $idarticle){
        $this->unModele->ajouterPanier($idpanier, $idarticle);
    }

    public function ValiderPanier ($user)//modèle pour valider le panier d'un user
    {
        return $this->unModele->ValiderPanier($user);
    }
    public function SupprimerDuPanier($idpanier, $idarticle){
        $this->unModele->SupprimerDuPanier($idpanier, $idarticle);
    }

    public function ajoutQuantite($idpanier, $idarticle){
        $this->unModele->ajoutQuantite($idpanier, $idarticle);
    }

    public function soustraireQuantite($idpanier, $idarticle){
        $this->unModele->soustraireQuantite($idpanier,$idarticle);
    }

  public function afficherContenuCommande($idCommande) {
    // Récupération du contenu de la commande
    $contenuCommande = $this->unModele->getContenuCommandeById($idCommande);

    // Affichage de la vue avec le contenu de la commande
    $this->vue->afficher('contenuCommande.php', array('contenuCommande' => $contenuCommande));
  }
}








?>