<div id="divListe">
    <?php
    echo"Parties joignables :</br></br>";
    foreach ($data["pJoignables"] as $partiesJoignables){
        echo $partiesJoignables." <a class='rejoindre' href='#' id='rejoindre".$partiesJoignables->getId()."'>Rejoindre</a><br/>";
        echo JsUtils::getAndBindTo(".rejoindre", "click", "/trivia/CQuestion/randomQuestion", "{}","#divMessage");
    }

    echo "</br>Parties en cours :</br></br>";
    foreach ($data["pEnCours"] as $partiesEnCours){
        if($partiesEnCours == $_SESSION['joueur1']->getNom())
            echo $partiesEnCours . "<a class='jouer' href='#' id='jouer".$partiesEnCours->getId()."'> Jouer</a></br>";
    else
            echo $partiesEnCours . "<br/>";
        //echo $partiesEnCours."</br>";
    }

    echo JsUtils::getAndBindTo(".jouer", "click", "/trivia/CQuestion/randomQuestion", "{}","#divMessage");

    ?>
</div>

