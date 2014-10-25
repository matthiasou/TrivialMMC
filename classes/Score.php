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
     * @ManyToOne
     * @JoinColumn(name="idPartie",className="Partie")
     */
    private $Partie;

    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur",className="Joueur")
     */
    private $Joueur;

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

    /**
     * @return mixed
     */
    public function getJoueur()
    {
        return $this->Joueur;
    }

    /**
     * @param mixed $Joueur
     */
    public function setJoueur($Joueur)
    {
        $this->Joueur = $Joueur;
    }

    /**
     * @return mixed
     */
    public function getPartie()
    {
        return $this->Partie;
    }

    /**
     * @param mixed $Partie
     */
    public function setPartie($Partie)
    {
        $this->Partie = $Partie;
    }



} 