<div id="divQstCouronne">
<form id="frmChoixCouronne" name="frmChoixCouronne" class="login">
    <fieldset>
        <legend>Choisir une couronne :</legend>
        Quelle couronne souhaitez-vous ?
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
