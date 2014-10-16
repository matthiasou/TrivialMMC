<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 13:07
 */

class CDomaine extends \BaseController {

    public function index(){
        $this->loadView("vHeader");
        $this->loadView("VAddDomaine");
        echo JsUtils::postFormAndBindTo("#btAjDo", "click", "/trivia/CDomaine/ajoutDomaine/", "frmAddDomaine","#divMessage");
    }


    public function viewAjoutMonde(){
        echo JsUtils::doSomethingOn("#libelle", "hide");
    }

    public function ajoutDomaine() {
        $domaine=new Domaine();
        RequestUtils::setValuesToObject($domaine);
        $monde=DAO::getOne("Monde", $_POST["idMonde"]);
        $domaine->setMonde($monde);
        if(DAO::insert($domaine)==1)
            echo "Nouveau domaine " . $domaine->getLibelle() . " ajouté avec succès";
        else
            echo "Erreur. Impossible d'ajouter ce nouveau domaine.";
    }

    public function load(){
        var_dump(DAO::getAll("Domaine"));
    }

} 