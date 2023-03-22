<h2>Notre Catalogue</h2>

<table>
    <tr>
        <?php

       
        foreach ($lesCategories as $Cat) //boucler sur les articles et générer le code html d'affichage et créer un bouton ajouter au panier (qui passe l'id de l'article dans l'url et renvoi vers le panier
        {
            echo '  
                <td>
                    <br>
                    <br>
                    
                    <figure align="center" width="10%" height="30%">
                        <div class="Categorie">
                            <a href="index.php?page=1&idcategorie=' . $Cat['idcategorie'] . '"> <img class="imageCat"  width="100px" src="images/Categories/' . $Cat['image'] . '" ></a>
                            <figcaption> ' . $Cat['libelle'] . ' </figcaption>
                        </div>
                    </figure>
                </td>';
        }

        ?>
    </tr>
</table>