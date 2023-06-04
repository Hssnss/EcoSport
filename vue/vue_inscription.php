<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/page.css" />
	<title>EcoSport</title>
</head>
<h2> Création d'un compte </h2>

<form method="post" action="">
  <table>
    <tr>
      <td> Nom : </td>
      <td> <input type="text" name="nom"></td>
    </tr>
    <tr>
      <td> Prénom : </td>
      <td> <input type="text" name="prenom"></td>
    </tr>
    <tr>
      <td> Email : </td>
      <td> <input type="text" name="email"></td>
    </tr>
    <tr>
      <td> Mot de passe : </td>
      <td> <input type="password" name="mdp"></td>
    </tr>
    <tr>
      <td> Siret : </td>
      <td> <input type="text" name="siret"></td>
    </tr>
    <tr>
      <td> Adresses : </td>
      <td> <input type="text" name="adresse"></td>
    </tr>
    <tr>
      <td> Téléphone : </td>
      <td> <input type="text" name="telephone"></td>
    </tr>
    <td><input type="hidden" name="role" value="Client"></td>
    <tr>
      <td><input type="submit" name="CreerCompte" value="Inscription"></td>
      <td> <a href="index.php">Compte existant</a></td>
    </tr>
  </table>
</form>
