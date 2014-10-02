<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 11:11
 */

class Domaine extends \BaseObject{

    private $libelle;
    private $description;

    /**
     * @ManyToOne
     * @JoinColumn(name="idMonde",className="Monde")
     */
    private $idMonde;


    /**
     * @OneToMany(mappedBy="domaine",className="Question")
     */
    private $questions;

    /**
     * @return mixed
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return mixed
     */
    public function getIdMonde()
    {
        return $this->idMonde;
    }

    /**
     * @param mixed $idMonde
     */
    public function setIdMonde($idMonde)
    {
        $this->idMonde = $idMonde;
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


} 