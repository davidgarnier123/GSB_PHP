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
    } elseif (isset($_GET['Vid']) && isset($_GET['mois'])) {
    $lesFiches = $pdo->getLesMoisDisponibles($_GET['Vid']);
    $laFiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
    $horsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
    $justificatifs = $pdo->getNbjustificatifs($_GET['Vid'], $_GET['mois']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFrais.php';
         include_once 'vues/v_fiche.php';
}
    include_once 'vues/v_entete_comptable.php';
    include_once 'vues/v_choisirFrais.php';
    break;
}

