<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 13:08
 */

class CMonde extends \BaseController {
    public function index(){

    }

    public function load(){
        var_dump(DAO::getAll("Monde"));
    }

} 