<?php
class cTest extends \BaseController {
	public function index() {
        echo JsUtils::doSomethingOn("#divListe","hide"); // cache le menu principal avec les parties
        $joueur = $_SESSION['joueur1'];

        $this->loadView("vHeader");


        $this->selectDomaine($joueur);
        $domains = $this->selectDomaines($joueur);
        $this->loadView("vRoulette",$domains);



	}


    /**
     * Récupère tous les domaines qui font partie du monde du joueur
     * @param unknown $joueur
     * @return $domaine
     */
    public function selectDomaines($joueur){
        $domaine = DAO::getAll("Domaine","idMonde =".$joueur->getMonde()->getId());

        return $domaine;
    }

    /**
     * Retourne un domaine aléatoire
     * @param unknown $joueur
     * @return $domaine
     */
    public function selectDomaine($joueur){
        $domaine = DAO::getOne("Domaine","idMonde =".$joueur->getMonde()->getId()." ORDER BY rand() limit 1");
        //$domaine = DAO::getOne("Domaine","idMonde =".$joueur->getMonde()->getId()." AND libelle like 'Couronne'");
        $_SESSION['domaine'] = $domaine;

        return $domaine;
    }

}