<div id="divQstCouronne">
<form id="frmChoixCouronne" name="frmChoixCouronne">
    <fieldset>
        <legend>Choisir une couronne :</legend>
        <label for="idDomaine">Quelle couronne souhaitez-vous ? </label>
        <select id="idDomaine" name="idDomaine">
            <?php

            foreach ($data as $couronne){
                echo Gui::select($couronne);
           }


            ?>
        </select><br>

        <input type="button" value="Valider" id="btChoixCouronne">


    </fieldset>
</form>
</div>
