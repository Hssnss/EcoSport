<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Commandes</title>
    <style>
        h2 {
            text-align: center;
        }
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
    </style>
</head>
<body>
    <h2>Les articles</h2>
    </br>
    </br>
    <table>
        <tr>
            <th>IdArticle</th>
            <th>Image</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>IdCategorie</th>
            <th>Opération</th>
        </tr>
        <?php
            foreach ($lesArticles as $art) {
                
                echo "<tr>";
                echo "<td> N° " . $art['idarticle'] . "</td>";
                echo "<td> <img src='./images/Articles/" . $art['image'] . "' alt='' width='100' height='100'></td>";
                echo "<td>" . $art['nom'] . "</td>";
                echo "<td>" . $art['prix'] . " €</td>";
                echo "<td>" . $art['stock'] . "</td>";
                echo "<td>" . $art['idcategorie'] . "</td>";
                //Suppression et Modification de l'article
                echo "<td>";
                    //Icone Modification
                echo "<a href='index.php?page=1&action=edit&idarticle=".$art['idarticle']."'>
                        <img src='images/edit.png' height='30' width='30'></a>";
                    //Icone suppression
                echo "<a href='index.php?page=1&action=sup&idarticle=".$art['idarticle']."'>
                        <img src='images/delete.png' height='30' width='30'></a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
    </html>
    

