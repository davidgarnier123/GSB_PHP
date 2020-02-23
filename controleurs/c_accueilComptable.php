<?php

/* 
 * Contrôleur permet d'afficher la page de login ou l'accueil comptable si la connexion est reussie
 */

if ($estConnecte) {
    include 'vues/v_accueilComptable.php';
} else {
    include 'vues/v_connexion.php';
}
