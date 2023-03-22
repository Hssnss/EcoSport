<h2> Connexion</h2>

<form method="POST">
	<table>
		<tr>
			<td> Email : </td>
			<td> <input type="text" name="email"></td>
		</tr>
		<tr>
			<td> MDP : </td>
			<td> <input type="password" name="mdp"></td>
		</tr>
		<tr>
			<td><input type="submit" name="SeConnecter" value="Connexion"></td>
			<td><a href="index.php?page=3">Inscription </a></td>
		</tr>
		
		<?php
            if(isset($_POST['SeConnecter'])) {
                $email = $_POST['email'];
                $mdp = $_POST['mdp'];
				// echo "<pre>";
				// var_dump($_POST);
				// echo "</pre>";
                $unUser = $unControleur->selectUser($email, $mdp);
                if ($unUser != null) {
                    $_SESSION['nom'] = $unUser['nom'];
                    $_SESSION['email'] = $unUser['email'];
                    $_SESSION['role'] = $unUser['role'];
                    $_SESSION['iduser'] = $unUser['iduser'];
                    header("Location: index.php?page=0");
                } else {
					echo "invalide";
				}
            }
		?>
	</table>
</form>