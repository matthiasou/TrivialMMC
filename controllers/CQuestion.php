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
        $this->randomQuestion();

    }

    public function load(){
        $this->loadView("vHeader");
        var_dump(DAO::getAll("Question"));

    }

    public function randomQuestion(){
        $question=DAO::getOne("Question", "1=1 ORDER BY RAND() LIMIT 1");
        DAO::getOneToMany($question, "reponses");
        //echo $reponses;
        $this->loadView("vQuestion", $question);
        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CQuestion/checkAnswer", "{}", "#messageReponse");
    }

    public function checkAnswer($p){
        $estBonne=DAO::getOne("Reponse",$p[0])->getEstBonne();
        if($estBonne == 1)
            echo "Bonne réponse";
        else
            echo "Mauvaise réponse";
    }
} 