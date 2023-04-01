<link rel="stylesheet" href="page.css">
<nav>
    <ul>
        <li>
            <a href="index.php?page=0">Accueil</a>
        </li>

        <li>
            <a href="index.php?page=1">Catalogue</a>
        </li>

        <?php
            if (!isset($_SESSION['email'])) {
                // sinon on affiche le Bouton "S'inscrire"
                echo '<li>';
                echo '<a href="index.php?page=3">S\'inscrire</a>';
                echo '</li>';
            }
        ?>

        <?php
            if(!empty($_SESSION['email']) &&  $_SESSION['role']=='Client') {
                echo '<li>';
                   echo '<a href="index.php?page=2">Panier</a>';
                echo '</li>';
            }
        ?>

        <?php
            if(!empty($_SESSION['email'])&&  ($_SESSION['role']=='Client')) {
                echo '<li>';
                   echo '<a href="index.php?page=6">Commande</a>';
                echo '</li>';
            }
        ?>

        <?php if (!empty($_SESSION['email'])) : ?>
                <li class="identification-nav">
                    <p style="font-weight: bold;"><?php echo $_SESSION['email'] . " / " . $_SESSION['role']; ?></p>
                </li>
            <?php endif; ?>

        <li>
        <?php if(!isset($_SESSION['email'])) : ?>
                <a href="index.php?page=4">Connexion</a>
            <?php else : ?>
                <a href="index.php?page=5"><img src="images/deco.png" alt="Déconnexion" style="width: 50px; height: 50px;"></a>
            <?php endif; ?>
        </li>
        </li>


    </ul>
</nav>
