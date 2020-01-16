<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'suivreFiche':
    include 'vues/v_entete_comptable.php';
    include 'vues/v_choisirFiche.php';
    break;
}