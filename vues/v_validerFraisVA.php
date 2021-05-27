<?php
/** 
 * Affichage des frais dont le montant est validé
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */

?>
<hr>
<div class="panel panel-info">
    <div class="panel-heading">Eléments forfaitisés-Nom:<?php echo $nomC?> <?php echo $moisC?></div>
    <table class="table table-bordered table-responsive">
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle']; ?>
                <th> <?php echo htmlspecialchars($libelle) ?></th>
                <?php
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite']; ?>
                <td class="qteForfait"><?php echo $quantite ?> </td>
                <?php
            }
            ?>
        </tr>
    </table>
</div>
<br><br>
<div class="panel panel-info">
    <div class="panel-heading">Descriptif des éléments hors forfait - 
        <?php echo $infoFF['nbJustificatifs']; ?> justificatifs reçus</div>
    <table class="table table-bordered table-responsive">
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>                
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant']; ?>
            <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<br><br>
<div class="panel panel-info">
    <div class="panel-heading">Fiche de frais</div>
    <form method="post" role="form" id="valider" action="index.php?uc=suivreLePaimentFicheDeFrais&action=selectionnerFiche">
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Mois</th>
            <th>Nombre de justificatifs</th>
            <th>Montant validé</th>
            <th class="date">Date modification</th>
            <th>Etat de la fiche</th>
        </tr>
        <input type="hidden" name="idVA" value="<?php echo $idv ?>">
        <input type="hidden" name="moisVA" value="<?php echo $moisC ?>">
        <?php
       
            $NbJ = $infoFF['nbJustificatifs'];
            $montantV = $infoFF['montantValide']; 
            $dateV = dateAnglaisVersFrancais($infoFF['dateModif']);
            $etatfiche=$infoFF['idEtat'];?>
            <tr>
                <td><?php echo $moisC ?></td>
                <td><?php echo $NbJ ?></td>
               <td><?php echo $montantV ?></td>
                <td><?php echo $dateV ?></td>
                <td><?php echo $etatfiche?></td>
            </tr>
           
        
    </table>
    
    
    
</div>

</form>
<button class="btn btn-success" form="valider" name="validerMontantRB">Valider la mise en paiement</button>
                         