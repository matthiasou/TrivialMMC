<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 02/10/2014
 * Time: 11:54
 */


class Signalement extends \BaseObject {
    /**
     * @Id
     */
    private $idJoueur;
    /**
     * @Id
     */
    private $idProbleme;
    /**
     * @Id
     */
    private $idQuestion;
    /**
     * @ManyToOne
     * @JoinColumn(name="idProbleme",className="Probleme")
     */
    private $probleme;
    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur",className="Joueur")
     */
    private $joueur;
    /**
     * @ManyToOne
     * @JoinColumn(name="idQuestion",className="Question")
     */
    private $question;
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
    public function getProbleme()
    {
        return $this->probleme;
    }

    /**
     * @param mixed $probleme
     */
    public function setProbleme($probleme)
    {
        $this->probleme = $probleme;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }


} 