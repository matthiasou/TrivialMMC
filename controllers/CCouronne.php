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
     * @param $p(idPartie)
     * @brief Couronnes Manquantes
     * @details Renvoi les couronnes manquantes à la vue vCouronne, Affiche la vue vCouronne
     */
    public function couronne($p){
        //$joueur = new  CJoueur();
        //$joueur->affichHead();


        echo JsUtils::execute('swal({   title: "Bonne réponse !",   text: "Vous pouvez choisir une couronne à débloquer",   imageUrl: "/trivia/images/qstCou.png" });');

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
    /**
     * @param $p(idPartie)
     * @brief Donne une question pour couronne choisie
     */
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

    /**
     * @param $p(idPartie)
     * @brief Vérifie la reponse de la question
     * @details Si le joueur repond bien => Vérification  si le joueur à toute les couronnes ( si oui, gagne . si non, questions suivantes) Par contre si la réponse est mauvaise c'est à l'autre joueur de jouer
     */
    public function checkCouronneAnswer($p){
        $this->loadView("vHeader");
        $idDomaine=$_SESSION['idDomaine'];
        $joueur = $_SESSION['joueur1'];
        $idJoueur = $_SESSION['joueur1']->getId();
        $estBonne=DAO::getOne("Reponse",$p[1])->getEstBonne();

        if($estBonne == 1){
            //echo JsUtils::execute('alert("Nouvelle couronne débloquée:")');
            echo JsUtils::execute('swal({   title: "Nouvelle couronne débloquée!",   text: "",   imageUrl: "/trivia/images/couronne.png" });');

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
                //echo JsUtils::execute('alert("Vous avez gagné !")');
                echo JsUtils::execute('swal({   title: "Victoire !",   text: "Vous avez remporté la partie",   imageUrl: "/trivia/images/victoire.png" });');
                echo JsUtils::execute('setTimeout(function(){
                        $(location).attr("href","/trivia/CJoueur");
                    }, 2000);');
               // echo JsUtils::execute('window.location = " /trivia/CJoueur"');


            }
            else {


                echo JsUtils::get("/trivia/CQuestion/afficherRoulette/".$p[0], "{}", "#divMessage");


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
            echo JsUtils::execute('swal({   title: "Mauvaise réponse !",   text: "A l autre joueur de jouer",   imageUrl: "/trivia/images/pouce.png" });');
            echo JsUtils::execute('setTimeout(function(){
                        $(location).attr("href","/trivia/CJoueur");
                    }, 2000);');
            //echo JsUtils::execute('alert("Mauvaise réponse !")');
            //echo JsUtils::execute('window.location = " /trivia/CJoueur"');

        }

    }






} 