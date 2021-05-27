<?php
/** 
 * Suivi des frais et mise en paiement
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action){
    case 'selectionnerFiche':
        
        $lesVisiteurs=$pdo->getTousLesVisiteursVA();
        $lesCles=array_keys($lesVisiteurs);
        $visiteurASelectionner=$lesCles[0];
        
        $lesMois=$pdo->getTousLesMoisVA();
        $lesCles2=array_keys($lesMois);
        $moisASelectionner=$lesCles2[0];
        $validermontant= filter_input(INPUT_POST, 'validerMontantRB', FILTER_SANITIZE_STRING);
        if(isset($validermontant)){
         $idVA= filter_input(INPUT_POST,'idVA',FILTER_SANITIZE_STRING);
         $moisVA= filter_input(INPUT_POST,'moisVA',FILTER_SANITIZE_STRING);
         $pdo->majEtatFicheFrais($idVA,$moisVA,'RB');
         
          
     }
        
        include 'vues/v_suivrePaiement.php';
        break;
    
    case 'afficheLaFicheVA':
     $idv = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
     $moisC= filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
     $nomC=$pdo->getNom($idv);
     
     $lesVisiteurs=$pdo->getTousLesVisiteursVA();
     $lesMois=$pdo->getTousLesMoisVA();
     $visiteurASelectionner=$idv;
     $moisASelectionner=$moisC;
     
    
    
     
     $lesFraisForfait=$pdo->getLesFraisForfait($idv, $moisC);
     $lesFraisHorsForfait=$pdo->getLesFraisHorsForfait($idv, $moisC);
     
     $infoFF=$pdo->getLesInfosFicheFrais($idv,$moisC);
     if(!$infoFF){
         ajouterErreur("Pas de fiche de frais pour ce mois pour ce visiteur");
            include 'vues/v_erreurs.php';  
            include 'vues/v_suivrePaiement.php';
     }else{
     
     
     include 'vues/v_suivrePaiement.php';
     include 'vues/v_validerFraisVA.php';
     }
     
     
     break;
        
}