<<div id="divListe">
    <?php
    echo $data;
    echo "</br></br>";

    foreach ($data as $reponse){
        echo "<input type='button' name='reponse' id='".$reponse->getId()."' class='reponse' value='".$reponse."'/></br>";
    }
    ?>
    <br/>

    <div id="messageReponse">

    </div>
    <?php


    ?>
</div>