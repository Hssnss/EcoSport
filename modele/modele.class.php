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
        $requete ="select * from categorie; ";
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
    //Pour pouvoir n'avoir que la commande en cours dans vue_panier de l'user
    public function getPanierCommandeEnCours($user)//récupérer le panier d'un user
    {
        $requete ="select * from UserPanierArticle where iduser=:iduser and statut='en cours';";
        //on lie la table panier à la table article par l'idarticle
        $donnees = array(':iduser'=>$user);
        $select = $this->pdo->prepare($requete);

        $select->execute($donnees);

        $panierArticles = $select->fetchAll();
        return $panierArticles;
    }
    //Pour dans vue_commande avoir toutes les commandes terminées de l'user
    public function getPanierCommandeTerminer($user)//récupérer le panier d'un user
    {
        $requete ="select * from UserPanierArticle where iduser=:iduser and statut='terminer';";
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
        //INSERT INTO `commande` (`idcommande`, `statut`, `DateCommande`, `iduser`) VALUES (NULL, 'en cours', sysdate(), :iduser);
        $requete= "INSERT INTO `commande` (`idcommande`, `statut`, `DateCommande`, `iduser`) VALUES (NULL, 'en cours', sysdate(), :iduser);";
        $donnees = array(':iduser'=>$iduser);
        $insert = $this->pdo->prepare($requete);
         $insert->execute($donnees);
        
    }
    //Dans le paier on a valider la commande on ferme cette commande
    public function terminerCommande($idcommande)
    {
        //INSERT INTO `commande` (`idcommande`, `statut`, `DateCommande`, `iduser`) VALUES (NULL, 'en cours', sysdate(), :iduser);
        $requete= "update commande set statut='terminer' where idcommande=".$idcommande.";";         
        $insert = $this->pdo->prepare($requete);
         $insert->execute();
        
    }

    //Récupère toutes les commandes de l'user
	public function selectCommande ($iduser)
    {
        $requete ="select * from commande where iduser = ".$iduser.";";
        
        $select = $this->pdo->prepare($requete);
        $select->execute();
        $uneCommande = $select->fetch();
        //Si la requete possède des enregistrement on retourne les données récupérées
        if($select->rowCount()>0){
            return $uneCommande;
        }
        else{
            //Sinon return null
            return null;
        }
    }
    //Récupère les commandes en cours pour l'user
    public function selectCommandeEnCours($iduser)
    {
        $requete = "SELECT * FROM commande WHERE iduser = :iduser AND statut = 'en cours';";
    
        $select = $this->pdo->prepare($requete);
        $select->bindParam(':iduser', $iduser, PDO::PARAM_INT);
        $select->execute();
        $uneCommande = $select->fetch();
    
        // Si la requête possède des enregistrements, on retourne les données récupérées
        if ($select->rowCount() > 0) {
            return $uneCommande;
        } else {
            // Sinon, retourne null
            return null;
        }
    }
    //Récupère les commandes terminées pour l'user
    public function selectCommandeTerminer($iduser)
    {
        $requete = "SELECT * FROM commande WHERE iduser = :iduser AND statut = 'terminer';";
    
        $select = $this->pdo->prepare($requete);
        $select->bindParam(':iduser', $iduser, PDO::PARAM_INT);
        $select->execute();
        $uneCommande = $select->fetch();
    
        // Si la requête possède des enregistrements, on retourne les données récupérées
        if ($select->rowCount() > 0) {
            return $uneCommande;
        } else {
            // Sinon, retourne null
            return null;
        }
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
        $idcommande= $idcommande[0]['idcommande'];
        $requete ="delete from panier where IdCommande=:IdCommande and idArticle=:idArticle;";
        $donnees = array(':IdCommande'=>$idcommande,
                          ':idArticle'=>$idarticle);
        $select = $this->pdo->prepare($requete);
        $select->execute($donnees);
    }
    
    public function updatePanier($idcommande, $idarticle, $nb)
    {

        $idcommande= $idcommande[0]['idcommande'];
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
        $donnees = array(':user' => $user['id']);
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

    //admin
        //Ajouter un article 
    public function insertArticle($tab, $nomImage){
        $requete="insert into article values(null, :nom, :description, :prix, '".$nomImage."', :stock, :idcategorie);";
        $donnees= array(
            ":nom" => $tab['nom'],
            ":description" => $tab['description'],
            ":prix" => $tab['prix'],
            ":stock" => $tab['stock'],
            ":idcategorie" => $tab['idcategorie']
        );
        $insert=$this->pdo->prepare($requete);
        $insert->execute($donnees);
    }
        //Supprimer l'article
    public function deleteArticle($idArticle){
        $requete="delete from article where idarticle=:idarticle;";
        $donnees= array(
            ":idarticle" => $idArticle
        );
        $select=$this->pdo->prepare($requete);
        $select->execute($donnees);
    }

        //Récupérer l'article
    public function selectWhereArticle($idArticle){
        $requete="select * from article where idarticle=:idarticle;";
        $donnees= array(
            ":idarticle" => $idArticle
        );
        $select=$this->pdo->prepare($requete);
        $select->execute($donnees);

        $unArticle=$select->fetch();
        return $unArticle;
    }
        //Modifier l'article
    public function updateArticle($tab){
        $requete="update article set nom=:nom, description=:description, prix=:prix, image=:nomImage,
            stock=:stock, idcategorie=:idcategorie where idarticle=:idarticle;";
        $donnees= array(
            ":nomImage"=>$tab['nomImage'],
            ":nom" => $tab['nom'],
            ":description" => $tab['description'],
            ":prix" => $tab['prix'],
            ":stock" => $tab['stock'],
            ":idcategorie" => $tab['idcategorie'],
            ":idarticle" => $tab['idarticle']
        );
        $select=$this->pdo->prepare($requete);
        $select->execute($donnees);
    }
}
    
?>