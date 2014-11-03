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
        $this->loadView("vHeader");

        $joueur = $_SESSION['joueur1']; // recupere le joueur
        $idJoueur= $_SESSION['joueur1']->getId(); // son id

        // Recupere les domaines du monde du joueur
        $domaine = DAO::getAll("Domaine", "idMonde ='" . $joueur->getMonde()->getId()."'");
        //echo 'Tous les domaines que le joueur peut avoir : ';
        //var_dump($domaine);

        // recupere toutes les couronnes du joueur
        $couronne = DAO::getAll("Couronne","idPartie='".$p[0]."' AND idJoueur= '".$idJoueur."'");
        //echo 'couronne que le joueur a : ';
        //var_dump($couronne);

        $toutesLesCouronnes =array();
        foreach ($couronne as $couronne){
            $toutesLesCouronnes[]=$couronne->getIdDomaine();
        }
        // Domaine que le joueur n'a pas
        $couronnesManq = array();
        foreach($domaine as $domaine){
            if (!in_array($domaine->getId(),$toutesLesCouronnes)){
                $couronnesManq[]=$domaine;
            }
        }
        //echo'domaine que le joueur na pas';
       // var_dump($couronnesManq);

         $this->loadView("vCouronne",$couronnesManq);
         echo JsUtils::postFormAndBindTo("#btChoixCouronne","click","/trivia/CCouronne/questionCouronne/","frmChoixCouronne","#divQstCouronne");

    }

    public function questionCouronne(){

        echo'salut';

    }

} 