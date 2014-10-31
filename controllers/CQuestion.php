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
        var_dump($params[0]);
        $aChanger = array("jouer", "rejoindre");
        $idPartie = str_replace($aChanger, "", $params[0]); // récupere l'id de la partie
        var_dump($idPartie);
        echo JsUtils::doSomethingOn("#divListe","hide"); // cache le menu principal avec les parties
        $question=DAO::getOne("Question", "1=1 ORDER BY RAND() LIMIT 1");
        DAO::getOneToMany($question, "reponses");
        //echo $reponses;
        $this->loadView("vQuestion", $question);
        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CQuestion/checkAnswer/" . $idPartie, "{}", "#messageReponse");
    }

    public function checkAnswer($p){
        //var_dump($p);// id de la partie
        $idJoueur = $_SESSION['joueur1']->getId();
        $estBonne=DAO::getOne("Reponse",$p[1])->getEstBonne();
        if($estBonne == 1){
            $score = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");
           // var_dump($score);
            $score->incRepSuccessives();
            DAO::update($score);

            echo JsUtils::execute('alert("Bonne réponse")');
            // nouvelle question


            if ($score->getRepSuccessives()==3){
                echo JsUtils::execute('alert("Tu vas pouvoir jouer une couronne GG ! ")');
                echo JsUtils::execute('window.location = " /trivia/CCouronne/couronne/'.$p[0].'"');

            }
            else {
                $question = new  CQuestion();
                $question->randomQuestion($p);
            }




            }
        else {

            $partie = DAO::getOne("Partie", "id ='" . $p[0] . "'");
            //var_dump($partie);
            if ($partie->getJoueur1()->getId() == $idJoueur) {
                $partie->setJoueurEnCours($partie->getJoueur2());

            } else {
                $partie->setJoueurEnCours($partie->getJoueur1());

            }
            $partie->setDernierCoup(date("Y-m-d H:i:s"));
            DAO::update($partie);
            $score = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");


            $score->setRepSuccessives("0");
            DAO::update($score);


            // Mauvaise reponse -> retour au menu, changement JoueurEnCours
            echo JsUtils::execute('alert("Mauvaise réponse, à l autre joueur de jouer ! ")');
            echo JsUtils::execute('window.location = " /trivia/CJoueur"');
            //->changementJoueurEnCours();
        }

    }

} 