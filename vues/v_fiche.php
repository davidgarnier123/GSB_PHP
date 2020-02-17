<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-lg-4 forfaitise">
    <h2 class="titre">Valider la fiche de frais</h2>
    <h3>Eléments forfaitisés</h3>
    <form name="form" action="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $_GET['mois'] . '&maj=fraisForfait'?>" method="post">
<label>Forfait Etape</label><br>
<input name="ETP" value="<?php echo($laFiche[0]['quantite']); ?>"><br>
<label>Frais kilométrique</label><br>
<input name="KM" value="<?php echo($laFiche[1]['quantite']); ?>"><br>
<label>Nuitée Hôtel</label><br>
<input name="NUI" value="<?php echo($laFiche[2]['quantite']); ?>"><br>
<label>Repas Restaurant</label><br>
<input name="REP" value="<?php echo($laFiche[3]['quantite']); ?>"><br>
<button type="submit" name="submit" value="Submit" class="btn btn-success"> Corriger </button>
<button type="submit" name="discard" value="discard" class="btn btn-danger"> Réinitialiser </button>
    </form>
    </div>
    
    <?php 
   
        if($horsForfait != null){
    ?>
    <div class="col-lg-12" id="tableau">
        <table class="col-lg-12">
            <tr class="entete">
                <td class="col-lg-3 cellule">Descriptif des éléments hors forfait</td>
                <td class="col-lg-3 cellule"></td>
                <td class="col-lg-3 cellule"></td>
                <td class="col-lg-3 cellule"></td>

            </tr>
            <tr>
                <td class="col-lg-3 cellule">Date</td>
                <td class="col-lg-3 cellule">Libellé</td>
                <td class="col-lg-3 cellule">Montant</td>
                <td class="col-lg-3 cellule"></td>

            </tr>
             <?php 
            foreach ($horsForfait as $unHorsForfait) {
        ?>
            <form name="form" action="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $_GET['mois'] . '&maj=fraisHorsForfait&fraisId=' . $unHorsForfait['id'] ?>" method="post">
            <tr>
                <td class="col-lg-3 cellule"><input name="date" value="<?php echo($unHorsForfait['date']); ?>"></td>
                <td class="col-lg-3 cellule"><input name="libelle" value="<?php echo($unHorsForfait['libelle']); ?>"></td>
                <td class="col-lg-3 cellule"><input name="montant" value="<?php echo($unHorsForfait['montant']); ?>"></td>
                <td class="col-lg-3 cellule">
            <button type="submit" class="btn btn-success"> Corriger </button> 
            <button type="submit" name="discard" value="discard" class="btn btn-danger"> Réinitialiser </button>
                <td>
        </tr>
        </form>
       
            <?php } ?>
         </table>
        </div>
    <div class="col-lg-12 justificatif">
    <label>Nombre de justificatifs : </label>
    
    <input name="justificatif" type="text" value="<?php echo($justificatifs); ?>" disabled> <br><br>
    </div>
    
        <?php } ?>
    
    <div class="col-lg-12 validation">
<form name="form" action="<?php echo 'index.php?uc=validerFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $_GET['mois'] . '&maj=validationFiche'?>" method="post">
    <button type="submit" class="btn btn-success"> Valider la fiche de frais</button>
    </form>
    </div>
       
       
