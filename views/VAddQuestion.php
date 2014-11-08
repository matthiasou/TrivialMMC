<form id="frmAddQuestion" name="frmAddQuestion">
    <fieldset>
        <legend>Ajout question :</legend>
        <label for="idQuestion">Choisir un domaine pour la question : </label>
        <select id="idQuestion" name="idQuestion">
            <?php
            $domaines=DAO::getAll("Domaine");
            foreach ($domaines as $idDomaine){
                echo Gui::select($idDomaine);
            }
            ?>
        </select><br>

        <label for="libelle">Intitulé de la question : </label><input type="text" id="libelle" name="libelle"><br>
        <label for="reponse">Réponse 1 : </label><input type="text" id="reponse" name="reponse"><br>
        <label for="reponse">Réponse 2 : </label><input type="text" id="reponse" name="reponse"><br>
        <label for="reponse">Réponse 3 : </label><input type="text" id="reponse" name="reponse"><br>
        <label for="reponse">Réponse 4 : </label><input type="text" id="reponse" name="reponse"><br>
        <input type="button" value="Valider" id="btAjQu">

        <div id="divMessage"></div>
    </fieldset>
</form>