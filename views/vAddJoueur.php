<form id="frmAdd" name="frmAdd">
<fieldset>
	<legend>Ajout joueur :</legend>
	<label for="nom">Nom : </label><input type="text" id="nom" name="nom"><br>
	<label for="prenom">Prénom : </label><input type="text" id="prenom" name="prenom"><br>
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
<input type="button" value="Valider" id="btValider">
</fieldset>

</form>