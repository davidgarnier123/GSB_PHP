<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'choisirFrais':
    $lesVisiteurs = $pdo->getAllVisiteur();
    if (isset($_GET['Vid']) && !isset($_GET['mois'])) {
         $lesFiches = $pdo->getLesMoisDisponibles($_GET['Vid']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFrais.php';
         if(count($lesFiches) === 0){
             echo '<h3 style="color:orange">Aucun fiche de frais pour ce visiteur.</h2>';
         } else {
             echo '<h3 style="color:orange">Veuillez choisir un mois.</h2>';
         }
    } elseif (isset($_GET['Vid']) && isset($_GET['mois']) && !isset($_GET['maj'])) {
    $lesFiches = $pdo->getLesMoisDisponibles($_GET['Vid']);
    $laFiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
    $horsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
    $justificatifs = $pdo->getNbjustificatifs($_GET['Vid'], $_GET['mois']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFrais.php';
         include_once 'vues/v_fiche.php';
         if(isset($_GET['success'])){
             echo '<script> alert("Mise à jour réussie"); </script>';
         }
} elseif (isset($_GET['Vid']) && isset($_GET['mois']) && isset($_GET['maj'])){
    if ($_GET['maj'] === 'fraisForfait'){
        if(isset($_POST['discard'])){
            $laFiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
            header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
        }else {
        $maj = array('ETP' => $_POST['ETP'], 'KM' => $_POST['KM'], 'NUI' => $_POST['NUI'], 'REP' => $_POST['REP']);
        $pdo->majFraisForfait($_GET['Vid'], $_GET['mois'], $maj);
        header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois'] . "&success=true");
        }
        
    } elseif ($_GET['maj'] === 'fraisHorsForfait') {
        echo 'horsforfait';
    }
    
} elseif (!isset($_GET['Vid']) && !isset($_GET['mois'])){
    include_once 'vues/v_entete_comptable.php';
    include_once 'vues/v_choisirFrais.php';
}
    
    break;
}

