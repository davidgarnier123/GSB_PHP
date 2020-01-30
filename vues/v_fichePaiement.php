<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($Infos[0] === "RB"){
    

?>
<h2 class="titre" style="text-decoration:underline; color:green">Le remboursement à été effectué </h2><br><br>
<span style="border:1px solid green;padding:10px;font-size:18px;">Remboursement : <?php echo($Infos[3]); ?>€ </span><br><br>
<?php
} else {
 ?>
<h2 class="titre" style="text-decoration:underline">La fiche est en cours de paiement</h2>
<?php
}
?>
<div class="row">
    <div class="col-lg-4 forfaitise">
    <h3>Eléments forfaitisés</h3>
<label>Forfait Etape</label><br>
<input name="ETP" value="<?php echo($laFiche[0]['quantite']); ?>" disabled><br>
<label>Frais kilométrique</label><br>
<input name="KM" value="<?php echo($laFiche[1]['quantite']); ?>" disabled><br>
<label>Nuitée Hôtel</label><br>
<input name="NUI" value="<?php echo($laFiche[2]['quantite']); ?>" disabled><br>
<label>Repas Restaurant</label><br>
<input name="REP" value="<?php echo($laFiche[3]['quantite']); ?>" disabled><br>
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

            </tr>
            <tr>
                <td class="col-lg-3 cellule">Date</td>
                <td class="col-lg-3 cellule">Libellé</td>
                <td class="col-lg-3 cellule">Montant</td>

            </tr>
             <?php 
            foreach ($horsForfait as $unHorsForfait) {
        ?>
            <tr>
                <td class="col-lg-3 cellule"><input name="date" value="<?php echo($unHorsForfait['date']); ?>" disabled></td>
                <td class="col-lg-3 cellule"><input name="libelle" value="<?php echo($unHorsForfait['libelle']); ?>" disabled></td>
                <td class="col-lg-3 cellule"><input name="montant" value="<?php echo($unHorsForfait['montant']); ?>" disabled></td>
        </tr>

       
            <?php } ?>
         </table>
        </div>
    <div class="col-lg-12 justificatif">
    <label>Nombre de justificatifs : </label>
    
    <input name="justificatif" type="text" value="<?php echo($justificatifs); ?>" disabled> <br><br>
    </div>
    
        <?php } ?>