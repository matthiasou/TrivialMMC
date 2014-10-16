<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 11:12
 */

class Score extends \BaseObject{
    private $idPartie;
    private $idJoueur;
    private $nbBonnesReponses;
    private $nbManches;


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


} 