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

    public function jouer(){
        // Afficher une question
        // Si bonne autre question sinon à l'autre joueur de jouer



    }

} 