<h3> Liste des articles</h3>


<table>
    <tr>
<?php
    foreach ($lesArticles as $art)//boucler sur les articles et générer le code html d'affichage et créer un bouton ajouter au panier (qui passe l'id de l'article dans l'url et renvoi vers le panier
        {
            echo '  

             
            <td>
                            <figure align="center" width="100%">
                                    <div class="columnArticle">
                                    <img class="imageArticle" src="images/Articles/' . $art['NomImage'] . '" >
                                    <figcaption> ' . $art['Nom'] . ' </figcaption>
                                    
                                    <figcaption> ' . $art['Description'] . ' </figcaption>
                                    
                                    <figcaption> ' . $art['prix'] . ' </figcaption>
                                    
                                    <a href="index.php?page=1&idcategorie='.$idcategorie.'&ajouterArticleId=' . $art['idArticle'] . '"> <img src="images/panier1.png" width="20" height="20"></a>
                                    </div>
                            </figure>
            </td>


    ';
            
        }

?>
    </tr>
</table>