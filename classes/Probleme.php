<?php
/**
 * Created by PhpStorm.
 * User: charlesleducq
 * Date: 02/10/2014
 * Time: 11:11
 */

class Probleme extends \BaseObject{
    private $id;
    private $libelle;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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