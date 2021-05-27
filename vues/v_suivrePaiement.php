<?php
/** 
 * vue affichage des frais pour mettre en paiement
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */

?>



<h2>Choisir un visiteur et un mois(Parmi les fiches validées)</h2>

<div class="row">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
        <form action="index.php?uc=suivreLePaimentFicheDeFrais&action=afficheLaFicheVA"  
              method="post" role="form">
            <div class="form-group">
                <label for="lstVisiteur" accesskey="n">Visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteurs" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id=$unVisiteur['id'];
                        $prenom = $unVisiteur['prenom'];
                        $nom = $unVisiteur['nom'];
                        
                       
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $prenom . ' ' . $nom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $prenom . ' ' . $nom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = substr($mois,0,4);
                        $numMois = substr($mois,4,2);
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
           
            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
            
        </form>
    </div>
</div>