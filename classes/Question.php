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
     * @OneToMany(mappedBy="id",className="Joueur")
     */
    private $idJoueur;



    /**
     * @ManyToOne
     * @JoinColumn(name="idDomaine",className="Domaine")
     */
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




} 