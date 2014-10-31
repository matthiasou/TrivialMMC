<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 16/10/14
 * Time: 10:05
 */

class CCouronne extends \BaseController {
    public function index(){


    }

    public function load(){
        var_dump(DAO::getAll("Couronne"));
    }

    public function couronne($p){

        $joueur = $_SESSION['joueur1'];
        $idJoueur= $_SESSION['joueur1']->getId();
        echo'monde du joueur';
        var_dump($joueur->getMonde());
        // Recupere les domaines du monde du joueur
        $domaine = DAO::getAll("Domaine", "idMonde ='" . $joueur->getMonde()->getId() . "'");

        echo'domaine du joueur';
        var_dump($domaine);
        // recuperer toutes les couronnes du joueur
        $couronne = DAO::getAll("Couronne","idPartie='".$p[0]."' AND idJoueur= '".$idJoueur."'");
        echo 'couronne du joueur';
        var_dump($couronne);

       //$test = DAO::getAll("Couronne","idDomaine !='". $couronne."'");
        //echo'couronne qu il n a pas';
      //  var_dump($test);








       // $this->loadView("vCouronne");

    }

} 