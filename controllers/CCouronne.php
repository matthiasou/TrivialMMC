<?php
/**
 * Created by PhpStorm.
 * @author: matthiaslecomte
 * @date: 16/10/14
 * @Time: 10:05
 */



class CCouronne extends \BaseController {
    public function index(){
        $this->loadView("vHeader");


    }

    public function load(){
        var_dump(DAO::getAll("Couronne"));
    }

    /**
     * @param $p
     * @brief Couronnes Manquantes
     * @details Renvoi les couronnes manquantes à la vue vCouronne
     */
    public function couronne($p){
        $this->loadView("vHeader");

        $joueur = $_SESSION['joueur1']; // recupere le joueur
        $idJoueur= $_SESSION['joueur1']->getId(); // son id

        // Recupere les domaines du monde du joueur
        $domaine = DAO::getAll("Domaine", "idMonde ='" . $joueur->getMonde()->getId()."'");
        //echo 'Tous les domaines que le joueur peut avoir : ';
        //var_dump($domaine);

        // recupere toutes les couronnes du joueur
        $couronne = DAO::getAll("Couronne","idPartie='".$p[0]."' AND idJoueur= '".$idJoueur."'");
        //echo 'couronne que le joueur a : ';
        //var_dump($couronne);

        $toutesLesCouronnes =array();
        foreach ($couronne as $couronne){
            $toutesLesCouronnes[]=$couronne->getIdDomaine();
        }
        // Domaine que le joueur n'a pas
        $couronnesManq = array();
        foreach($domaine as $domaine){
            if (!in_array($domaine->getId(),$toutesLesCouronnes)){
                $couronnesManq[]=$domaine;
            }
        }
        //echo'domaine que le joueur na pas';
       // var_dump($couronnesManq);

         $this->loadView("vCouronne",$couronnesManq);
         echo JsUtils::postFormAndBindTo("#btChoixCouronne","click","/trivia/CCouronne/questionCouronne/". $p[0],"frmChoixCouronne","#divQstCouronne");

    }

    public function questionCouronne($p){
        $this->loadView("vHeader");

        $idDomaine = $_POST["idDomaine"];
        $question=DAO::getOne("Question", "idDomaine= ".$idDomaine." AND 1=1 ORDER BY RAND() LIMIT 1 ");
        //var_dump($question);
        DAO::getOneToMany($question, "reponses");
        $this->loadView("vQuestion", $question);


        //$p[2]=$idDomaine;
        $_SESSION['idDomaine'] = $idDomaine;
        //var_dump($p);


        


        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CCouronne/checkCouronneAnswer/". $p[0], "{}", "#divQuestion");


    }

    public function checkCouronneAnswer($p){
        $this->loadView("vHeader");
        $idDomaine=$_SESSION['idDomaine'];
        $joueur = $_SESSION['joueur1'];
        $idJoueur = $_SESSION['joueur1']->getId();
        $estBonne=DAO::getOne("Reponse",$p[1])->getEstBonne();

        if($estBonne == 1){
            echo JsUtils::execute('alert("Nouvelle couronne débloquée:")');
           // $couronne = DAO::getOne("Couronne","idJoueur='".$idJoueur."' AND idPartie= '".$p[0]."' AND idDomaine='".$idDomaine."'");
            //var_dump($couronne);
            $couronne=new Couronne();
            $couronne->setidPartie($p[0]);
            $couronne->setidJoueur($idJoueur);
            $couronne->setidDomaine($idDomaine);
            DAO::insert($couronne);
            //$sql="SELECT COUNT(idDomaine) FROM couronne WHERE idJoueur='".$idJoueur."'";

            $couronne2 = DAO::getAll("Couronne","idJoueur='".$idJoueur."' AND idPartie= '".$p[0]."'");
           // echo sizeof($couronne2);
            $domaine = DAO::getAll("Domaine", "idMonde ='" . $joueur->getMonde()->getId()."'");
           // echo sizeof($domaine);
            if (sizeof($couronne2)==sizeof($domaine)) {
                $partie =  DAO::getOne("Partie","id= ".$p[0]);
                $partie->setPartieFini("1");
                DAO::update($partie);
                echo JsUtils::execute('alert("Vous avez gagné !")');
                echo JsUtils::execute('window.location = " /trivia/CJoueur"');


            }
            else {
                $question = new  CQuestion();
                $question->randomQuestion($p);

            }

        }
        else {
            $partie = DAO::getOne("Partie", "id ='" . $p[0] . "'");
            //var_dump($partie);
            if ($partie->getJoueur1()->getId() == $idJoueur) {
                $partie->setJoueurEnCours($partie->getJoueur2());

            } else {
                $partie->setJoueurEnCours($partie->getJoueur1());

            }
            $partie->setDernierCoup(date("Y-m-d H:i:s"));
            DAO::update($partie);
            echo JsUtils::execute('alert("Mauvaise réponse !")');
            echo JsUtils::execute('window.location = " /trivia/CJoueur"');

        }

    }



} 