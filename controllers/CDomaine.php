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
    /**
     * @brief Ajouter un domaine
     */
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

    public function updateDomaine($param)
    {
        $id=str_replace("btnDomaine","",$param[0]);
        $result = $_POST["nom" . $id];
        $domaine = DAO::getOne("Domaine", "id = $id ");
        $domaine->setLibelle($result);
        if(DAO::update($domaine)==1)
            echo "GG";
        else
            echo "you suck";


    }

    public function load(){
        var_dump(DAO::getAll("Domaine"));
    }

} 