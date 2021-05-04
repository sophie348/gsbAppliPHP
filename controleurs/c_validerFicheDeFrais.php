<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'tests/gendatas/fonctions.php';
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$moisEnCours= getMois('d/m/y');
$moisPrecedent= getMoisPrecedent($moisEnCours);
$pdo->ficheMoisPrecedentCL($moisPrecedent);


switch ($action){
    case 'selectionnerVisiteurMois':
    include 'vues/v_choisirVisiteurMois.php';
        break;
    case 'afficheLaFiche':
     
     $nom = filter_input(INPUT_POST, 'nomV', FILTER_SANITIZE_STRING);
     $m= filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
      
       
      $mois=substr($m,0,4).substr($m,5,2); 
      
     $idv=$pdo->getId($nom);
     $fichesFrais=$pdo->getLesFraisForfait($idv, $mois);
     $fichesHf=$pdo->getLesFraisHorsForfait($idv, $mois);
    include 'vues/v_choisirVisiteurMois.php';
    include 'vues/v_validerFrais.php';
      include 'vues/v_validerFraisHF.php';
      
       break;
    
    case 'majFraisForfait':
        $nom=$_POST['nn'];
        $mois=$_POST['mm'];
        
        $idv=$pdo->getId($nom);
        $fichesFrais=$pdo->getLesFraisForfait($idv, $mois);
       
        $lesF=filter_input(INPUT_POST,'lesFrais',FILTER_DEFAULT,FILTER_FORCE_ARRAY);
        
        $pdo->majFraisForfait($idv,$mois,$lesF);
        echo "les donnees ont bien ete mises a jour";
         $fichesHf=$pdo->getLesFraisHorsForfait($idv, $mois);
     include 'vues/v_choisirVisiteurMois.php';    
     include 'vues/v_validerFrais.php';
      include 'vues/v_validerFraisHF.php';
      break;
    
        
        
     case 'majFraisHF' :
        
         
        $idv= filter_input(INPUT_POST,'idvisiteurHF',FILTER_SANITIZE_STRING);
        $mois= filter_input(INPUT_POST,'moisHF',FILTER_SANITIZE_STRING);
        $nom=$pdo->getNom($idv);
        $fichesFrais=$pdo->getLesFraisForfait($idv, $mois);
        $fichesHf=$pdo->getLesFraisHorsForfait($idv, $mois);
        $idf= filter_input(INPUT_POST,'hf',FILTER_SANITIZE_NUMBER_INT);
        $libelleHF=filter_input(INPUT_POST,'libelleHF',FILTER_SANITIZE_STRING);
        
        if(isset($_POST["supprimer"])){
           $pdo->supprimerFraisHorsForfait($idf);
           
        }

        
        
        $fichesHf=$pdo->getLesFraisHorsForfait($idv, $mois);
 
        
      
       include 'vues/v_choisirVisiteurMois.php';
       include 'vues/v_validerFrais.php';
      include 'vues/v_validerFraisHF.php';
       
        break;
   
        
}

 
 
 
