<?php
/**
 * Created by PhpStorm.
<<<<<<< Updated upstream
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 11:11
 */


class Question extends \BaseObject {

    private $libelle;
    private $validation;




    /**
     * @OneToMany(mappedBy="question",className="Reponse")
     */
    private $reponses=array();


    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur",className="Joueur")
     */
    private $joueur;



    /**
     * @ManyToOne
     * @JoinColumn(name="idDomaine",className="Domaine")
     */
    private $domaine;

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
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * @param mixed $validation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }


    public function toString()
    {
        return $this->libelle;
    }

    /**
     * @return mixed
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * @param mixed $reponses
     */
    public function setReponses($reponses)
    {
        $this->reponses = $reponses;
    }
}