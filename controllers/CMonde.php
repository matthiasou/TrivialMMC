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
        $this->loadView("VAddMonde");
        echo JsUtils::postFormAndBindTo("#btMonde", "click", "/trivia/CMonde/ajoutMonde/", "frmAddMonde","#divMessage");
        //$this->ajouterMonde();
        //$this->viewAjoutMonde();
        //$this->creerMonde();
    }


    public function viewAjoutMonde(){
        echo JsUtils::doSomethingOn("#libelle", "hide");
    }

    public function ajoutMonde() {
        $monde=new Monde();
        RequestUtils::setValuesToObject($monde);
        if(DAO::insert($monde)==1)
            echo "Nouveau monde " . $monde->getLibelle() . " ajouté avec succès";
        else
            echo "Erreur. Impossible d'ajouter ce nouveau monde";
    }


    public function addMonde()
    {
        $monde = new Monde();
        RequestUtils::setValuesToObject($monde);
        if (DAO::insert($monde) == 1)
            echo "Insertion de " . $monde . " ok";
    }

    public function updateMonde($param)
    {
        $id=str_replace("btn","",$param[0]);
        var_dump($id);
        var_dump($_POST);
        $result = $_POST["nom" . $id];
        var_dump($result);
        $monde = DAO::getOne("monde", "id = $id ");
        $monde->setLibelle($result);
        if(DAO::update($monde)==1)
            echo "GG";
        else
            echo "you suck";


        //$js="$('#".$id[0]."').val()";
        //echo JsUtils::get("/trivia/CMonde/test", $js);
        //$monde = $_POST['nom'];
        //echo $monde;
        //$monde = DAO::getOne("Monde", 'idMonde ='" . $ . ");
    }

    public function test($param){
        var_dump($param);
    }

} 