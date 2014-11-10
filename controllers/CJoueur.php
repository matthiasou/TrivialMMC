<?php

class CJoueur extends \BaseController{


	public function index(){
		$this->loadView("vHeader");
		$this->refresh();
		echo "<div id='divMessage'></div>";
	}

	public function refresh(){
		//$joueurs=DAO::getAll("Joueur");
		//$this->loadView("vJoueurs",$joueurs);
		//echo JsUtils::getAndBindTo("#addNew", "click", "/trivia/CJoueur/viewAddNew/","{}","#divFrm");
		//echo JsUtils::getAndBindTo(".delete", "click", "/trivia/CJoueur/delete","{}","#divMessage");
        $this->affichHead();
        if (!isset($_SESSION['joueur1']))
        {
            $this->loadView("VConnexion");
        }

        echo JsUtils::postFormAndBindTo("#btValider", "click", "/trivia/CJoueur/connexion/", "frmConnexion","#divMessage");
        echo JsUtils::getAndBindTo("#inscription", "click", "/trivia/CJoueur/viewInscription/", "{}","#divMessage");
        echo JsUtils::getAndBindTo("#deconnexion", "click", "/trivia/CJoueur/deconnexion/", "{}","#divMessage");


        $this->listerParties();



	}
	public function delete($params){
		$param=str_replace("delete", "", $params[0]);
		$joueur=DAO::getOne("Joueur", $param);
		echo "<div id='divMessageContent'>";
		if($joueur instanceof Joueur){
			if(DAO::delete($joueur)==1){
				echo $joueur." supprimé";
				echo JsUtils::get("/trivia/CJoueur/refresh","{}","#divListe");
				echo JsUtils::doSomethingOn("#divMessageContent", "hide",5000);
			}
		}else {
			echo "Joueur inexistant";
		}
		echo "</div>";
	}


	public function viewAddNew(){
		$this->loadView("vAddJoueur");
		echo JsUtils::postFormAndBindTo("#btValider", "click", "/trivia/CJoueur/addNew/", "frmAdd","#divMessage");
	}

	public function addNew(){
		$nouveau=new Joueur();
		RequestUtils::setValuesToObject($nouveau);
		$monde=DAO::getOne("Monde", $_POST["idMonde"]);
		$nouveau->setMonde($monde);
		if(DAO::insert($nouveau)==1)
			echo "Insertion de ".$nouveau." ok";
			echo JsUtils::get("/trivia/CJoueur/refresh","{}","#divListe");
		}

    public function connexion(){
        if($joueur=DAO::getOne("Joueur","login='".$_POST["login"]."' AND password= '".$_POST["password"]."'")){
            //var_dump($joueur);
            $_SESSION["joueur1"] = $joueur;
            //var_dump($joueur);
        }
        else
            echo 'Identifiants incorrects';

        //echo JsUtils::doSomethingOn("#frmConnexion","hide");
        //echo JsUtils::doSomethingOn("#inscription","hide");
        echo JsUtils::get("CJoueur/index", "{}", "body");
    }

    public function deconnexion(){
        session_destroy();
        //echo "coucou";
        echo JsUtils::get("CJoueur/index", "{}", "body");
    }


    public function viewInscription (){
        echo JsUtils::doSomethingOn("#frmConnexion","hide");
        echo JsUtils::doSomethingOn("#inscription","hide");
        $this->loadView("VInscription");
        echo JsUtils::postFormAndBindTo("#btValider3","click","/trivia/CJoueur/inscription/","frmInscription","#divMessage");


    }
    public function inscription() {

        $joueur=new Joueur();
        RequestUtils::setValuesToObject($joueur);
        $monde=DAO::getOne("Monde", $_POST["idMonde"]);
        $joueur->setMonde($monde);
        if(DAO::insert($joueur)==1)
            echo "Insertion de ".$joueur." ok";
        //echo JsUtils::get("/trivia/CJoueur/refresh","{}","#divListe");

    }

    public function affichHead(){
        if(isset($_SESSION['joueur1']))
        {
            $result= "<a href='#' id='lienParties'>Parties</a> Connecté en tant que <span class='headName'><a href='#' class='lienJoueur' id='lienJoueur'>".$_SESSION["joueur1"]->getPrenom()."</a></span><a id='deconnexion' href='#'> Deconnexion</a>";

        }
        else
        {
            $result= "<a href='CJoueur'>Connectez-vous</a>";
        }
        $this->loadView("vHeader", $result);
        echo JsUtils::getAndBindTo("#lienJoueur", "click", "/trivia/CJoueur/pageJoueur/", "{}", "#divListe");
        echo JsUtils::getAndBindTo("#lienParties", "click", "/trivia/CJoueur/listerParties/", "{}", "#divListe");

    }


    public function listerParties(){

        //$parties=DAO::getOneToMany($_SESSION["joueur1"], "parties");
        //$this->loadView("vPartie", $parties);

        //Affiche toutes les parties en cours du joueur
        if (isset ($_SESSION['joueur1'])) {


            $idJoueur = $_SESSION['joueur1']->getId();

            // Affiche toutes les parties ou est le joueur
            $partiesEnCours = DAO::getAll("Partie", "(idJoueur1=" . $idJoueur . " OR idJoueur2=" . $idJoueur . ") AND idJoueur2 IS NOT NULL AND partieFini='0'");
            // Affiche les parties qui sont possible à rejoindre
            $partiesJoignables = DAO::getAll("Partie", "idJoueur2 is NULL AND idJoueur1 != $idJoueur");
            //var_dump( DAO::getAll("Partie","idJoueur2 is NULL AND idJoueur1 != $idJoueur"));

            $this->loadView("vPartie", array("pEnCours" => $partiesEnCours, "pJoignables" => $partiesJoignables));
            echo JsUtils::getAndBindTo(".rejoindre", "click", "/trivia/CPartie/Jouer", "{}","#divMessage");
        }


    }

    // affichage des informations relatives au Joueur dans une page
    public function pageJoueur(){
        $idJoueur = $_SESSION['joueur1']->getId();

        $data["prenom"]=$_SESSION["joueur1"]->getPrenom();
        $data["nom"]=$_SESSION["joueur1"]->getNom();
        $data["id"]=$_SESSION["joueur1"]->getId();
        //$data["idMonde"]=$_SESSION["joueur1"]->getIdMonde();
        $data["mail"]=$_SESSION["joueur1"]->getMail();
        $data["login"]=$_SESSION["joueur1"]->getLogin();
        $data["password"]=$_SESSION["joueur1"]->getPassword();
        $data["niveau"]=$_SESSION["joueur1"]->getNiveau();

        $stat = DAO::getAll("Statistiques", "idJoueur ='" . $idJoueur."'");
        $this->loadView("vJoueur",array("profil" => $data, "stat" => $stat));
    }



}