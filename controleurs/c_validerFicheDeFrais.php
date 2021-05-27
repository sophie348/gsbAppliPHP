<?php

/** 
 * Validation des frais forfaits, hors forfaits et validation de la fiche
 * @category  PPE
 * @package   GSB
 * @author Sophie Abouaf
 */

include 'tests/gendatas/fonctions.php';
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$moisEnCours= getMois(date('d/m/Y'));
$moisPrecedent= getMoisPrecedent($moisEnCours);

$pdo->ficheMoisPrecedentCL($moisPrecedent);



switch ($action){
    case 'selectionnerVisiteurMois':
        $lesVisiteurs=$pdo->getTousLesVisiteurs();
        $lesCles=array_keys($lesVisiteurs);
        $visiteurASelectionner=$lesCles[0];
        $lesMois=getLesDouzeMois($moisEnCours);
        $lesCles2=array_keys($lesMois);
        $moisASelectionner=$lesCles2[0];
       
        
    include 'vues/v_choisirVisiteurMois.php';
        break;
    case 'afficheLaFiche':
     
     $idv = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
     $moisC= filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
     $nomC=$pdo->getNom($idv);
 
          
      $lesVisiteurs=$pdo->getTousLesVisiteurs();
      $visiteurASelectionner=$idv;
      $lesMois=getLesDouzeMois($moisEnCours);
      $moisASelectionner=$moisC;
      
       
    
     $fichesFrais=$pdo->getLesFraisForfait($idv, $moisC);
     $fichesHf=$pdo->getLesFraisHorsForfait($idv, $moisC);
     $infoFF=$pdo->getLesInfosFicheFrais($idv,$moisC);
     $nbjHF=$infoFF['nbJustificatifs'];
     $etatFiche=$infoFF['idEtat'];
       if($etatFiche=='VA'||$etatFiche=='RB'){
           affichermessage("La fiche a dejà été cloturée");
          include 'vues/v_message.php';
       }
     if(!$infoFF){
         ajouterErreur("pas de fiche pour ce visiteur et ce mois");
         include 'vues/v_erreurs.php';  
             
         include 'vues/v_choisirVisiteurMois.php';
     }else{
      include 'vues/v_choisirVisiteurMois.php';
      include 'vues/v_validerFrais.php';
      include 'vues/v_validerFraisHF.php';
     }
      
       break;
    
    case 'majFraisForfait':
  
        $idv= filter_input(INPUT_POST, 'i', FILTER_SANITIZE_STRING);
        $nomC= filter_input(INPUT_POST, 'nn', FILTER_SANITIZE_STRING);
        $moisC= filter_input(INPUT_POST, 'mm', FILTER_SANITIZE_STRING);
        $lesVisiteurs=$pdo->getTousLesVisiteurs();
        $visiteurASelectionner=$idv;
    
        $lesMois=getLesDouzeMois($moisEnCours);
        $moisASelectionner=$moisC;
        include 'vues/v_choisirVisiteurMois.php';
         $infoFF=$pdo->getLesInfosFicheFrais($idv,$moisC);
       $nbjHF=$infoFF['nbJustificatifs'];
       
        $fichesFrais=$pdo->getLesFraisForfait($idv, $moisC);
       
        $lesF=filter_input(INPUT_POST,'lesFrais',FILTER_DEFAULT,FILTER_FORCE_ARRAY);
        $fichesHf=$pdo->getLesFraisHorsForfait($idv, $moisC);
       
        if(lesQteFraisValides($lesF)){
            $pdo->majFraisForfait($idv,$moisC,$lesF);
            $fichesFrais=$pdo->getLesFraisForfait($idv, $moisC);
            affichermessage("les données ont bien été mises a jour");
            include 'vues/v_message.php';
            
      
        include 'vues/v_validerFrais.php';
        
        }else{
            ajouterErreur("seuls les valeurs numériques sont acceptées!");
            include 'vues/v_erreurs.php';  
        }
        include 'vues/v_validerFraisHF.php';
      break;
    
        
        
     case 'majFraisHF' :
      
        $idv= filter_input(INPUT_POST,'idvisiteurHF',FILTER_SANITIZE_STRING);
        $moisC= filter_input(INPUT_POST,'moisHF',FILTER_SANITIZE_STRING);
        $libelleHF=filter_input(INPUT_POST,'libelleHF',FILTER_SANITIZE_STRING);
        $montantHF=filter_input(INPUT_POST,'montantHF',FILTER_VALIDATE_FLOAT);
        $dateFrais=filter_input(INPUT_POST,'dateHF',FILTER_SANITIZE_STRING);
        $nomC=$pdo->getNom($idv);
        
        
        $idf= filter_input(INPUT_POST,'hf',FILTER_SANITIZE_STRING);
        
        
       
        
        $lesVisiteurs=$pdo->getTousLesVisiteurs();
       
        $visiteurASelectionner=$idv;
        $lesMois=getLesDouzeMois($moisEnCours);
 
        $moisASelectionner=$moisC;
        $fichesFrais=$pdo->getLesFraisForfait($idv, $moisC);
        $fichesHf=$pdo->getLesFraisHorsForfait($idv, $moisC);
        $infoFF=$pdo->getLesInfosFicheFrais($idv,$moisC);
        $nbjHF=$infoFF['nbJustificatifs'];
       
        
        
        if(isset ($_POST["refuser"])){
           $pdo->refuserFraisHorsForfait($idf);
           $fichesHf=$pdo->getLesFraisHorsForfait($idv, $moisC);
        }
        if(isset($_POST["corriger"])){
            valideInfosFrais($dateFrais, $libelleHF, $montantHF);
            if (nbErreurs() != 0) {
                include 'vues/v_erreurs.php';
                 } else {
                $pdo->majFraisHorsForfait($idf,$libelleHF,$montantHF);
                $fichesHf=$pdo->getLesFraisHorsForfait($idv, $moisC);
                }
            
        
        }
        if(isset($_POST["reporter"])){
            $moisuivant= getMoisSuivant($moisC);
            $pdo->creeNouvellesLignesFrais($idv, $moisuivant);
            $pdo->majEtatFicheFrais($idv,$moisuivant,'CR');
            $lesFraisReportes=array(0,0,0,0);
            $pdo->majFraisForfait($idv,$moisuivant,$lesFraisReportes);
            $pdo->creeNouveauFraisHorsForfait($idv,$moisuivant,$libelleHF,$dateFrais,$montantHF);
            $pdo->supprimerFraisHorsForfait($idf);
            $fichesHf=$pdo->getLesFraisHorsForfait($idv, $moisC);
            
            
        }
        if(isset($_POST["validerfiche"])){
            $nbjHF= filter_input(INPUT_POST,'nbJ',FILTER_VALIDATE_INT);
     //       $idvisiteurHF= filter_input(INPUT_POST,'idvisiteurHF',FILTER_SANITIZE_STRING);
      //      $moisHF= filter_input(INPUT_POST,'moisHF',FILTER_SANITIZE_STRING);
            
            $pdo->majNbJustificatifs($idv,$moisC,$nbjHF);
            $montantFF=$pdo->sommeFF($idv,$moisC);
            $montantHF=$pdo->sommeHF($idv,$moisC);
            $total=$montantFF[0]+$montantHF[0];
            $pdo->majMontant($total,$idv,$moisC);
            $pdo->majEtatFicheFrais($idv,$moisC,'VA');
            affichermessage("La fiche a bien été cloturée");
            include 'vues/v_message.php';
             
             
        }
        
        
      
       include 'vues/v_choisirVisiteurMois.php';
       include 'vues/v_validerFrais.php';
     include 'vues/v_validerFraisHF.php';
       
        break;
   
        
}

 
 
 
