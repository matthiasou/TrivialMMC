<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 16/10/14
 * Time: 10:04
 */

class Couronne extends \BaseObject {
    /**
     * @Id
     */
    private $idPartie;
    /**
     * @Id
     */
    private $idJoueur;
    /**
     * @Id
     */
    private $idDomaine;
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
     * @ManyToOne
     * @JoinColumn(name="idDomaine",className="Domaine")
     */
    private $Domaine;

    /**
     * @return mixed
     */
    public function getDomaine()
    {
        return $this->Domaine;
    }

    /**
     * @param mixed $Domaine
     */
    public function setDomaine($Domaine)
    {
        $this->Domaine = $Domaine;
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