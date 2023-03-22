<link rel="stylesheet" href="page.css">
<br>
<br>
<br>
<br>
<br>


<div src=images/logo.png class="articles-list">
  <?php foreach ($lesArticles as $art): ?>
    <div class="article">
      <div class="article-image">
        <img src="images/Articles/<?= $art['image'] ?>" alt="<?= $art['nom'] ?>">
      </div>
      <div class="article-details">
        <h4><?= $art['nom'] ?></h4>
        <p class="description"><?= $art['description'] ?></p>
        <p class="price"><?= $art['prix'] ?>€</p>
       <?php if ($_SESSION['role'] == 'Client'){
          echo "<a href='index.php?page=1&idcategorie=".$idcategorie."&ajouterArticleId=".$art['idarticle']."' class='btn-add-to-cart'>Ajouter au panier</a>";
       }
      ?>
      </div>
    </div>
  <?php endforeach; ?>

<?php  
if ($_SESSION['role'] != 'Client'){
  echo "<a href='index.php?page=1&idcategorie=".$idcategorie."&ajouterArticleId=".$art['idarticle']."' class='btn-add-to-cart'>Ajouter un produit</a>";
}


?>

    


</div>
