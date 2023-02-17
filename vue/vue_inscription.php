<h2>Création d'un compte</h2>

<form method="post" action="">
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
    <input type="email" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>
  </div>
  <div class="form-group">
    <label for="siret">Siret :</label>
    <input type="text" id="siret" name="siret" required>
  </div>
  <div class="form-group">
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" required>
  </div>
  <div class="form-group">
    <label for="telephone">Téléphone :</label>
    <input type="tel" id="telephone" name="telephone" required>
  </div>
  <div class="form-group">
    <input type="hidden" name="role" value="Client">
  </div>
  <div class="form-group">
    <button type="submit" name="CreerCompte">Inscription</button>
  </div>
  <div class="form-group">
    <a href="index.php">Compte existant</a>
  </div>
</form>
