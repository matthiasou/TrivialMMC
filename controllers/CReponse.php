<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 13:11
 */

class CReponse extends \BaseController {
    public function index(){

    }

    public function load(){
        var_dump(DAO::getAll("Reponse"));
    }

} 