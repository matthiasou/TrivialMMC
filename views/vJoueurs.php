<div id="divListe">
<?php
foreach ($data as $joueur){
	echo $joueur." <a class='delete' href='#' id='delete".$joueur->getId()."'>Supprimer</a><br>";
}
?>
<a id="addNew" href="#">Ajouter un joueur</a>
<div id="divFrm"></div>
</div>