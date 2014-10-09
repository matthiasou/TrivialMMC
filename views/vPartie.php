<div id="divListe">
    <?php
    echo"Parties joignables :</br></br>";
    foreach ($data["pJoignables"] as $partiesJoignables){
        echo $partiesJoignables." <a class='rejoindre' href='#' id='rejoindre".$partiesJoignables->getId()."'>Rejoindre</a><br>";
    }

    echo "</br>Parties en cours :</br></br>";
    foreach ($data["pEnCours"] as $partiesEnCours){
        echo $partiesEnCours."</br>";
    }
    ?>
</div>


