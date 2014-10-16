<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 02/10/14
 * Time: 11:30
 */

class CQuestion extends \BaseController {
    
    public function index(){
        $this->loadView("vHeader");

    }

    public function load(){
        $this->loadView("vHeader");
        var_dump(DAO::getAll("Question"));

    }

    public function randomQuestion($params){
        $idPartie = str_replace("jouer", "", $params[0]);
        echo JsUtils::doSomethingOn("#divListe","hide"); // cache le menu principal avec les parties
        $question=DAO::getOne("Question", "1=1 ORDER BY RAND() LIMIT 1");
        DAO::getOneToMany($question, "reponses");
        //echo $reponses;
        $this->loadView("vQuestion", $question);
        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CQuestion/checkAnswer/" . $idPartie, "{}", "#messageReponse");
    }

    public function checkAnswer($p){
        var_dump($p);
        $idJoueur = $_SESSION['joueur1']->getId();
        $estBonne=DAO::getOne("Reponse",$p[1])->getEstBonne();
        if($estBonne == 1){
            echo "Bonne réponse";
            $score = DAO::getOne("Score", "idPartie = " . $p[0] . " AND idJoueur = " . $idJoueur);
            $score->setNbBonnesReponses($score->getNbBonnesReponses()+1);
            DAO::update($score);

            }
        else
            echo "Mauvaise réponse";
    }
} 