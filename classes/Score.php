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
    private $idDomaine;

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