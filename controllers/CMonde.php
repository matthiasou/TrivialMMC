<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 13:08
 */

class CMonde extends \BaseController {

    public function index(){
        $this->loadView("vHeader");
        $this->viewAddNew();
        $this->load();
        echo "<div id='divMessage'></div>";
    }

    public function refresh()
    {
        $this->loadView("VAddMonde");
        echo JsUtils::postFormAndBindTo("#btValider", "click", "/trivia/CMonde/creerMonde/", "frmConnexion", "#divMessage");
        //echo JsUtils::getAndBindTo("#ajouterMonde", "click", "/trivia/CMonde/viewAjoutMonde/", "{}", "#divMessage");
        $this->load();
    }

    public function load(){
        var_dump(DAO::getAll("Monde"));
    }

    public function viewAddNew(){
        $this->loadView("VAddMonde");
        echo JsUtils::getAndBindTo("#btValider", "click", "/trivia/CMonde/creerMonde/", "frmAddMonde","#divMessage");
    }

    public function addNew(){
        $nouveau = new Monde();
        RequestUtils::setValuesToObject($nouveau);
        if(DAO::insert($nouveau)==1)
            echo "Insertion du monde ".$nouveau." effectuée.";
        echo JsUtils::get("/trivia/CMonde/refresh","{}","#divListe");
    }

    public function viewAjoutMonde (){
        echo JsUtils::doSomethingOn("#frmAddMonde","hide");
        //echo JsUtils::doSomethingOn("#inscription","hide");
        $this->loadView("VAddMonde");
        echo JsUtils::postFormAndBindTo("#btValider","click","/trivia/CMonde/creerMonde/","frmAddMonde","#divMessage");
    }

    public function creerMonde(){
        $monde=new Monde();
        RequestUtils::setValuesToObject($monde);
        //$test=DAO::getOne("libelle", $_POST["libelle"]);
        //$monde->setMonde($test);
        if(DAO::insert($monde)==1)
            echo "Insertion du monde ".$monde." ok";
    }

    public function listerMondes(){

    }
} 