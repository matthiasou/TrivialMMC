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
        password :<?php echo $data["profil"]['password'];?> </br>
        Niveau : <?php echo $data["profil"]['niveau'];?> </br></br>

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
    <form id="frmModifMonde" name="frmAddMonde" class="addMonde">
        <fieldset>
            <legend>Modifier un monde</legend>
            <label for="nom">Nom : </label><input type="text" id="nom" name="nom"><br>
            <label for="idMonde">Monde : </label>
            <select id="idMonde" name="idMonde">
                <?php
                $mondes=DAO::getAll("Monde");
                foreach ($mondes as $monde){
                    echo Gui::select($monde);
                }
                ?>
            </select><br>
            <?php
            $mondes=DAO::getAll("Monde");
            foreach ($mondes as $monde){
                echo Gui::select($monde);
                echo " "?>$monde <?php " ";
            }
            ?>
            <hr>
            <input type="button" value="Valider" id="btValiderUpMonde" class="btValiderUpMonde">
        </fieldset>

    </form>
    <?php " ";
}
?>
<h1>Statistiques</h1>
<?php  foreach($data["stat"] as $data){
    echo $data->getDomaine()->getLibelle()." : ";
    echo round($data->getNbBonnesReponses() * 100 / $data->getNbReponses())."%</br>";
}
?>



</html>

