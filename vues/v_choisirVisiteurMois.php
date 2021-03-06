<?php
/** 
 * choix visiteur et mois
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */



?>

<h2>Choisir un visiteur et un mois(dans les 12 derniers)</h2>

<div class="row">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
        <form action="index.php?uc=saisirLesFrais&action=afficheLaFiche"  
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
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
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
