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
        if (!isset($_SESSION['joueur1']))
        {
            $this->loadView("VConnexion");
        }
        $this->affichHead();
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
            var_dump($joueur);
            $_SESSION["joueur1"] = $joueur;
            var_dump($joueur);
        }
        else
            echo 'Identifiants incorrects';

        echo JsUtils::doSomethingOn("#frmConnexion","hide");
        echo JsUtils::doSomethingOn("#inscription","hide");
    }

    public function deconnexion(){
        session_destroy();
        echo JsUtils::get("CQuestion");
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
            $result= "Connecté en tant que <span class='headName'>".$_SESSION["joueur1"]->getPrenom()."</span><a id='deconnexion' href='#'> Deconnexion</a>";

        }
        else
        {
            $result= "<a href='CJoueur'>Connectez-vous</a>";
        }
        $this->loadView("vHeader", $result);
    }

    public function listerParties(){

        //$parties=DAO::getOneToMany($_SESSION["joueur1"], "parties");
        //$this->loadView("vPartie", $parties);

        //Affiche toutes les parties en cours du joueur
        if (isset ($_SESSION['joueur1'])) {

        $idJoueur=$_SESSION['joueur1']->getId();

        // Affiche toutes les parties ou est le joueur
        $partiesEnCours = DAO::getAll("Partie","idJoueur1=".$idJoueur." <> idJoueur2=".$idJoueur);
        // Affiche les parties qui sont possible à rejoindre
        $partiesJoignables = DAO::getAll("Partie","idJoueur2 is NULL AND idJoueur1 != $idJoueur");
        //var_dump( DAO::getAll("Partie","idJoueur2 is NULL AND idJoueur1 != $idJoueur"));

        $this->loadView("vPartie",array("pEnCours"=>$partiesEnCours,"pJoignables"=>$partiesJoignables));

            $this->loadView("vPartie", array("pEnCours" => $partiesEnCours, "pJoignables" => $partiesJoignables));
        }


    }

    public function rejoindre(){
        $this->listerParties();
        $this->affichHead();
    }



}