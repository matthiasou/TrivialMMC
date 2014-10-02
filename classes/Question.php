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
     * @ManyToMany(targetEntity="Joueur", inversedBy="idJoueur1")
     * @JoinTable(name="Joueur")
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