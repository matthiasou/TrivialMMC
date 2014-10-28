<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 27/10/14
 * Time: 16:43
 */

class Statistiques extends \BaseObject {

    /**
     * @Id
     */
    private $idDomaine;
    /**
     * @Id
     */
    private $idJoueur;
    /**
     * @ManyToOne
     * @JoinColumn(name="idDomaine",className="Domaine")
     */
    private $domaine;
    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur",className="Joueur")
     */
    private $joueur;
    private $nbBonnesReponses;
    private $nbReponses;

    /**
     * @return mixed
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * @param mixed $joueur
     */
    public function setJoueur($joueur)
    {
        $this->joueur = $joueur;
    }

    /**
     * @return mixed
     */
    public function getIdJoueur()
    {
        return $this->idJoueur;
    }

    /**
     * @param mixed $idJoueur
     */
    public function setIdJoueur($idJoueur)
    {
        $this->idJoueur = $idJoueur;
    }

    /**
     * @return mixed
     */
    public function getIdDomaine()
    {
        return $this->idDomaine;
    }

    /**
     * @param mixed $idDomaine
     */
    public function setIdDomaine($idDomaine)
    {
        $this->idDomaine = $idDomaine;
    }

    /**
     * @return mixed
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * @param mixed $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
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