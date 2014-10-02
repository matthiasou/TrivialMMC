<?php

abstract class BaseController {
	abstract function index();
	public function __construct(){
		if(!$this->isValid())
			$this->onInvalidControl();
	}
	
	public function loadView($viewName,$pData=""){
		$data=$pData;
		$fileName="views/".$viewName.".php";
		if(file_exists($fileName)){
			include($fileName);
		}else{
			throw new Exception("Vue inexistante");
		}
	}
	
	/**
	 * retourne Vrai si l'accès au contrôleur est autorisé
	 * @return boolean
	 */
	public function isValid(){
			return true;
	}
	
	public function onInvalidControl(){
		header('HTTP/1.1 401 Unauthorized', true, 401);
		exit;
	}
}
?>
