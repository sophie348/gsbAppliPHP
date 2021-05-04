<?php



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="panel panel-info">
    <div class="panel-heading">Frais hors forfait</div>
    <form action="index.php?uc=saisirLesFrais&action=majFraisHF" method="post" role="form" >
    
   <?php       
   foreach ($fichesHf as $unFraisHF){
      $libelleHF=$unFraisHF['libelle'];
     ?>
    <table class="table table-bordered table-responsive">
        <tr>
            <td>Nom</td><td>mois</td><td>libelle</td><td>date</td><td>montant</td><td>validation</td>
        
                
           </tr>
        <tr>
            <input type="hidden" name="hf" value="<?php echo $unFraisHF['id'];?>">
            <input type="hidden" name="idvisiteurHF" value="<?php echo $unFraisHF['idvisiteur'];?>">
            <input type="hidden" name="moisHF" value="<?php echo $unFraisHF['mois'];?>">
            <input type="hidden" name="libelleHF" value="<?php echo $unFraisHF['libelle'];?>">
          
           
            
            <td><?php
            echo $idv; ?>
            
            </td>
           
            <td><?php
            echo $mois;?>
            
            </td>
            <td>
                <?php
            echo $unFraisHF['libelle'];?>
            
            </td>
            <td><?php
            echo $unFraisHF['date'];?>
            
            </td>
            </td>
            <td><?php
            echo $unFraisHF['montant'];?>
            
            </td>
            
          
            <td><input id="actualiser" type="submit" value="Supprimer" name="supprimer" class="btn btn-danger" 
                       role="button"></td>
            
             
        </tr>
        
       <?php
            }?>
        
    </table>
</form>
</div>

