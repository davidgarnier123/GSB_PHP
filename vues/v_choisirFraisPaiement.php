<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">  
    <span>Entrer un nom : </span>
    <form name="form" method="post">
    <input name="name" id="chercherNom" > <button>Chercher</button>
    </form>
    <br><br>
    <span>Choisir le visiteur : </span>
    <select id="lstVisiteur" name="lstVisiteur" onChange="change_function(this);" class="browser-default custom-select">
         <option selected="selected" style="color:grey;">Choisir un visiteur</option>

        <?php
        
            foreach ($lesVisiteurs as $unVisiteur) {
                if (isset($_GET['Vid'])) {
                    if($_GET['Vid'] === $unVisiteur['Vid']){
        ?>        
            <option selected="selected" value="<?php echo 'index.php?uc=suivrePaiement&action=suivreFiche&Vid=' . $unVisiteur['Vid']  ?>">
        <?php
                    } else {
                        
        ?>
            <option value="<?php echo 'index.php?uc=suivrePaiement&action=suivreFiche&Vid=' . $unVisiteur['Vid']  ?>">
        <?php
                    }
                
        ?>
           
        <?php
           
        
        } else {
        ?>
            <option value="<?php echo 'index.php?uc=suivrePaiement&action=suivreFiche&Vid=' . $unVisiteur['Vid']  ?>">
        <?php 
        }
        echo $unVisiteur['Vnom'] . ' ' . $unVisiteur['Vprenom'] ;
        };
        ?>
                </option>
</select>
    <span>Mois : </span>
 <select id="lstMois" name="lstMois" class="browser-default custom-select" onChange="change_mois_function(this);">
     <option selected="selected" style="color:grey;">Choisir un mois</option>

     <?php
             var_dump($lesFiches);
                    foreach ($lesFiches as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                       if ($mois === $_GET['mois']){
                     ?>
                        <option selected="selected" value="<?php echo 'index.php?uc=suivrePaiement&action=suivreFiche&Vid=' . $_GET['Vid'] . '&mois=' . $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                      
                        
                            <?php
                            } else { ?>
                                 <option  value="<?php echo 'index.php?uc=suivrePaiement&action=suivreFiche&Vid=' . $_GET['Vid'] . '&mois=' . $mois ?>">
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
      function search_function(element){
     document.location.href = element.value;
      }
  </script>