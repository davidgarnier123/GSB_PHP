<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">  
    <span>Choisir le visiteur : </span>
    <select id="lstVisiteur" name="lstVisiteur" onChange="change_function(this);" class="browser-default custom-select">
        <?php
        
            foreach ($lesVisiteurs as $unVisiteur) {
                if (isset($_GET['Vid'])) {
                    if($_GET['Vid'] === $unVisiteur['Vid']){
        ?>        
            <option selected="selected" value="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $unVisiteur['Vid']  ?>">
        <?php
                    } else {
                        
        ?>
            <option value="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $unVisiteur['Vid']  ?>">
        <?php
                    }
                
        ?>
           
        <?php
           
        
        } else {
        ?>
            <option value="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $unVisiteur['Vid']  ?>">
        <?php 
        }
        echo $unVisiteur['Vnom'] . ' ' . $unVisiteur['Vprenom'] ;
        };
        ?>
                </option>
</select>
    <span>Mois : </span>
 <select id="lstMois" name="lstMois" class="browser-default custom-select" onChange="change_mois_function(this);">
                     
     <?php
                    foreach ($lesFiches as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                       if ($mois === $_GET['mois']){
                     ?>
                        <option selected="selected" value="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                      
                        
                            <?php
                            } else { ?>
                                 <option  value="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                                 <?php
                            }
                        }
                       
                    ?>  
                        </select>
</div>
<script>      
    function change_function(element){
     document.location.href = element.value;
      }
      function change_mois_function(element){
     document.location.href = element.value;
      }
  </script>