<?php


?>

<h2>Choisir un visiteur et un mois(dans les 12 derniers)</h2>

<div class="row">
    <div class="col-md-4">
        <h3>Sélectionner un mois : </h3>
        <h3>Choisir dans les douze dernier mois</h3>
    </div>
    <div class="col-md-4">
        <form action="index.php?uc=saisirLesFrais&action=afficheLaFiche"  
              method="post" role="form">
            <div class="form-group"><br>
                <label for="mois">Mois : </label><br>
                <input type="month" name="lstMois"  value=""><br><br>
                
                <label for="name">Choisir un nom:</label><br>
                <input type="text" name="nomV" value=""><br>
                
               
            </div>
           
            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
            <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
                   role="button">
        </form>
    </div>
</div>
