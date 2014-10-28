<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 11:12
 */

class Score extends \BaseObject{

    private $nbBonnesReponses;
    private $nbManches;
    /**
     * @Id
     */
    private $idPartie;
    /**
     * @Id
     */
    private $idJoueur;
    /**
     * @ManyToOne
     * @JoinColumn(name="idPartie",className="Partie")
     */
    private $partie;

    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur",className="Joueur")
     */
    private $joueur;

    /**
     * @return mixed
     */
    public function getPartie()
    {
        return $this->partie;
    }

    /**
     * @param mixed $partie
     */
    public function setPartie($partie)
    {
        $this->partie = $partie;
    }

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
    public function getIdPartie()
    {
        return $this->idPartie;
    }

    /**
     * @param mixed $idPartie
     */
    public function setIdPartie($idPartie)
    {
        $this->idPartie = $idPartie;
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
    public function getNbBonnesReponses()
    {
        return $this->nbBonnesReponses;
    }

    /**
     * @param mixed $nbBonnesReponses
     */
    public function setNbBonnesReponses($nbBonnesReponses)
    {
        $this->nbBonnesReponses = $nbBonnesReponses;
    }

    /**
     * @return mixed
     */
    public function getNbManches()
    {
        return $this->nbManches;
    }

    /**
     * @param mixed $nbManches
     */
    public function setNbManches($nbManches)
    {
        $this->nbManches = $nbManches;
    }


    public function incNbManches() {
        $this->nbManches++;
    }

    public function incNbBonnesReponses() {
        $this->nbBonnesReponses++;
    }



} 