<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 27/10/14
 * Time: 16:43
 */

class Statistiques extends \BaseObject {

    /**
     * @ManyToOne
     * @JoinColumn(name="idDomaine",className="Domaine")
     */
    private $idDomaine;
    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur",className="Joueur")
     */
    private $idJoueur;
    private $nbBonnesReponses;
    private $nbReponses;

    public function getIdDomaine() {
        return $this->idDomaine;
    }
    public function setIdDomaine($idDomaine) {
        $this->idDomaine = $idDomaine;
        return $this;
    }
    public function getIdJoueur() {
        return $this->idJoueur;
    }
    public function setIdJoueur($idJoueur) {
        $this->idJoueur = $idJoueur;
        return $this;
    }
    public function getNbBonnesReponses() {
        return $this->nbBonnesReponses;
    }
    public function setNbBonnesReponses($nbBonnesReponses) {
        $this->nbBonnesReponses = $nbBonnesReponses;
        return $this;
    }
    public function getNbReponses() {
        return $this->nbReponses;
    }
    public function setNbReponses($nbReponses) {
        $this->nbReponses = $nbReponses;
        return $this;
    }

    public function incReponses() {
        $this->nbReponses++;
    }

    public function incBonnesReponses() {
        $this->nbBonnesReponses++;
        $this->nbReponses++;
    }


} 