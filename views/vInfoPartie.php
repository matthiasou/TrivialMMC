
    <form id="frmScore" name="frmScore" class="score">
        <fieldset>
             <legend>Scores :</legend>
             <?php //var_dump($data)?>
             Manche N°<?php echo $data["scoreJ1"]->getNbManches();?> </br><br>
             Bonnes réponses :</br>
             Vous : <?php echo $data["scoreJ1"]->getNbBonnesReponses(). " Votre adversaire : " .$data["scoreJ2"]->getNbBonnesReponses();?> </br></br>
             Couronnes débloquées :</br>
             Vous : <?php echo sizeof($data["couronneJ1"]). " Votre adversaire : " .sizeof($data["couronneJ2"]);?></br></br>
             Réponses successives :  <?php echo $data["scoreJ1"]->getRepSuccessives();?>

        </fieldset>
    </form>
