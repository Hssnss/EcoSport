<?php

require_once ("controleur/controleur.class.php");
//instancier la classe controleur en créant un objet
$unControleur = new Controleur();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
</head>
<body>
    <center>
    <h2> Rechercher un article</h2>
    <?php
    if ( ! isset($_SESSION['email']))
    {

        session_destroy();  
        header('Location: index.php'); //si pas connecté on revient à l'accueil
        exit();
    }
    else
    {
        if(isset ($_GET['ajouterId']))//si on demande à ajouter un article (vient de la page recherche)
        {
            $unControleur->AjouterAuPanier($_SESSION['idUser'],$_GET['ajouterId']);//controleur pour ajouter l'article
            $message='article ajoute au panier';
            echo '<script type="text/javascript">window.alert("'.$message.'");</script>';//popup qui affiche un message
        }
        $articles = $unControleur->getArticles ();//récupérer la liste des articles avec le controlleur

        echo '<body>';
        echo '<div >';
        echo '<table>';
        echo '<tr>';

        foreach ($articles as $art)//boucler sur les articles et générer le code html d'affichage et créer un bouton ajouter au panier (qui passe l'id de l'article dans l'url et renvoi vers le panier
        {
            echo '  

                <td>

                            <figure align="center" width="100%">
                                    <div class="columnArticle">
                                    <img class="imageArticle" src="images/Articles/' . $art['NomImage'] . '" >
                                    <figcaption> ' . $art['Nom'] . ' </figcaption>
                                    <br>
                                    <figcaption> ' . $art['Description'] . ' </figcaption>
                                    <br>
                                    <figcaption> ' . $art['prix'] . ' </figcaption>
                                    
                                    <a href="index.php?page=1&ajouterId=' . $art['idcategorie'] . '"> <img src="images/panier1.png" width="20" height="20"></a>
                                    </div>
                            </figure>

                </td>
    ';
            
        }
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</body>';


    }
    

    
    ?>
    
    </center>
</body>