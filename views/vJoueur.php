<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 04/11/2014
 * Time: 14:29
 */
?>
<html>
<fieldset>
    <legend><h1>Profil de <?php echo $data["profil"]['prenom'];?></h1></legend>

    Nom : <?php echo $data["profil"]['nom'];?> </br>
    Prenom : <?php echo $data["profil"]['prenom'];?> </br>
    Mail : <?php echo $data["profil"]['mail'];?> </br>
    Niveau : <?php echo $data["profil"]['niveau'];?> </br></br>
    <input type="button"value="Modifier password"  id="btModifierMdp" class="btModifierMdp">
<br><br>
    <div class="newPassword" id="newPassword">
        <form id="frmChangePassword" name="frmChangePassword" class="changePassword">
                <input type="password" name="ancienPassword" id="ancienPassword" placeholder="ancien Password">

                <input type="password" name="newPassword" id="newPassword" placeholder="nouveau Password">

                <input type="password" name="newPassword2" id="newPassword2" placeholder="nouveau Password">

            <input type="button"value="Valider"  id="btValider">


        </form>
        <div id="divModif" ></div>
    </div>
</fieldset>
<?php
if($data["profil"]['niveau']==100){
    echo " " ?>
    <br><hr>
    <!-- Ajouter un monde -->
    <form id="frmModifMonde" name="frmAddMonde" class="addMonde">
        <h1>Espace admin</h1>
        <fieldset>
            <legend>Ajouter un monde</legend>
            <label for="libelle">Nom : </label><input type="text" id="libelle" name="libelle"><br>
            <br>
            <input type="button" value="Valider" id="btValiderAddMonde" class="btValiderAddMonde">
        </fieldset>
    </form>

    <!-- Modifier un monde -->
    <form id="frmUpMonde" name="frmUpMonde" class="upMonde">
        <fieldset>
            <legend>Modifier un monde</legend>
            <br>
            <?php
            $mondes=DAO::getAll("Monde");
            foreach ($mondes as $monde){
                echo "<input type='text' id='" . $monde->getId() . "' name='nom" . $monde->getId() . "' value='" . $monde . "'><input type='button' value='Valider' id='btn" . $monde->getId() . "' class='btValiderUpMonde'></br>";

            }
            ?>

        </fieldset>

    </form>
    <!-- Fin -->



    <!-- Ajouter un domaine -->

    <form id="frmAddDomaine" name="frmAddDomaine">
        <fieldset>

            <legend>Ajouter domaine :</legend>

            <table border="0">

                <tr><td>Choisir un monde en lien :</td>
                    <td><select id="idMonde" name="idMonde">
                            <?php
                            $mondes=DAO::getAll("Monde");
                            foreach ($mondes as $idMonde){
                                echo Gui::select($idMonde);
                            }
                            ?>
                        </select></td></tr>
                <!--<label for="idMonde">Entrer id monde</label><input type="text" id="idMonde" name="idMonde"><br>-->
                <tr><td>Nom du domaine :</td><td> <input type="text" id="libelle" name="libelle"></td></tr>
                <tr><td>Description du domaine : </td><td><input type="text" id="description" name="description"><br></td></tr>
                <tr><td colspan="2" align="center"><input type="button" value="Valider" id="btAjDo"></td></tr>
            </table>

            <div id="divMessage"></div>
        </fieldset>
    </form>

    <!--Fin -->

    <!-- Modifier un domaine -->
    <form id="frmModifDomaine" name="frmModifDomaine" class="upDomaine">
        <fieldset>
            <legend>Modifier un Domaine</legend>
            <br>
            <?php
            $domaines=DAO::getAll("Domaine");
            foreach ($domaines as $domaine){
                echo "<input type='text' id='" . $domaine->getId() . "' name='nom" . $domaine->getId() . "' value='" . $domaine . "'><input type='button' value='Valider' id='btnDomaine" . $domaine->getId() . "' class='btValiderUpDomaine'></br>";

            }
            ?>

        </fieldset>

    </form>
    <!-- Fin -->

    <?php " ";
}
?>
<h1>Statistiques</h1>
<?php
    $nbBonnesRep=0;
    $nbReponses = 0;
    foreach($data["stat"] as $data){
        echo $data->getDomaine()->getLibelle()." : ";
        echo round($data->getNbBonnesReponses() * 100 / $data->getNbReponses())."%</br>";
        $nbBonnesRep= $nbBonnesRep + $data->getNbBonnesReponses();
        $nbReponses = $nbReponses + $data->getNbReponses();
}
echo"Nombre de questions répondues: ".$nbReponses;
echo '<br>';
echo " Bonnes réponses: ".$nbBonnesRep;
echo '<br>';
if ($nbBonnesRep != 0){
    echo "Pourcentage de bonnes réponses: ".round($nbBonnesRep * 100 / $nbReponses)."%</br>";;
}


?>
<script>
function showErrorToast3() {
$().toastmessage('showErrorToast', " Impossible de mettre ce mot de passe! ");
}

function showErrorToast4() {
$().toastmessage('showErrorToast', " Ce n est pas votre mot de passe ");
}

function showSuccessToast5() {
$().toastmessage('showSuccessToast', "Changement de mot de passe réussi.");
}

</script>