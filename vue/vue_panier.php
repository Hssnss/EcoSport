<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 80%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        img {
            display: inline-block;
            max-width: 100%;
        }
        .total {
            font-size: 1.5em;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>NOM article</th>
            <th>Photo</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Opérations</th>
        </tr>
        <?php

        $idCommande=0;
        $compt=0;
        
        foreach ($lesArticles as $art)
        {
            $idCommande=$art['idcommande'];
            $compt=$compt+$art['prix'];
            echo "
                <tr>";
                echo "<td>" .$art['Nom']. "</td>";
                echo "<td> <img src='./images/Articles/" .$art['image']. "' alt='' width='100' height='100'></td>";
                echo "<td>" .$art['prix']. " €</td>";
                echo "<td>" .$art['quantite']. "</td>";
                 echo "<td><a href='index.php?page=2&action=sup&retirerId=" . $art['idarticle'] . "'> <img src='images/delete.png' width='20' height='20'></a> ";
            echo "<a href='index.php?page=2&action=plus&retirerId=" . $art['idarticle'] . "'> <img src='images/plus.png' width='20' height='20'></a> "; 
            //Si la quantité d'article est égal à 1 et qu'on a ppuie sur retirer une quantité on est redirigé vers une page qui appellera le méthode supprimerPanier
            if($art['quantite']==1){
                echo "<a href='index.php?page=2&action=moins&decision=supprimerPanier&retirerId=" . $art['idarticle'] . "'><img src='images/moins.png' width='20' height='20'></a> ";
            }
            else{
                //Sinon on est sur la redirection habituelle
                echo "<a href='index.php?page=2&action=moins&retirerId=" . $art['idarticle'] . "'><img src='images/moins.png' width='20' height='20'></a> ";
            }
            
                echo "</td>";
                echo "</tr>
            ";
        }
        echo '</table>';
        if (count($lesArticles) > 0)
        {
            echo "<br>";
            echo '<h3 class="total">Total: '.$compt.' € </h3>';
            echo '<div style="text-align: center;"><a href="index.php?page=6&validerPanier=1&idCommande='.$idCommande.'"> <img src="images/valider.png" width="100" height="100"></a></div>';
        } else {
            echo '<p style="text-align: center; margin: 20px 0;">Panier vide</p>';
        }

        ?>
    </body>
</html>


