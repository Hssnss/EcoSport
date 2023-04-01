<h2>Création d'un compte client particulier</h2>

<form method="POST" action="">
  <div class="form-group">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
  </div>
  <div class="form-group">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>
  </div>
  <div class="form-group">
    <label for="email">E-mail :</label>
    <input type="text" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>
  </div>
  <div class="form-group">
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" required>
  </div>
  <div class="form-group">
    <label for="telephone">Téléphone :</label>
    <input type="tel" id="telephone" name="tel" required>
  </div>
  <div class="form-group">
    <button type="submit" name="InscriptionClient">Inscription</button>
  </div>
  <div class="form-group">
    <a href="index.php?page=4">Compte existant</a>
  </div>
</form>

<?php
if(isset($_POST['InscriptionClient'])) {
  // echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";
  $unControleur->insertClient($_POST);
  header("Location: index.php?page=4");
}


?>