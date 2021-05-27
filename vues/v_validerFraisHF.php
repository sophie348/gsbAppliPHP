<?php
/** 
 * Affichage des frais hors forfaits
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */
?><hr>
<div class="row">
<div class="panel panel-info">
    <div class="panel-heading">Frais hors forfait</div>
    
    
        <table class="table table-bordered table-responsive">
        <tr>
            <td>Nom</td><td>id</td><td>mois</td><td>libelle</td><td>date</td><td>montant</td><td>validation, corriger ou reporter</td>
        
                
           </tr>
           
   <?php       
   foreach ($fichesHf as $unFraisHF){
      $libelleHF=htmlspecialchars($unFraisHF['libelle']);
      $dateHF= $unFraisHF['date'];
      $montantHF=$unFraisHF['montant'];
  
      $idfHF=$unFraisHF['id'];
     ?>
     <form action="index.php?uc=saisirLesFrais&action=majFraisHF" method="post" role="form">      
    
        <tr>
            
            <input type="hidden" name="idvisiteurHF" value="<?php echo $idv?>">
            <input type="hidden" name="dateHF" value="<?php echo $dateHF;?>">
           
            
            <td><?php echo $idv ?>
            
            
            </td>
           
            <td><input class="form-control" value=<?php echo $idfHF?> name="hf" type="text" maxlength="30" >
            
            
            </td>
            <td><input class="form-control" value=<?php echo $moisC?> name="moisHF" type="text" maxlength="30" >
            
            
            </td>
            <td>
                <input class="form-control" value=<?php echo $libelleHF?> name="libelleHF" type="text" maxlength="30" >
                
            
            </td>
            <td><?php echo $dateHF;?>
            
            
            </td>
            
            <td>
                <input class="form-control" value=<?php echo $montantHF ?> name="montantHF" type="text" maxlength="30" >
                
            
            </td>
            
          
            <td><button type="submit"  name="refuser" class="btn btn-danger" >Refuser</button>
                       
                <button type="submit"  name="corriger" class="btn btn-warning">Corriger</button>
                       
                <button type="submit" name="reporter" class="btn btn-Light">Reporter</button>
                       </td>
            
             
        </tr>
                
                     </form>

 
       <?php
            }?>
       

    </table>
</div>
    <div class="row" >
        
        <div class="col-md-4">
        <h3>Validation des données</h3>
        <form  action="index.php?uc=saisirLesFrais&action=majFraisHF" method="post" role="form">
           <div>
                <label for="nbJ">Nombre de justificatifs: </label>
                <input type="text" id="nbJ" name="nbJ" size="10" value="<?php echo $nbjHF ?>"> 
                <input type="hidden" name="idvisiteurHF" value="<?php echo $idv?>">
                <input type="hidden" name="moisHF" value="<?php echo $moisC;?>">
            </div> 
            <div>
                <button class="btn btn-success" type="submit" name="validerfiche">Validation de la fiche</button> 
            </div>
        </div>
          
        </form>   
        </div>
</div>

