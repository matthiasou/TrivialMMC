<form id="frmInscription" name="frmInscription">
    <fieldset>
        <legend>Inscription:</legend>
        <label for="nom">Nom : </label><input type="text" id="nom" name="nom"><br>
        <label for="prenom">Prénom : </label><input type="text" id="prenom" name="prenom"><br>
        <label for="mail">Mail : </label><input type="text" id="mail" name="mail"><br>
        <label for="login">Login : </label><input type="text" id="login" name="login"><br>
        <label for="password">Password : </label><input type="password" id="password" name="password"><br>
        <label for="idMonde">Monde : </label>
        <select id="idMonde" name="idMonde">
            <?php
            $mondes=DAO::getAll("Monde");
            foreach ($mondes as $monde){
                echo Gui::select($monde);
            }
            ?>
        </select><br>
        <hr>
        <input type="button" value="Valider" id="btValider3">
    </fieldset>

</form>