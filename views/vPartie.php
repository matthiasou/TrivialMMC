<div id="divListe">
    <?php
    echo " <a class='creerPartie' href='#'>Créer Partie</a><br/><br/>";
    echo JsUtils::getAndBindTo(".creerPartie", "click", "/trivia/CPartie/creerPartie", "{}","#divMessage");
    echo"<h2>Parties joignables :</h2>";
    foreach ($data["pJoignables"] as $partiesJoignables){
        echo $partiesJoignables." <a class='rejoindre' href='#' id='rejoindre".$partiesJoignables->getId()."'>Rejoindre</a><br/>";
        echo JsUtils::getAndBindTo(".rejoindre", "click", "/trivia/CQuestion/randomQuestion", "{}","#divMessage");
    }

    echo "</br><h2>Parties en cours :</h2>";
    foreach ($data["pEnCours"] as $partiesEnCours){
        if($partiesEnCours->getJoueurEnCours()->getId() == $_SESSION['joueur1']->getId())
            echo $partiesEnCours->getJoueur1()->getPrenom() . " vs " . $partiesEnCours->getJoueur2()->getPrenom() . "<a class='jouer' href='#' id='jouer".$partiesEnCours->getId()."'> Jouer</a></br>";
        else
            echo $partiesEnCours->getJoueur1()->getPrenom() . " vs " . $partiesEnCours->getJoueur2()->getPrenom() . " (en attente de l'autre joueur)<br/>";
        //echo $partiesEnCours."</br>";
    }

    echo JsUtils::getAndBindTo(".jouer", "click", "/trivia/CQuestion/randomQuestion", "{}","#divMessage");
    echo'<br>';
    echo"<h2>Parties en attente d un joueur :</h2>";
    foreach ($data["pEnAttentes"] as $partiesEnAttentes){
        echo $partiesEnAttentes->getJoueur1()->getPrenom() . " vs  ...<br/>";
        // echo JsUtils::getAndBindTo(".rejoindre", "click", "/trivia/CQuestion/randomQuestion", "{}","#divMessage");
    }

    echo'<br>';
    echo"<h2>Parties Finies :</h2>";
    foreach ($data["pFini"] as $partiesEnCours){

        echo $partiesEnCours->getJoueur1()->getPrenom() . " vs " . $partiesEnCours->getJoueur2()->getPrenom() . "<br/>";

    }

    ?>
</div>