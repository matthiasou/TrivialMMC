<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 11:12
 */

class Reponse extends \BaseObject{
    private $idQuestion;

    /**
     * @OneToMany(mappedBy="libelle",className="Reponse")
     */
    private $libelle;

    /**
     * @OneToMany(mappedBy="estBonne",className="Reponse")
     */
    private $estBonne;

    /**
     * @return mixed
     */
    public function getEstBonne()
    {
        return $this->estBonne;
    }

    /**
     * @param mixed $estBonne
     */
    public function setEstBonne($estBonne)
    {
        $this->estBonne = $estBonne;
    }


    /**
     * @return mixed
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    /**
     * @param mixed $idQuestion
     */
    public function setIdQuestion($idQuestion)
    {
        $this->idQuestion = $idQuestion;
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