<h2>Mes Commandes </h2>

<table>
    <tr>
        <?php
    
foreach ($factures as $art)//boucler sur les commandes et g�n�rer le code html d'affichage + bouton d�tail qui redirige vers la page detailcommande avec param�tre idcommande
        {
            $datecommande = new DateTime($art['datecommande']);//convertir en date
            $dateformatee = $datecommande->format('d/m/Y'); //formater la date pour l'affichage
            $heureformatee = $datecommande->format('H:i'); //formater l'heure pour l'affichage
        }	
        ?>
<td>
<a href="index.php?page=30&IdCommande=' . $art['IdCommande'] . '&IdArticle='.$art['idarticle'].'">
Commande numero ' . $art['IdCommande'] . '. Article: '.$art['idarticle'].' (' . $dateformatee . ' a ' . $heureformatee . ')</tr>
</a>
</td>
<br>
</tr>
</table>
        