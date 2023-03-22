<?php
require_once ("controleur/controleur.class.php");
//instancier la classe controleur en cr�ant un objet
$unControleur = new Controleur($serveur, $serveur2, $bdd, $user, $mdp, $mdp2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
	<center>
	<h2> Detail commande</h2>

<?php if (!empty($contenuCommande)): ?>
  <!-- Afficher le contenu de la commande -->
  <?php foreach ($contenuCommande as $article): ?>
    <p>Article : <?php echo $article['nom']; ?></p>
    <p>Prix : <?php echo $article['prix']; ?></p>
    <p>Quantité : <?php echo $article['quantite']; ?></p>
    <hr>
  <?php endforeach; ?>
<?php else: ?>
  <p>Il n'y a pas d'articles dans cette commande.</p>
<?php endif; ?>
	</center>
</body>