<?php
require_once ("controleur/controleur.class.php");
//instancier la classe controleur en cr�ant un objet
$unControleur = new Controleur();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
	<center>
	<h2> Detail commande</h2>

<?php if (!empty($ContenuCommande)): ?> 
  <!-- Afficher le contenu de la commande -->
  <?php foreach ($ContenuCommande as $article): ?>
    <p>Article : <?php echo $article['nom']; ?></p>
    <p>Prix : <?php echo $article['prix']; ?></p>
    <p>Quantité : <?php echo $article['quantite']; ?></p>
    <hr>
  <?php endforeach;  ?>
<?php 
 else: ?>
  <p>Il n'y a pas d'articles dans cette commande.</p>
<?php endif; ?>
	</center>
</body>