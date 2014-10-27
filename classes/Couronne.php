<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 16/10/14
 * Time: 10:04
 */

class Couronne extends \BaseObject {
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
    /**
     * @ManyToOne
     * @JoinColumn(name="idDomaine",className="Domaine")
     */
    private $Domaine;

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




} 