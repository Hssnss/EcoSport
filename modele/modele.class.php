<?php

class Modele {

    private $pdo;

    public function __construct($serveur, $serveur2, $bdd, $user, $mdp, $mdp2)
    {
        $this->pdo = null;

        try {
            $this->pdo = new PDO("mysql:host=".$serveur."; charset=UTF8; dbname=".$bdd, $user, $mdp);
        } catch(PDOException $exp) {
            try {
                $this->pdo = new PDO("mysql:host=".$serveur2."; charset=UTF8; dbname=".$bdd, $user, $mdp2);
            } catch (PDOException $exp) {
                echo "Erreur de connexion à la base de données";
                echo $exp->getMessage();
            }
        }
    }

    // User

    public function selectUser($email, $mdp)
    {
        $requete = "SELECT * FROM User WHERE email=? AND mdp=?";
        if ($this->pdo != null) {
            // on prépare la requete 
            $select  = $this->pdo->prepare($requete);
            $select->execute(array($email, $mdp));
            //extraction de un User
            return $select->fetch();
        } else {
            return null;
        }
    }

        
    // client

    public function insertClient($tab)
    {
        $requete = "call insertClient(:nom, :email, :mdp, :adresse, :role, :tel, :prenom);";
        $donnees = array(
            ":nom" => $tab["nom"],
            ":email" => $tab["email"],
            ":mdp" => $tab["mdp"],
            ":adresse" => $tab["adresse"],
            ":role" => "Client",
            ":tel" => $tab["tel"],
            ":prenom" => $tab["prenom"]
        );
        if ($this->pdo != null) {
            // on prépare la requete 
            $insert  = $this->pdo->prepare($requete);
            $insert->execute($donnees);

        } else {
            return null;
        }
    }
    
    // entreprise

    public function insertEntreprise($tab)
    {
        $requete = "call insertEntreprise(:nom, :email, :mdp, :adresse, :role, :siret);";
        $donnees = array(
            ":nom" => $tab["nom"],
            ":email" => $tab["email"],
            ":mdp" => $tab["mdp"],
            ":adresse" => $tab["adresse"],
            ":role" => "Entreprise",
            ":siret" => $tab["siret"]
        );
        if ($this->pdo != null) {
            // on prépare la requete 
            $insert  = $this->pdo->prepare($requete);
            $insert->execute($donnees);

        } else {
            return null;
        }
    }

    public function selectClient($email) {
        $requete = "SELECT * FROM vueClients where email=?;";
        if ($this->pdo != null) {
            // on prépare la requete 
            $select  = $this->pdo->prepare($requete);
            $select->execute(array($email));
            //extraction de tous les clients
            return $select->fetch();
        } else {
            return null;
        }
    }

    public function selectEntreprise($email) {
        $requete = "SELECT * FROM vueEntreprise where email=?;";
        if ($this->pdo != null) {
            // on prépare la requete 
            $select  = $this->pdo->prepare($requete);
            $select->execute(array($email));
            //extraction de tous les clients
            return $select->fetch();
        } else {
            return null;
        }
    }

    //categorie

    public function selectAllCategories()//récupérer la liste complète des articles
    {
        $requete ="select * from categorie ; ";
        $select = $this->pdo->prepare($requete);
        $select->execute();
        $categories = $select->fetchAll();
        return $categories;
    }

    // article

    public function selectAllArticles()//récupérer la liste complète des articles
    {
        $requete ="select * from article ; ";
        $select = $this->pdo->prepare($requete);
        $select->execute();
        $articles = $select->fetchAll();
        return $articles;
    }

    

    public function recupArticle($idcategorie)//récupérer la liste complète des articles
    {
        $requete ="select * from article where idcategorie=:idcategorie;";
        $donnees = array(':idcategorie'=>$idcategorie);
        $select = $this->pdo->prepare($requete);
        $select->execute($donnees);
        $articles = $select->fetchAll();
        return $articles;
    }

    public function getArticles()//récupérer la liste complète des articles
    {
        $requete ="select * from article ; ";
        $donnees = array();
        $select = $this->pdo->prepare($requete);

        $select->execute($donnees);

        $articles = $select->fetchAll ();
        return $articles;
    }

    // panier

    public function getPanier($user)//récupérer le panier d'un user
    {
        $requete ="select * from UserPanierArticle where iduser=:iduser;";
        //on lie la table panier à la table article par l'idarticle
        $donnees = array(':iduser'=>$user);
        $select = $this->pdo->prepare($requete);

        $select->execute($donnees);

        $panierArticles = $select->fetchAll();
        return $panierArticles;
    }

