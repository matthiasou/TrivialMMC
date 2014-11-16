<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 13:08
 */

class CPartie extends \BaseController {
    public function index(){

    }

    public function load(){
        var_dump(DAO::getAll("Partie"));
    }

    public function jouer($idPartie){
        $joueur = $_SESSION['joueur1'];//Recupere joueur en session
        $idJoueur = $_SESSION['joueur1']->getId();
        $aChanger = array("jouer", "rejoindre");
        $idPartie = str_replace($aChanger, "", $idPartie[0]); // récupere l'id de la partie
        $partie = DAO::getOne("Partie", "id ='" . $idPartie . "'"); // recupére la partie grâce à l'id
        if ($partie->getJoueur2() == NULL){
            $partie->setJoueur2($joueur);
            $partie->setJoueurEnCours($joueur);
            $partie->setDernierCoup(date("Y-m-d H:i:s"));
            DAO::update($partie);

            $score = new score();
            $score->setIdPartie($idPartie);
            $score->setIdJoueur($idJoueur);
            $score->setNbBonnesReponses("0");
            $score->setNbManches("0");
            $score->setRepSuccessives("0");
            DAO::insert($score);
        }

        echo JsUtils::doSomethingOn("#divListe","hide"); // cache le menu principal avec les parties
        $question=DAO::getOne("Question", "1=1 ORDER BY RAND() LIMIT 1");
        DAO::getOneToMany($question, "reponses");
        $this->loadView("vQuestion", $question);
        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CQuestion/checkAnswer/" . $idPartie, "{}", "#divQuestion");
        echo JsUtils::getAndBindTo("#signalerQuestion", "click", "/trivia/CQuestion/signalerQuestion/", "{}", "#divQuestion");








    }

    public function changementJoueurEnCours($p){
       $partie = DAO::getOne("Partie","idPartie = '" . $p[0]);
        var_dump($partie);

    }

    public function creerPartie(){
        $joueur = $_SESSION['joueur1'];
        $idJoueur = $_SESSION['joueur1']->getId();
        $partie = new partie();
        $partie->setJoueur1($joueur);
        $partie->setJoueurEnCours(NULL);
        $partie->setDernierCoup(date("Y-m-d H:i:s"));
        DAO::insert($partie);

        $idPartie =$partie->getId();
        $score = new score();
        $score->setIdPartie($idPartie);
        $score->setIdJoueur($idJoueur);
        $score->setNbBonnesReponses("0");
        $score->setNbManches("1");
        $score->setRepSuccessives("0");
        DAO::insert($score);
        echo JsUtils::execute('alert("Partie crée, en attente d un joueur")');
        echo JsUtils::execute('window.location = " /trivia/CJoueur"');

    }

} 