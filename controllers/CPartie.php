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
    /**
     * @brief si le joueur2 est null alors met le joueur en cours en joueur2, initialise le score
     * @details Affiche la vue vInfoPartie et vQuestion
     */
    public function jouer($params){
        $joueur = $_SESSION['joueur1'];//Recupere joueur en session
        $idJoueur = $_SESSION['joueur1']->getId();
        $aChanger = array("jouer", "rejoindre");
        $idPartie = str_replace($aChanger, "", $params[0]); // récupere l'id de la partie
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
        $idDomaine =$question->getDomaine()->getId();
        DAO::getOneToMany($question, "reponses");

        // ********** affiche un encadré avec des infos sur la partie
            $partie = DAO::getOne("Partie","id=".$idPartie);
            $couronneJ1 = DAO::getAll("Couronne","idJoueur=".$idJoueur." AND idPartie=".$idPartie);
            $couronneJ2 = DAO::getAll("Couronne","idJoueur!=".$idJoueur." AND idPartie=".$idPartie);
            $scoreJ1 = DAO::getOne("Score","idJoueur=".$idJoueur." AND idPartie=".$idPartie);
            $scoreJ2 = DAO::getOne("Score","idJoueur!=".$idJoueur." AND idPartie=".$idPartie);
            $info =array("partie"=>$partie, "couronneJ1"=>$couronneJ1, "couronneJ2"=>$couronneJ2, "scoreJ1"=>$scoreJ1, "scoreJ2"=>$scoreJ2);

            $this->loadView("vInfoPartie",$info);
        // ********** FIN

        $this->loadView("vQuestion", $question);
        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CQuestion/checkAnswer/" . $idPartie ."/". $idDomaine, "{}", "#divQuestion");
        echo JsUtils::getAndBindTo("#signalerQuestion", "click", "/trivia/CQuestion/signalerQuestion/", "{}", "#messageSignalement");








    }

    /**
     * @brief Creation d'une partie
     */
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