    public function createPanier($tab) {
        $requete = "INSERT INTO panier VALUES(null, :iduser, :idcommande);";
        $donnees = array(
            ":iduser" => $_SESSION['iduser'],
            ":idcommande" => $tab["idcommande"]
        );
        if ($this->pdo != null) {
            // on prépare la requete 
            $insert  = $this->pdo->prepare($requete);
            $insert->execute($donnees);
        } else {
            return null;
        }
    }

   

    public function creerCommande($iduser)
    {
        $uneCommande = $this->selectCommande($iduser);
        if ($uneCommande !=null){
            return $uneCommande; 
        }else{
            $requete ="insert into commande  values(null, sysdate(), :iduser);";
            $donnees = array(':iduser'=>$iduser);
            $insert = $this->pdo->prepare($requete);

            $insert->execute($donnees);
         }   
    }
	public function selectCommande ($iduser)
    {
        $requete ="select * from commande where iduser = ".$iduser.";";
        
        $select = $this->pdo->prepare($requete);
        $select->execute();
        $uneCommande = $select->fetch();
        return $uneCommande;
    }

	public function insererArticlePanier ($idcommande, $idarticle)
    {
        $requete ="select * from panier where idcommande = ".$idcommande." and idarticle=".$idarticle.";";
        $select = $this->pdo->prepare($requete);
        $select->execute();
        $uneLignePanier = $select->fetch();
        if ($uneLignePanier == null)
        {
            $requete ="insert into panier  values(".$idcommande.",".$idarticle.",1);";
            $insert = $this->pdo->prepare($requete);
            $insert->execute();

        }else{
            $requete ="update panier set quantite =quantite +1 where idcommande = ".$idcommande." and idarticle=".$idarticle.";";
            $insert = $this->pdo->prepare($requete);
            $insert->execute();
        }
    }

    public function supprimerPanier($idcommande, $idarticle){ //Suprimme l'article du panier de l'user
        $requete ="delete from panier where idcommande=:idcommande and idarticle=:idarticle;";
        $donnees = array(':idcommande'=>$idcommande,
                          ':idarticle'=>$idarticle);
        $select = $this->pdo->prepare($requete);
        $select->execute($donnees);
    }
    public function updatePanier($idcommande, $idarticle, $nb)
    {
        $requete ="select * from panier where idcommande = ".$idcommande." and idarticle=".$idarticle.";";
        $select = $this->pdo->prepare($requete);
        $select->execute();
        $uneLignePanier = $select->fetch();
        if ($uneLignePanier['quantite'] == 1 and $nb ==-1)
        {
            $this->supprimerPanier ($idcommande, $idarticle);
        }
        else {
        $requete ="update panier set quantite =quantite +".$nb. " where idcommande = ".$idcommande." and idarticle=".$idarticle.";";
        $insert = $this->pdo->prepare($requete);
        $insert->execute();
        }
    }

    // commande 

    public function validerPanier($user)
    {
        //ajouter dans la table commande
        $requete ="Insert into commande (datecommande, iduser) values (now(), :user) ; ";
        $donnees = array(':user'=>$user);
        $select = $this->pdo->prepare($requete);
        $select->execute($donnees);



        //récupérer la clé primaire de la commande insérée
        $idcommande= $this->pdo->lastInsertId();
        $panier=$this->getPanier($user);
        foreach($panier as $article){
            $requete ="insert into commandearticle values(:idarticle, :idcommande, :quantite);";
            $donnees=array(
                ":idarticle"=>$article['idarticle'],
                ":idcommande"=>$idcommande,
                ":quantite"=>$article['quantite']
            );
            $select = $this->pdo->prepare($requete);
            $select->execute($donnees);
        }
        

        $idpanier="select * from panier where iduser=:user;";
        $donnees = array(':user'=>$user);
        $select = $this->pdo->prepare($idpanier);
        $select->execute($donnees);
        $idpanier = $select->fetch();
    }

    public function getCommandes($user)//récupérer la liste des commandes d'un user
    {
        $requete ="select * from vueCommandes where iduser= :user ; ";
        $donnees = array(':user'=>$user);
        $select = $this->pdo->prepare($requete);

        $select->execute($donnees);

        $articles = $select->fetchAll ();
        return $articles;
    }

    

    



}
?>