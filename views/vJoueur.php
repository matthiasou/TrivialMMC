<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 04/11/2014
 * Time: 14:29
 */
?>
<html>
<h1>Profil de <?php echo $data["profil"]['prenom'];?></h1>
Nom : <?php echo $data["profil"]['nom'];?> </br>
Prenom : <?php echo $data["profil"]['prenom'];?> </br>
Mail : <?php echo $data["profil"]['mail'];?> </br>
password :<?php echo $data["profil"]['password'];?> </br>
Niveau : <?php echo $data["profil"]['niveau'];?> </br></br>
<h1>Statistiques</h1>
<?php  foreach($data["stat"] as $data){
    echo $data->getDomaine()->getLibelle()." : ";
    echo $data->getNbBonnesReponses() * 100 / $data->getNbReponses()."%</br>";
} ?>




</html>

