<?php

class Modele
{
    private $unPdo ; // attribut de la classe

    public function __construct ($serveur, $serveur2, $bdd, $user, $mdp, $mdp2)
    {
        try {
            $this->unPdo= new PDO("mysql:host=".$serveur.";charset=UTF8;dbname=".$bdd, $user, $mdp);
        }
        catch (PDOException $exp)
        {
            try {
                $this->unPdo= new PDO("mysql:host=".$serveur2.";charset=UTF8;dbname=".$bdd, $user, $mdp2);
            } catch (PDOException $exp) {
                echo " Impossible de se connecter à la base de données";
                echo $exp->getMessage();
            }
        }
    }

    public function AjouterClient ($nom, $prenom, $email, $mdp, $role, $siret, $adresse, $telephone)//créer un nouvel utilisateur
    {
        $requete ="call insertClient(:nom, :prenom, :email, :mdp, :role, :siret, :adresse, :telephone ) ; ";
        $donnees = array (':nom'=>$nom,
                          ':prenom'=>$prenom,
                          ':email'=>$email,
                          ':mdp'=>$mdp,
                          ':role'=>$role,
                          ':siret'=>$siret,
                          ':adresse'=>$adresse,
                          ':telephone'=>$telephone );
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }

    public function verifConnexion ($email,$mdp)//vérificier ue l'utilsateur existe en base avec ce mdp
    {
        $requete ="select * from user where email = :email and mdp = :mdp ; ";
        $donnees = array (':email'=>$email,
                          ':mdp'=>$mdp);
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
        $unUser = $select->fetch();
        return $unUser;
    }
    public function getIdPanier($iduser){
        $requete= "select * from panier where iduser= :iduser;";
        $donnees= array(
            ":iduser" => $iduser
        );
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
        $unPanier = $select->fetch();
        return $unPanier;
    }


    public function getArticles()//récupérer la liste complète des articles
    {
        $requete ="select * from article ; ";
        $donnees = array();
        $select = $this->unPdo->prepare($requete);

        $select->execute($donnees);

        $articles = $select->fetchAll ();
        return $articles;
    }

     public function recupArticle($idcategorie)//récupérer la liste complète des articles
    {
        $requete ="select * from article where idcategorie=:idcategorie;";
        $donnees = array(':idcategorie'=>$idcategorie);
        $select = $this->unPdo->prepare($requete);

        $select->execute($donnees);

        $articles = $select->fetchAll ();
        return $articles;
    }


    public function getCategorie()//récupérer la liste complète des articles
    {
        $requete ="select * from categorie ; ";
        $donnees = array();
        $select = $this->unPdo->prepare($requete);

        $select->execute($donnees);

        $categories = $select->fetchAll ();
        return $categories;
    }


     public function getCommandes($user)//récupérer la liste des commandes d'un user
    {
        $requete ="select * from vueCommandes where iduser= :user ; ";
        $donnees = array(':user'=>$user);
        $select = $this->unPdo->prepare($requete);

        $select->execute($donnees);

        $articles = $select->fetchAll ();
        return $articles;
    }

    public function GetDetailCommande($commande)//récupérer la liste des articles d'une commande
    {
        $requete ="select * from contenuCommande join article on contenucommande.idarticle=article.idarticle where idcommande= :commande ; ";
        //liaison entre la table contenucommande et article
        $donnees = array(':commande'=>$commande);
        $select = $this->unPdo->prepare($requete);

        $select->execute($donnees);

        $articles = $select->fetchAll ();
        return $articles;
    }

    public function validerPanier($user)
    {
        //ajouter dans la table commande
        $requete ="Insert into commande (datecommande, iduser) values (now(), :user) ; ";
        $donnees = array(':user'=>$user);
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);



        //récupérer la clé primaire de la commande insérée
        $idcommande= $this->unPdo->lastInsertId();
        $panier=$this->getPanier($user);
        foreach($panier as $article){
            $requete ="insert into commandearticle values(:idarticle, :idcommande, :quantite);";
            $donnees=array(
                ":idarticle"=>$article['idarticle'],
                ":idcommande"=>$idcommande,
                ":quantite"=>$article['quantite']
            );
            $select = $this->unPdo->prepare($requete);
            $select->execute($donnees);
        }
        

        $idpanier="select * from panier where iduser=:user;";
        $donnees = array(':user'=>$user);
        $select = $this->unPdo->prepare($idpanier);
        $select->execute($donnees);
        $idpanier = $select->fetch();


        //vider le panier
        $requete ="Delete from articlepanier where idpanier = :idpanier ; ";
        $donnees = array(':idpanier'=>$idpanier['IdPanier']);

        $select = $this->unPdo->prepare($requete);

        $select->execute($donnees);

    }

    public function getPanier($user)//récupérer le panier d'un user
    {
        $requete ="select * from UserPanierArticle where iduser=:user;";
        //on lie la table panier à la table article par l'idarticle
        $donnees = array(':user'=>$user);
        $select = $this->unPdo->prepare($requete);

        $select->execute($donnees);

        $panierArticles = $select->fetchAll();
        return $panierArticles;
    }

    public function ajouterPanier($idpanier, $idarticle)//ajouter un article au panier de l'User
    {
        $requete ="insert into ArticlePanier values(:idpanier, :idarticle, 1);";
        $donnees = array(':idpanier'=>$idpanier,
                          ':idarticle'=>$idarticle);
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }

    public function SupprimerDuPanier($idpanier, $idarticle){ //Suprimme l'article du panier de l'user
        $requete ="delete from articlepanier where idpanier=:idpanier and idarticle=:idarticle;";
        $donnees = array(':idpanier'=>$idpanier,
                          ':idarticle'=>$idarticle);
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }
    public function ajoutQuantite($idpanier, $idarticle){
        $requete ="update ArticlePanier set quantite=quantite+1 where idpanier=:idpanier and idarticle=:idarticle;";
        $donnees = array(':idpanier'=>$idpanier,
                          ':idarticle'=>$idarticle);
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }
    public function soustraireQuantite($idpanier, $idarticle){
        $requete ="update ArticlePanier set quantite=quantite-1 where idpanier=:idpanier and idarticle=:idarticle;";
        $donnees = array(':idpanier'=>$idpanier,
                          ':idarticle'=>$idarticle);
        $select = $this->unPdo->prepare($requete);
        $select->execute($donnees);
    }

  public function getContenuCommandeById($idCommande) {
    // Récupération du contenu de la commande à partir de la base de données
    $query = $this->unPdo->prepare("SELECT * FROM contenu_commande WHERE idCommande = :idCommande");
    $query->execute(array(':idCommande' => $idCommande));
    $contenuCommande = $query->fetchAll();

    return $contenuCommande;
  }
}




?>