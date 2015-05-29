<div id="divQuestion" class="divQuestion"></br>
    <div align="center" class="panel panel-primary">
        <div align="center" class="panel-heading">
            <h3 align="center" class="panel-title"><?php echo $data; ?></h3>
        </div>

    </div>



<?php


echo "</br>";
?>
    <div id="eee" align="center">
        <?php
foreach ($data->getReponses() as $reponse){
    echo "<input type='button' name='reponse' id='".$reponse->getId()."' class='reponse' value='".$reponse."'/></br>";
}
?>
    </div>

    <br/>

    <div id="messageReponse">

    </div>

    <?php
    echo "<br/> Question soumise par ".$data->getJoueur()->getPrenom();
    echo " <a href='#' class='signalerQuestion' id='signalerQuestion'>Signaler cette question</a><br/><br/>";
    ?>
</div>
</div>
<div id="messageSignalement">

</div>

