<form id="frmAddDomaine" name="frmAddDomaine">
    <fieldset>
        <legend>Ajout domaine :</legend>
        <label for="idMonde">Choisir un monde en lien : </label>
        <select id="idMonde" name="idMonde">
            <?php
            $mondes=DAO::getAll("Monde");
            foreach ($mondes as $idMonde){
                echo Gui::select($idMonde);
            }
            ?>
        </select><br>
        <!--<label for="idMonde">Entrer id monde</label><input type="text" id="idMonde" name="idMonde"><br>-->
        <label for="libelle">Nom du domaine : </label><input type="text" id="libelle" name="libelle"><br>
        <label for="description">Description du domaine : </label><input type="text" id="description" name="description"><br>
        <input type="button" value="Valider" id="btAjDo">

        <div id="divMessage"></div>
    </fieldset>
</form>