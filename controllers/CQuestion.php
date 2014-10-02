<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 02/10/14
 * Time: 11:30
 */

class CQuestion extends \BaseController {
    public function index(){

    }

    public function load(){
        var_dump(DAO::getAll("Question"));
    }

} 