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
    private $monde;

    /**
     * @return mixed
     */
    public function getMonde()
    {
        return $this->monde;
    }

    /**
     * @param mixed $monde
     */
    public function setMonde($monde)
    {
        $this->monde = $monde;
    }


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