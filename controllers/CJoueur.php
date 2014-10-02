<?php

class CJoueur extends \BaseController{


	public function index(){ 
		$this->loadView("vHeader");
		$this->refresh();
		echo "<div id='divMessage'></div>";
	}
	public function refresh(){
		$joueurs=DAO::getAll("Joueur");
		$this->loadView("vJoueurs",$joueurs);
		echo JsUtils::getAndBindTo("#addNew", "click", "/trivia/CJoueur/viewAddNew/","{}","#divFrm");
		echo JsUtils::getAndBindTo(".delete", "click", "/trivia/CJoueur/delete","{}","#divMessage");
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
}