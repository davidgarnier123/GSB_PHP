<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-lg-4 forfaitise">
    <h2>Valider la fiche de frais</h2>
    <h3>Eléments forfaitisés</h3>
<label>Forfait Etape</label><br>
<input value="<?php echo($laFiche[0]['quantite']); ?>"><br>
<label>Frais kilométrique</label><br>
<input value="<?php echo($laFiche[1]['quantite']); ?>"><br>
<label>Nuitée Hôtel</label><br>
<input value="<?php echo($laFiche[2]['quantite']); ?>"><br>
<label>Repas Restaurant</label><br>
<input value="<?php echo($laFiche[3]['quantite']); ?>"><br>
<button type="button" class="btn btn-success"> Corriger </button>
<button type="button" class="btn btn-danger"> Réinitialiser </button>

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
            <tr>
                <td class="col-lg-3 cellule"><input value="<?php echo($unHorsForfait['date']); ?>"></td>
                <td class="col-lg-3 cellule"><input value="<?php echo($unHorsForfait['libelle']); ?>"></td>
                <td class="col-lg-3 cellule"><input value="<?php echo($unHorsForfait['montant']); ?>"></td>
                <td class="col-lg-3 cellule">
            <button type="button" class="btn btn-success"> Corriger </button> 
            <button type="button" class="btn btn-danger"> Réinitialiser </button>
                <td>
        </tr>
       
            <?php } ?>
         </table>
        </div>
    <div class="col-lg-12 justificatif">
    <label>Nombre de justificatifs : </label>
    <input type="text" value="<?php echo($justificatifs); ?>"> <br><br>
    <button type="button" class="btn btn-success"> Corriger </button> 
    <button type="button" class="btn btn-danger"> Réinitialiser </button>
    </div>
    
        <?php } ?>
        
       
       
