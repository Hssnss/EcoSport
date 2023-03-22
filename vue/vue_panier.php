<table border="0" cellspacing="30" cellpadding="20">
<tr>
    <td>NOM article</td>
    <td>Photo</td>
    <td> Prix </td>
    <td>quantite</td>
    <td>Opérations</td>
</tr>
<?php


foreach ($lesArticles as $art) //boucler sur les articles du panier et cr�er le code html d'affichage
{
    echo "
            <tr>";
            echo "<td>" .$art['Nom']. "</td>";
            echo "<td> <img src=./images/Articles/" .$art['image']. " alt='' width='100' height='100'></td>";
            echo "<td>" .$art['prix']. "</td>";
            echo "<td>" .$art['quantite']. "</td>";
            echo "<td><a href='index.php?page=2&action=sup&retirerId=" . $art['idarticle'] . "'> <img src='images/delete.png' width='20' height='20'></a> ";
            echo "<a href='index.php?page=2&action=plus&retirerId=" . $art['idarticle'] . "'> <img src='images/plus.png' width='20' height='20'></a> "; 
            echo "<a href='index.php?page=2&action=moins&retirerId=" . $art['idarticle'] . "'><img src='images/moins.png' width='20' height='20'></a> ";
            echo "</td>";
            echo "</tr>
        ";
}
echo '</table>';
if (count($lesArticles) > 0) //si on a plus d'un article on affiche le bouton commander (lien vers commandes avec param�tre validerpanier=1), sinon panier vide
{
    echo '<tr> <a href="index.php?page=6&validerPanier=1"> <img src="images/valider.png" width="100" height="100"></a></tr>';
} else {
    echo '<p style="text-align: center; margin: 20px 0;">panier vide</p>';
}


// . "&quantite=" . $art['quantite'] 