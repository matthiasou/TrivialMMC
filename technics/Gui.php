<?php
/**
 * Classe technique destinée à la conception des interfaces
 * @author jc
 *
 */
class Gui{
	/**
	 * Affiche un objet ou un tableau d'objets en appliquant au préalable la méthode $method à chacun d'entre eux 
	 * @param mixed $values Valeur(s) à afficher
	 * @param string $method Méthode de la classe GUI ou de la classe de $value
	 */
	public static function show($values,$method='toString'){
		if(is_array($values)){
			foreach ($values as $v){
				Gui::showOne($v,$method);
			}
		}else 
			Gui::showOne($values,$method);
	}
	
	/**
	 * Affiche un objet $value en lui ayant au préalable appliqué la méthode $method
	 * @param Object $value
	 * @param string $method Méthode de la classe GUI ou de la classe de $value
	 */
	public static function showOne($value,$method='toString'){
		echo Gui::getOne($value,$method);
	}
	
	public static function getOne($value,$method='toString'){
		if(method_exists("GUI", $method)){
			$value=GUI::$method($value);
			
		}else{
			if(method_exists($value, $method)){
				$value=$value->$method();
			}else{
				$value=$value.'';
			}
		}
		return $value;
	}
	
	public static function addDelete($value){
		return "<tr><td class='element'><input title='Sélectionner' type='checkbox' class='ck' id='ck".$value->getId()."' value='".$value->getId()."'><span title='Modifier...' class='update' id='update".$value->getId()."'>&nbsp;".$value->toString()."<span></td><td><span title='Supprimer...' class='delete' id='delete".$value->getId()."'>&nbsp;</span></td></tr>";
	}
	
	public static function select($value){
		return "<option class='element' id='element".$value->getId()."' value='".$value->getId()."'>".$value->toString()."</option>";
	}
	
	/**
	 * Retourne l'expression $singulier au pluriel en fonction du nombre $nb
	 * @param string $singulier
	 * @param string $pluriel
	 * @param int $nb
	 */
	public static function pluriel($singulier,$pluriel,$nb){
		if($nb==0){
			echo "Aucun ".$singulier;
		}else{
			printf(ngettext("%d ".$singulier, "%d ".$pluriel, $nb),$nb);
		}
	}
}