<?php
 /** 
 * Affichage des frais forfaits
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */
?>
<hr>
<div class="row">
<div class="panel panel-primary">
    <div class="panel-heading">Fiche de frais du mois 
        <?php echo $nomC . '-' . $moisC ?> : </div>
    
</div>
<div class="panel panel-info">
    <div class="panel-heading">Eléments forfaitisés</div>
    <form action="index.php?uc=saisirLesFrais&action=majFraisForfait" method="post" role="form" >

    <table class="table table-bordered table-responsive">
        <tr>
            <td>Nom</td><td>mois</td><td>libelle</td><td>quantite</td>
        </tr>
           <input type="hidden" name="mm" value="<?php echo $moisC?>">
           <input type="hidden" name="nn" value="<?php echo $nomC?>">     
           <input type="hidden" name="i" value="<?php echo $idv?>">     
           <?php        
          
           foreach ($fichesFrais as $unFrais){
               $libelle= htmlspecialchars($unFrais['libelle']);?>
        <tr>
        
            <td><?php
            echo $idv; ?>
            
            </td>
           
            <td><?php
            echo $moisC;?>
            
            </td>
            <td><?php
            echo $libelle?>
            
            </td>
            <td>
                 <input class="form-control" value=<?php echo $unFrais['quantite'];?>
                                       name="lesFrais[<?php echo $unFrais['idfrais'];?>]" type="text" maxlength="45">
                
            </td>
                   
             
        </tr>
       <?php
            }
           ?>
         
    </table>
            
       <input id="actualiser" type="submit" value="Actualiser" class="btn btn-success" 
                   role="button">
       
    </form>

</div>
</div>




