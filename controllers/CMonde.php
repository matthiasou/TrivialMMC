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

} 