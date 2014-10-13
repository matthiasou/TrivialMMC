<div id="divListe">
    <?php
    foreach ($data as $monde){
        echo $mondes."</br>";
        echo JsUtils::getAndBindTo(".btValider", "click", "/trivia/CMonde/creerMonde", "{}", "#messageReponse");
    }
    ?>
</div>