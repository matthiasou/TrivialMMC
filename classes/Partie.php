<?php

class Partie extends \BaseObject{
	private $dernierCoup;

	/**
	 * @ManyToOne
	 * @JoinColumn(name="idJoueur1",className="Joueur")
	 */
	private $joueur1;

	public function getDernierCoup() {
		return $this->dernierCoup;
	}
	
	public function setDernierCoup($dernierCoup) {
		$this->dernierCoup = $dernierCoup;
		return $this;
	}

	public function getJoueur1() {
		return $this->joueur1;
	}
	
	public function setJoueur1($joueur1) {
		$this->joueur1 = $joueur1;
		return $this;
	}
	
	public function toString() {
		return $this->joueur1." (".$this->dernierCoup.")";

	}

}