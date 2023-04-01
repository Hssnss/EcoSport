<h2>Ajout article</h2>  
    <!--multipart/form-data permet de gérer l'insertion de fichier-->
<form method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Nom: </td>
            <td><input type="text" placeholder="Mettre le nom" name="nom" value="<?= ($lArticle!=null)?$lArticle['nom']: ''?>"></td>
        </tr>
        <tr>
            <td>Description: </td>
            <td><textarea placeholder="Entrer une description" name="description" style="width:300px; height:100px; resize:none;"><?= ($lArticle!=null)?$lArticle['description']: ''?></textarea></td>
        </tr>
        <?php
            if($lArticle==null){
                //En cas de modification d'un article on ne permet pas d'ajouter une image pour modifier la précédente
                echo '<tr>
                    <td>Image: </td>
                    <td><input type="file" name="image" id="image" required/></td>
                </tr>';
            }
        ?>
        
        <tr>
            <td>Prix: </td>
            <td><input type="text" placeholder="Mettre le prix" name="prix" value="<?= ($lArticle!=null)?$lArticle['prix']: ''?>"></td>
        </tr>
        <tr>
            <td>Stock: </td>
            <td><input type="text" placeholder="Mettre le stock" name="stock" value="<?= ($lArticle!=null)?$lArticle['stock']: ''?>"></td>
        </tr>
        <tr>
            <td>Catégorie: </td>
            <td>
                <select name="idcategorie">
                    <?php foreach($lesCategories as $uneCategorie): ?>
                        <option value="<?= $uneCategorie['idcategorie'] ?>" <?= ($lArticle!=null && $lArticle['idcategorie'] == $uneCategorie['idcategorie']) ? 'selected' : '' ?>>
                            <?= $uneCategorie['idcategorie'] . ' ' . $uneCategorie['libelle'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <?php
            //Si on est dans un cas de modification de l'article on récupère son id
            if($lArticle!=null){
                echo "<input type='hidden' name='idarticle' value=".$lArticle['idarticle'].">";
                //Le nom de l'image est récupéré
                echo "<input type='hidden' name='nomImage' value=".$lArticle['image'].">";
            }
        ?>
        <tr>
            <td></td>
            <td>
                <input type="reset"  name="Annuler" value="Annuler">
                <input type="submit"  
                    <?php
                        if($lArticle!=null){
                            echo 'name="Modifier" value="Modifier"';
                        }
                        else{
                            echo 'name="Valider" value="Valider"';
                        }
                    ?>>
            </td>
        </tr>
    </table>
</form>