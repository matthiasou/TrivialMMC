<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 27/10/14
 * Time: 16:45
 */

class CStatistiques extends \BaseController {
    public function index(){

    }

    public function load(){
        var_dump(DAO::getAll("Statistiques"));
    }

    public function affichCouronne(){

    }
} 