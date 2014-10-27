<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 02/10/2014
 * Time: 11:54
 */


class Signalement {
    /**
     * @ManyToOne
     * @JoinColumn(name="idProbleme",className="Probleme")
     */
    private $idProbleme;
    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur",className="Joueur")
     */
    private $idJoueur;
    /**
     * @ManyToOne
     * @JoinColumn(name="idQuestion",className="Question")
     */
    private $idQuestion;
    private $dateS;

    /**
     * @return mixed
     */
    public function getDateS()
    {
        return $this->dateS;
    }

    /**
     * @param mixed $dateS
     */
    public function setDateS($dateS)
    {
        $this->dateS = $dateS;
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
    public function getIdProbleme()
    {
        return $this->idProbleme;
    }

    /**
     * @param mixed $idProbleme
     */
    public function setIdProbleme($idProbleme)
    {
        $this->idProbleme = $idProbleme;
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

} 