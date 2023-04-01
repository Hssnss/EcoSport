<!-- Liens vers la feuille de style -->
<link rel="stylesheet" href="page.css">
<br>
<br>
<br>
<br>
<br>

<!-- Conteneur pour les articles -->
<div src=images/logo.png class="articles-list">
  <!-- Boucle pour parcourir et afficher chaque article -->
  <?php foreach ($lesArticles as $art): ?>
    <div class="article">
      <div class="article-image">
        <!-- Affichage de l'image de l'article -->
        <img src="images/Articles/<?= $art['image'] ?>" alt="<?= $art['nom'] ?>">
      </div>
      <div class="article-details">
        <!-- Affichage du nom de l'article -->
        <h4><?= $art['nom'] ?></h4>
        <!-- Affichage de la description de l'article -->
        <p class="description"><?= $art['description'] ?></p>
        <!-- Affichage du prix de l'article -->
        <p class="price"><?= $art['prix'] ?>€</p>
        <?php
        // Vérifier si l'utilisateur est connecté et si son rôle est "Client"
        if (array_key_exists('role', $_SESSION) && $_SESSION['role'] == 'Client') {
          // Si l'utilisateur est un "Client", afficher le bouton "Ajouter au panier"
echo "<a href='index.php?page=1&idcategorie=".$idcategorie."&ajouterArticleId=".$art['idarticle']."' class='btn-add-to-cart'>Ajouter au panier</a>";
}
?>
</div>
</div>

  <?php endforeach; ?>
  <?php  
  // Vérifier si l'utilisateur est connecté et si son rôle n'est PAS "Client"
  if (array_key_exists('role', $_SESSION) && $_SESSION['role'] != 'Client'){
    // Si l'utilisateur n'est pas un "Client", afficher le bouton "Ajouter un produit"
    echo "<a href='index.php?page=1&ajouterProduit=true' class='btn-add-to-cart'>Ajouter un produit</a>";
  }
  ?>
</div>
