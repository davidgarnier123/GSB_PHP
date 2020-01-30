<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'suivreFiche':
     $lesVisiteurs = $pdo->getAllVisiteur();
    if (!isset($_GET['Vid']) && !isset($_GET['mois'])) {
    include_once 'vues/v_entete_comptable.php';
    include_once 'vues/v_choisirFiche.php';
    include_once 'vues/v_choisirFraisPaiement.php';
    }
    if (isset($_GET['Vid']) && !isset($_GET['mois'])) {
         $lesFiches = $pdo->getLesMoisPaiement($_GET['Vid']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFraisPaiement.php';
         if(count($lesFiches) === 0){
             echo '<h3 style="color:orange">Aucun fiche de frais pour ce visiteur.</h2>';
         } else {
             echo '<h3 style="color:orange">Veuillez choisir un mois.</h2>';
         }
    } elseif (isset($_GET['Vid']) && isset($_GET['mois'])){
        $lesFiches = $pdo->getLesMoisPaiement($_GET['Vid']);
    $laFiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
    $horsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
    $justificatifs = $pdo->getNbjustificatifs($_GET['Vid'], $_GET['mois']);
    $Infos = $pdo->getLesInfosFicheFrais($_GET['Vid'], $_GET['mois']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFraisPaiement.php';
         include_once 'vues/v_fichePaiement.php';
    }
    break;
}