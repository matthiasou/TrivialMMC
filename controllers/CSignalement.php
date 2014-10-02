<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 13:12
 */

class CSignalement extends \BaseController {
    public function index(){

    }

    public function load(){
        var_dump(DAO::getAll("Signalement"));
    }

} 