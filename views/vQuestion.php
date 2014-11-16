<div id="divQuestion" class="divQuestion"></br>
<?php
echo $data;
echo "</br></br>";

foreach ($data->getReponses() as $reponse){
    echo "<input type='button' name='reponse' id='".$reponse->getId()."' class='reponse' value='".$reponse."'/></br>";
}
?>
    <br/>

    <div id="messageReponse">

</div>
    <?php
    echo "<br/> Question soumise par ".$data->getJoueur()->getPrenom();
    echo " <a href='#' class='signalerQuestion' id='signalerQuestion'>Signaler cette question</a><br/><br/>";
    ?>
</div>