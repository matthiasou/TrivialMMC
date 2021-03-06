<?php

class Partie extends \BaseObject
{
    private $dernierCoup;

    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur1",className="Joueur")
     */
    private $joueur1;



    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueur2",className="Joueur")
     */
    private $joueur2;


    /**
     * @ManyToOne
     * @JoinColumn(name="idJoueurEnCours",className="Joueur")
     */
    private $joueurEnCours;

    /**
     * @return mixed
     */

    private $partieFini;

    /**
     * @return mixed
     */
    public function getPartieFini()
    {
        return $this->partieFini;
    }

    /**
     * @param mixed $partieFini
     */
    public function setPartieFini($partieFini)
    {
        $this->partieFini = $partieFini;
    }

    public function getJoueurEnCours()
    {
        return $this->joueurEnCours;
    }

    /**
     * @param mixed $joueurEnCours
     */
    public function setJoueurEnCours($joueurEnCours)
    {
        $this->joueurEnCours = $joueurEnCours;
    }

    /**
     * @return mixed
     */
    public function getJoueur2()
    {
        return $this->joueur2;
    }

    /**
     * @param mixed $joueur2
     */
    public function setJoueur2($joueur2)
    {
        $this->joueur2 = $joueur2;
    }

    public function getDernierCoup()
    {
        return $this->dernierCoup;
    }

    public function setDernierCoup($dernierCoup)
    {
        $this->dernierCoup = $dernierCoup;
        return $this;
    }

    public function getJoueur1()
    {
        return $this->joueur1;
    }

    public function setJoueur1($joueur1)
    {
        $this->joueur1 = $joueur1;
        return $this;
    }




    public function toString()
    {
        return $this->joueur1->getNom();

    }
}
