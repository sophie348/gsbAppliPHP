<?php
 if(empty($fichesFrais)){
            echo "Pas de fiche de frais pour ce visiteur ce mois" ;
       }
 
?>
<hr>
<div class="panel panel-primary">
    <div class="panel-heading">Fiche de frais du mois 
        <?php echo $nom . '-' . $mois ?> : </div>
    
</div>
<div class="panel panel-info">
    <div class="panel-heading">Eléments forfaitisés</div>
    <form action="index.php?uc=saisirLesFrais&action=majFraisForfait" method="post" role="form" >

    <table class="table table-bordered table-responsive">
        <tr>
            <td>Nom</td><td>mois</td><td>libelle</td><td>quantite</td>
        </tr>
            <input type="hidden" name="mm" value="<?php echo $mois?>">
            <input type="hidden" name="nn" value="<?php echo $nom?>">          
           <?php        
          
           foreach ($fichesFrais as $unFrais){?>
        <tr>
        
            <td><?php
            echo $idv; ?>
            
            </td>
           
            <td><?php
            echo $mois;?>
            
            </td>
            <td><?php
            echo $unFrais['libelle'];?>
            
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



