<?php

class Joueur extends \BaseObject{
	private $nom;
	private $prenom;
	private $mail;
	
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idMonde",className="Monde")
	 */
	private $monde;
	
	/**
	 * @OneToMany(mappedBy="joueur1",className="Partie")
	 */
	private $parties=array();

	public function getNom() {
		return $this->nom;
	}
	
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	
	public function getPrenom() {
		return $this->prenom;
	}
	
	public function setPrenom($prenom) {
		$this->prenom = $prenom;
		return $this;
	}
	
	public function getMail() {
		return $this->mail;
	}
	
	public function setMail($mail) {
		$this->mail = $mail;
		return $this;
	}

	public function getMonde() {
		return $this->monde;
	}
	
	public function setMonde($monde) {
		$this->monde = $monde;
		return $this;
	}

	public function getParties() {
		return $this->parties;
	}
	
	public function setParties($parties) {
		$this->parties = $parties;
		return $this;
	}
	
	/* (non-PHPdoc)
	 * @see BaseObject::toString()
	 */
	public function toString() {
		return $this->nom." ".$this->prenom;
	}

	
}