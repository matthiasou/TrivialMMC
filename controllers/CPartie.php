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
        $aChanger = array("jouer", "rejoindre");
        $idPartie = str_replace($aChanger, "", $idPartie[0]); // récupere l'id de la partie
        echo'id de la partie :';
       var_dump($idPartie);
        $partie = DAO::getOne("Partie", "id ='" . $idPartie[0] . "'"); // recupere la partie grâce à l'id
        echo'Joueur2:';
        var_dump($partie->getJoueur2());
        if ($partie->getJoueur2() == NULL){
            $partie->setJoueur2($joueur);
            $partie->setJoueurEnCours($joueur);
            $partie->setDernierCoup(date("Y-m-d H:i:s"));
            DAO::update($partie);
        }
        echo'joueurEnCours';
        var_dump($partie->getJoueurEnCours());
        echo'Nouvelle question:';
        $question = new CQuestion();
        $question->randomQuestion($idPartie);



    }

    public function changementJoueurEnCours($p){
       $partie = DAO::getOne("Partie","idPartie = '" . $p[0]);
        var_dump($partie);




    }

} 