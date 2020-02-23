<?php

/* 
 * Vue pour la selection de la fiche de frais avec la recherche par nom
 */

?>
<div class="row">  
    <span>Entrer un nom : </span>
    <form name="form" method="post" action="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&search'?>">
        <input name="name" id="chercherNom" 
               value="<?php
                     // si search et le nom du visiteur sont passés en parametre : j'affiche la liste filtrée par nom
                     if (isset($_GET['search']) && isset($leNom)){
                        echo $leNom;
                     }
        ?>"> 
        <button type="submit" method="post">Chercher</button>
    </form>
    <br>
    <?php
        // si search et le nom du visiteur sont passés en parametre : j'affiche le nombre d'utilisateurs trouvés et un bouton pour retirer le filtre
        if (isset($_GET['search']) && isset($leNom)){
                $nbr = count($lesVisiteursFilter);
               echo '<h4 style="color:green"> La liste a été filtrée : ' . $nbr. ' visiteurs correspondent à votre recherche.</h4>';
               echo '<button style="background-color:red; color:white" id="myBtn"> Supprimer le filtre </button><br><br>';
        }
    ?>
    <br>
    <span>Choisir le visiteur : </span>
    <select id="lstVisiteur" name="lstVisiteur" onChange="change_function(this);" class="browser-default custom-select">
         <option selected="selected" style="color:grey;">Choisir un visiteur</option>

        <?php
        // Si search n'est pas en parametre : j'affiche la liste complète des visiteurs
        if (!isset($_GET['search'])){
            $visiteurs = $lesVisiteurs;
        } else {
            $visiteurs = $lesVisiteursFilter;
        }
            foreach ($visiteurs as $unVisiteur) {
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
        <option selected="selected" style="color:grey;">Choisir un mois</option>
     <?php
                    foreach ($lesFiches as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                       if ($mois === $_GET['mois']){
                     ?>
                        <option selected="selected" value="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> 
                        </option>
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
    // function javascript : permet d'attribuer un href pour la redirection
    function change_function(element){
     document.location.href = element.value;
      }
    // function javascript : permet d'attribuer un href pour la redirection  
      function change_mois_function(element){
     document.location.href = element.value;
      }
    // function javascript : permet d'attribuer un href pour la redirection
      function search_function(element){
     document.location.href = element.value;
      }
    // function javascript : permet d'attribuer un href pour la redirection
       var btn = document.getElementById('myBtn');
    btn.addEventListener('click', function() {
      document.location.href = '<?php echo "index.php?uc=validerFrais&action=choisirFrais"; ?>';
    });
</script>