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

} 