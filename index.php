<?php
session_start(); 
require_once("controleur/config_bdd.php");
require_once ("controleur/controleur.class.php");
//instancier la classe controleur en créant un objet 
$unControleur = new Controleur($serveur, $serveur2, $bdd, $user, $mdp, $mdp2); 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/page.css" />
	<title>EcoSport</title>
</head>
<body>
	<center> 
	<h1> ECO SPORT </h1>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');
        </style>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');
        </style>

<?php
    $creationcompte=0;//vérifier si on vient de créer un cmpote (par defaut 0=NON)
    if( isset($_POST['CreerCompte']))//si on lui indique qu'on a créé un compte
    {
        $nom = $_POST['nom']; //on sauvegarde l'email tapé
        $prenom = $_POST['prenom']; //le mot de passe
        $email = $_POST['email']; //le nom
        $mdp = $_POST['mdp']; //le prénom
        $role = $_POST['role']; //le siret
        $siret = $_POST['siret']; //le nom
        $adresse = $_POST['adresse']; //le prénom
        $telephone = $_POST['telephone'];
        $unUser = $unControleur->AjouterClient ($nom, $prenom, $email, $mdp, $role, $siret, $adresse, $telephone);//on appelle la fonction du controlleur pour créer l'utilisateur
        $creationcompte=1;//on indique qu'on vient de créer un utilisateur (1=OUI)
    }
    if( isset($_POST['SeConnecter']))//vérifier si on vient de demander à se connecter
    {
        $email = $_POST['email']; //onsauvegarde l'mail
        $mdp = $_POST['mdp']; //le mot de passe
        $unUser = $unControleur->verifConnexion ($email, $mdp);//on appelle la fonction du controlleur pour vérifier si on a bien cet utilisateur et ce mdp dans la base
        if (isset($unUser['prenom']))//si on l'a (donc l'objet retouurné contient bien un nom)
        {
            $_SESSION['nom'] = $unUser['nom']; //on sauvegarde le nom dans la variable SESSION
            $_SESSION['prenom'] = $unUser['prenom'];//Le prénom
            $_SESSION['email'] = $unUser['email'];//l'email
            $_SESSION['mdp'] = $unUser['mdp'];//le mdp
            $_SESSION['iduser'] = $unUser['iduser']; //L'id user de l'utilisateur
            $unPanier = $unControleur->getIdPanier($_SESSION['iduser']);

            $_SESSION['idpanier'] = $unPanier['IdPanier'];
        }
        else //si l'utilisateur n'est pas trouvé
        {
            echo "<br/>Veuillez vérifier vos identifiants !";//message d'erreur
        }
    }
    if ( ! isset($_SESSION['email']))//si on est pas connecté (variable session non initialisée)
    {
        
        if (isset($_GET['inscription']) and $creationcompte==0)//si on demande une inscription et que l'on ne vient pas juste de s'inscrire
        {
            require_once("vue/vue_inscription.php");//formulaire d'inscription
        }
        else//sinon
        {
            require_once("vue/vue_connexion.php");//formlaire de connection
        }
    }
    else//si on est connecté
    {
        echo '<h2>';
        echo 'Bonjour ' . $_SESSION['prenom'] . ' !';//afficher bonjour et le prénom
        echo '<a href="index.php?page=4"> <img src="images/deconexion1.png" width="30" height="30">  </a><br/> ';
        echo ' </h2>';

        //afficher les icones avec un lien avec une variable page différente selon l'action
     require_once("vue/vue_menu.php");//menu
        
        if (isset($_GET['page']))//si on a demandé une action
        {
            $page = $_GET['page']; //récupérer le numéro de l'action
        }else {
            $page = 99; //action 99 inconnue
        }
        switch($page){//selon l'action afficher la bonne page
            case 1 : require_once ("categorie.php"); break; 
            case 2 : require_once ("vue/panier.php"); break; 
            case 3 : require_once ("vue/commandes.php"); break; 
            case 4 :    session_destroy(); 
                header("Location: index.php");
                break;
            case 30 : require_once ("vue/contenuCommande.php"); break;
            default : require_once ("index.php"); break;
            
        }
    }
    ?>
    
    </center>
</body>