<?php

class Monde extends \BaseObject{
	private $libelle;

	public function getLibelle() {
		return $this->libelle;
	}
	
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}
	
	
	/* (non-PHPdoc)
	 * @see BaseObject::toString()
	 */
	public function toString() {
		return $this->libelle;

	}

	
}