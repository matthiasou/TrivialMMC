<?php

class cTestController extends \BaseController{


	public function index(){ 
		echo "test ok"; 
	}
	
	public function showVariables($params){
		var_dump($params);
	}
	
	public function chargeVue(){
		$this->loadView("vHeader");
		$d=array("val1"=>1,"val2"=>2,"val3"=>3);
		$this->loadView("vTest",$d);
		$this->loadView("vFooter");
	}
	
	public function showJoueurs(){
		$joueurs=DAO::getAll("Joueur");
		DAO::getOneToMany($joueurs[0],"parties");
		var_dump($joueurs);
		
		echo $joueurs[0]->getParties()[0];
	}

}