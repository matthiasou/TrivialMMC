<?php

/**
 * Utilitaires liés à la requête $_POST ou $_GET
 * @author jc
 * version 1.0.0.1
 */
class RequestUtils{
	/**
	 * Affecte membre à membre les valeurs du tableau associatif $values aux membres de l'objet $object
	 * Utilisé par exemple pour récupérer les variables postées et les affecter aux membres d'un objet 
	 * @param Class $object
	 * @param associative array $values
	 */
	public static function setValuesToObject($object,$values=null){
		if(!isset($values))
			$values=$_POST;
		foreach ($values as $key=>$value){
			$accessor="set".ucfirst($key);
			if(method_exists($object, $accessor)){
				$object->$accessor($value);
			}
		}
	}
	/**
	 * Appel d'une fonction de nettoyage sur le post
	 * @param string $function
	 * @return multitype:
	 */
	public static function getPost($function="htmlentities"){
		return array_map($function, $_POST);
	}
}