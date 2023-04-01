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
    <h2>Mes Commandes</h2>
    <?php
    if (isset($_GET['validerPanier'])) {
        $validerPanier = $_GET['validerPanier'];
        if ($validerPanier == 1) {
            $idCommande = $_GET['idCommande'];
            $unControleur->terminerCommande($idCommande);
            echo '<script type="text/javascript">window.alert("Commande validée !");</script>';
            header("Location: index.php?page=6");
        }
    }
    $lesCommandes = $unControleur->getPanierCommandeTerminer($_SESSION['iduser']);
    ?>
    <table>
        <tr>
            <th>Numéro de commande</th>
            <th>Image</th>
            <th>Article</th>
            <th>Prix</th>
            <th>Date</th>
        </tr>
        <?php
        $compteur = 1;
        $idCommandePrec = -1;
        foreach ($lesCommandes as $art) {
            $datecommande = new DateTime($art['DateCommande']);
            $dateformatee = $datecommande->format('d/m/Y');
            $heureformatee = $datecommande->format('H:i');
            
            if ($art['idcommande'] != $idCommandePrec) {
                $numCommande = $compteur;
                $compteur++;
            }
            $idCommandePrec = $art['idcommande'];
            
            echo "
                <tr>";
                echo "<td> Commande numéro " . $numCommande . "</td>";
                echo "<td> <img src='./images/Articles/" . $art['image'] . "' alt='' width='100' height='100'></td>";
                echo "<td>" . $art['Nom'] . "</td>";
                echo "<td>" . $art['prix'] . " €</td>";
                echo "<td>" . $dateformatee . ' à ' . $heureformatee . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
    </html>
    

