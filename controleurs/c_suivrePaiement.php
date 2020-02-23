<?php

/* 
 * Contrôleur qui permet d'afficher la selection du visiteur ainsi que le mois.
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'suivreFiche':
    $lesVisiteurs = $pdo->getAllVisiteur();
    //Si l'id du visiteur et le mois ne sont pas passés en parametres, j'affiche la page de base
    if (!isset($_GET['Vid']) && !isset($_GET['mois'])) {
        if (!isset($_GET['search'])){
            include_once 'vues/v_entete_comptable.php';
            include_once 'vues/v_choisirFiche.php';
            include_once 'vues/v_choisirFraisPaiement.php';
        } else {
            // Si une recherche par nom est effectué, filtrer la liste des visiteurs
            if(!isset($_GET['Vid']) && !isset($_GET['mois']) && isset($_GET['search']) && $_POST['name'] !== ''){
                $leNom = $_POST['name'];
                $lesVisiteursFilter = [];
        
            foreach ($lesVisiteurs as $unVisiteur){
                if((strpos(strtolower($unVisiteur['Vnom']), strtolower($leNom)) !== false) || (strpos(strtolower($unVisiteur['Vprenom']), strtolower($leNom)) !== false)){
                    array_push($lesVisiteursFilter, $unVisiteur);
                }
            }
                include_once 'vues/v_entete_comptable.php';
                include_once 'vues/v_choisirFiche.php';
                include_once 'vues/v_choisirFraisPaiement.php';
           }
        }
        
    }
    // Si l'id du visiteur est passé en parametre : j'affiche les mois disponibles
    if (isset($_GET['Vid']) && !isset($_GET['mois'])) {
         $lesFiches = $pdo->getLesMoisPaiement($_GET['Vid']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFraisPaiement.php';
         if(count($lesFiches) === 0){
             echo '<h3 style="color:orange">Aucun fiche de frais pour ce visiteur.</h2>';
         } else {
             echo '<h3 style="color:orange">Veuillez choisir un mois.</h2>';
         }
    // Si l'id du visiteur et le mois et choisis : j'affiche la fiche correspondante
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