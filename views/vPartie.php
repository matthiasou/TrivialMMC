<br>
<div align="center" id="divListe">
    <?php
    echo " <a class='creerPartie' href='#'>Créer Partie</a><br/>";
    echo " <a class='inviterJoueur' href='#'>Inviter Joueur</a><br/><br/>"; ?>
    <div id="divInviterJoueur">
        <form id="frmInviterJoueur" name="frmInviterJoueur">
            <input id="loginJoueur" name="loginJoueur" type="text" placeholder="login du joueur" style="border:solid 1px black; border-radius:5px; text-align:center; box-shadow:0 0 6px;" />
            <input type="button" value="Valider" id="btValiderJoueur">
        </form>

    </div>

    <?php
    echo JsUtils::getAndBindTo(".inviterJoueur", "click", "/trivia/CPartie/viewInviterJoueur/", "{}", "#divMessage");
    echo JsUtils::getAndBindTo(".creerPartie", "click", "/trivia/CPartie/creerPartie", "{}","#divMessage");
    echo"<h2>Parties joignables :</h2>";
    foreach ($data["pJoignables"] as $partiesJoignables){
        echo $partiesJoignables." <a class='rejoindre' href='#' id='rejoindre".$partiesJoignables->getId()."'>Rejoindre</a><br/>";
        //echo JsUtils::getAndBindTo(".rejoindre", "click", "/trivia/CQuestion/randomQuestion", "{}","#divMessage");
    }

    echo "</br><h2>Parties en cours :</h2>";
    foreach ($data["pEnCours"] as $partiesEnCours){
        if($partiesEnCours->getJoueurEnCours()->getId() == $_SESSION['joueur1']->getId())
            echo $partiesEnCours->getJoueur1()->getPrenom() . " vs " . $partiesEnCours->getJoueur2()->getPrenom() . "<a class='jouer' href='#' id='jouer".$partiesEnCours->getId()."'> Jouer</a></br>";
        else
            echo $partiesEnCours->getJoueur1()->getPrenom() . " vs " . $partiesEnCours->getJoueur2()->getPrenom() . " (en attente de l'autre joueur)<br/>";
        //echo $partiesEnCours."</br>";
    }

    echo JsUtils::getAndBindTo(".jouer", "click", "/trivia/CQuestion/afficherRoulette", "{}","#divMessage");
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
<script type="text/javascript">


    function showErrorToast() {
        $().toastmessage('showErrorToast', " Le Login entré n'existe pas ! ");
    }

    function showErrorToast2() {
        $().toastmessage('showErrorToast', " Impossible de se défier soi même ! ");
    }






</script>