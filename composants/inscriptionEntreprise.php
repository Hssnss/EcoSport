<h2>Création d'un compte client entreprise</h2>

<form method="POST" action="">
  <div class="form-group">
    <label for="nom">Nom :</label>
    <input type="text" id="nomEntreprise" name="nom" required>
  </div>
  <div class="form-group">
    <label for="email">E-mail :</label>
    <input type="text" id="emailEntreprise" name="email" required>
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdpENtreprise" name="mdp" required>
  </div>
  <div class="form-group">
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresseEntreprise" name="adresse" required>
  </div>
  <div class="form-group">
    <label for="siret">Siret :</label>
    <input type="text" id="siretEntreprise" name="siret" required>
  </div>
  <div class="form-group">
    <button type="submit" name="InscriptionEntreprise">Inscription</button>
  </div>
  <div class="form-group">
    <a href="index.php?page=4">Compte existant</a>
  </div>
</form>

<?php
if(isset($_POST['InscriptionEntreprise'])) {
  $unControleur->insertEntreprise($_POST);
}
?>