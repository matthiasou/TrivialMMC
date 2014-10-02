<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 13:11
 */

class CProbleme extends \BaseController {
    public function index(){

    }

    public function load(){
        var_dump(DAO::getAll("Probleme"));
    }

} 