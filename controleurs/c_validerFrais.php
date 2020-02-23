<?php

/* 
 * Contrôleur qui permet d'afficher les fiches, mettre à jour, valider.
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'choisirFrais':
    $lesVisiteurs = $pdo->getAllVisiteur();
    // Si une recherche par nom est effectué, filtrer la liste des visiteurs
    if(!isset($_GET['Vid']) && !isset($_GET['mois']) && isset($_GET['search']) && $_POST['name'] !== ''){
        $leNom = $_POST['name'];
        $lesVisiteursFilter = [];
        
        foreach ($lesVisiteurs as $unVisiteur){
            if((strpos(strtolower($unVisiteur['Vnom']), strtolower($leNom)) !== false) || (strpos(strtolower($unVisiteur['Vprenom']), strtolower($leNom)) !== false)){
            array_push($lesVisiteursFilter, $unVisiteur);
            }
        }
    }
    // Si un visiteur à été selectionné : affiche les mois avec des fiches correspondantes
    if (isset($_GET['Vid']) && !isset($_GET['mois'])) {
         $lesFiches = $pdo->getLesMoisDisponibles($_GET['Vid']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFrais.php';
         if(count($lesFiches) === 0){
             echo '<h3 style="color:orange">Aucun fiche de frais pour ce visiteur.</h2>';
         } else {
             echo '<h3 style="color:orange">Veuillez choisir un mois.</h2>';
         }
    // Si un visiteur ainsi qu'un mois à été choisi : affiche la fiche de frais correspondante
    } elseif (isset($_GET['Vid']) && isset($_GET['mois']) && !isset($_GET['maj'])) {
    $lesFiches = $pdo->getLesMoisDisponibles($_GET['Vid']);
    $laFiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
    $horsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
    $justificatifs = $pdo->getNbjustificatifs($_GET['Vid'], $_GET['mois']);
         include_once 'vues/v_entete_comptable.php';
         include_once 'vues/v_choisirFrais.php';
         include_once 'vues/v_fiche.php';
         // Si success est en parametre : affiche que la mise à jour à bien été effectuée
         if(isset($_GET['success'])){
             echo '<script> alert("Mise à jour réussie"); </script>';
         }
// Si un visiteur à été selectionné ainsi qu'un mois et que maj est passé en parametre
} elseif (isset($_GET['Vid']) && isset($_GET['mois']) && isset($_GET['maj'])){
    // Si le parametre 'maj' contient frais forfait : il s'agit de mettre à jour les frais forfait de la fiche
    if ($_GET['maj'] === 'fraisForfait'){
        // Si annulation : remise en forme de la fiche
        if(isset($_POST['discard'])){
            $laFiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
            header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
        }else {
        $maj = array('ETP' => $_POST['ETP'], 'KM' => $_POST['KM'], 'NUI' => $_POST['NUI'], 'REP' => $_POST['REP']);
        $pdo->majFraisForfait($_GET['Vid'], $_GET['mois'], $maj);
        header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois'] . "&success=true");
        }
    // Si il s'agit d'une mise à jour des frais hors forfait
    } elseif ($_GET['maj'] === 'fraisHorsForfait') {
        
        if(isset($_POST['discard'])){
            $laFiche = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
            header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
        } else {
        $pdo->majFraisHorsForfait($_GET['Vid'], $_GET['mois'], $_POST['libelle'], $_POST['date'], $_POST['montant'], $_GET['fraisId']);
        header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois'] . "&success=true");
        }
    // Si il s'agit d'une validation de la fiche
    } elseif ($_GET['maj'] === 'validationFiche'){
        
        if(isset($_POST['discard'])){
            header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
        } else {
            $pdo->majEtatFicheFrais($_GET['Vid'], $_GET['mois'], 'VA');
            $lesFrais = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
            $pdo->calculTotalFrais($_GET['Vid'], $_GET['mois'], $lesFrais, $lesFraisHorsForfait);
             header("Refresh:0; url=index.php?uc=validerFrais&action=choisirFrais&Vid=" . $_GET['Vid']);
             echo '<script> alert("La fiche de frais à bien été validé, elle est en cours de paiement."); </script>';
        }
       
    }
// Si le visiteur n'a pas été selectionné : affiche la vue de selection
} elseif (!isset($_GET['Vid']) && !isset($_GET['mois'])){
    include_once 'vues/v_entete_comptable.php';
    include_once 'vues/v_choisirFrais.php';
}
    break;
}

