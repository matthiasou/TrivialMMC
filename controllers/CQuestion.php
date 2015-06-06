<?php
/**
 * Created by PhpStorm.
 * User: matthiaslecomte
 * Date: 02/10/14
 * Time: 11:30
 */

class CQuestion extends \BaseController {

    public function index(){
        $this->loadView("vHeader");
        $this->loadView("VAddQuestion");
        echo JsUtils::postFormAndBindTo("#btAjQu", "click", "/trivia/CQuestion/ajoutQuestion/", "frmAddQuestion","#divMessage");

    }


    public function load(){
        $this->loadView("vHeader");
        var_dump(DAO::getAll("Question"));
    }

    /**
     * @param $p(idPartie)
     * @brief Charge une question des domaines du joueur
     * @details Si le joueur n'a pas de statistiques cela les initialises, Affiche les vues vQuestion et vInfoPartie
     */
    public function randomQuestion($params){


        $idPartie = $params[0]; // récupere l'id de la partie
        $idJoueur = $_SESSION['joueur1']->getId();
        $joueur = $_SESSION['joueur1']; // recupere le joueur

        echo JsUtils::doSomethingOn("#divListe","hide"); // cache le menu principal avec les parties
        $domaine = $_SESSION['domaine'];
        $question=DAO::getOne("Question", "idDomaine=".$domaine->getId()." AND 1=1 ORDER BY RAND() LIMIT 1");
        $idQuestion = $question->getId();
        $idDomaine =$question->getDomaine()->getId();
        $_SESSION['idDomaine']=$idDomaine;
        DAO::getOneToMany($question, "reponses");

        $stat=DAO::getOne("Statistiques", "idDomaine = '" . $idDomaine . "' AND idJoueur = '" . $idJoueur . "'");
        if ($stat == NULL){
            $statistiques= new  Statistiques();
            $statistiques->setIdDomaine($idDomaine);
            $statistiques->setIdJoueur($idJoueur);
            $statistiques->setNbBonnesReponses("0");
            $statistiques->setNbReponses("0");
            DAO::insert($statistiques);

        }
        $partie = DAO::getOne("Partie","id=".$idPartie);
        $couronneJ1 = DAO::getAll("Couronne","idJoueur=".$idJoueur." AND idPartie=".$idPartie);
        $couronneJ2 = DAO::getAll("Couronne","idJoueur!=".$idJoueur." AND idPartie=".$idPartie);
        $scoreJ1 = DAO::getOne("Score","idJoueur=".$idJoueur." AND idPartie=".$idPartie);
        $scoreJ2 = DAO::getOne("Score","idJoueur!=".$idJoueur." AND idPartie=".$idPartie);
        $info =array("partie"=>$partie, "couronneJ1"=>$couronneJ1, "couronneJ2"=>$couronneJ2, "scoreJ1"=>$scoreJ1, "scoreJ2"=>$scoreJ2);

        $this->loadView("vInfoPartie",$info);
        $this->loadView("vQuestion", $question);
        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CQuestion/checkAnswer/" .$idPartie ."/".$idDomaine, "{}", "#divQuestion");
        echo JsUtils::getAndBindTo("#signalerQuestion", "click", "/trivia/CQuestion/signalerQuestion/" . $idQuestion, "{}", "#messageSignalement");
    }

    /**
     * @brief Permet de vérifier si la réponse sélectionnée par le joueur est bonne.
     * @details La fonction permet de voir si la réponse sélectionnée par le joueur est bonne. Elle permet également de mettre à jour le nombre de bonnes réponses successives
     * et le nombre de bonnes réponses totales. Elle vérifie également si le nombre de bonnes réponses successives est égal à 3, auquel cas on peut choisir on peut choisir
     * une couronne à jouer. Enfin, elle met à jour les statistiques du joueur.
     */
    public function checkAnswer($p){
        //var_dump($p);
        //$idDomaine = $_SESSION['idDomaine'];
        echo JsUtils::doSomethingOn("#frmScore","hide");
        $estBonne=DAO::getOne("Reponse",$p[2])->getEstBonne();
        $idJoueur = $_SESSION['joueur1']->getId();
        if($estBonne == 1){
            $score = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");
            // var_dump($score);
            $score->incRepSuccessives();
            $score->incNbBonnesReponses();
            DAO::update($score);
            $stat=DAO::getOne("Statistiques", "idDomaine = '". $p[1]. "' AND idJoueur = '" . $idJoueur . "'");
            if ($stat == NULL){
                $statistiques= new  Statistiques();
                $statistiques->setIdDomaine($p[1]);
                $statistiques->setIdJoueur($idJoueur);
                $statistiques->setNbBonnesReponses("1");
                $statistiques->setNbReponses("1");
                DAO::insert($statistiques);

            }
            else{
                $stat->incBonnesReponses();
                DAO::update($stat);
            }
            //var_dump($stat);

            if ($score->getRepSuccessives()<3) {
                echo '<script>swal("Bonne réponse !", " ", "success")</script>';
               // echo '<script>swal({   title: "Sweet!",   text: "Heres a custom image.",   imageUrl: "images/thumbs-up.jpg" });</script>';
            }
            // nouvelle question
            if ($score->getRepSuccessives()==3){
                $score->setRepSuccessives("0");
                DAO::update($score);
              //  echo '<script>swal("Bonne réponse !", "You clicked the button!", "success")</script>';
                echo JsUtils::get("/trivia/CCouronne/couronne/".$p[0], "{}", "#divMessage");
                echo JsUtils::postFormAndBindTo("#btChoixCouronne","click","/trivia/CCouronne/questionCouronne/". $p[0],"frmChoixCouronne","#divMessage");
               // echo JsUtils::execute('window.location = " /trivia/CCouronne/couronne/'.$p[0].'"');
            }
            else {
                //echo JsUtils::doSomethingOn("#divListe","hide");
                $question = new  CQuestion();
                $question->afficherRoulette($p);
                //JsUtils::get("/CQuestion/randomQuestion", $question);
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
            $score = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");
            $score->setRepSuccessives("0");
            if ($partie->getJoueurEnCours() == $partie->getJoueur2()) {
                $score->incNbManches();
                $idJoueur2 = $partie->getJoueur2()->getId();
                $scoreVoulu = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur2 . "'");
                $nbManches = $score->getNbManches();
                $scoreVoulu->setNbManches($nbManches);
                DAO::update($scoreVoulu);
            }
            DAO::update($score);
            $stat=DAO::getOne("Statistiques", "idDomaine = '" . $p[1]. "' AND idJoueur = '" . $idJoueur . "'");
            $stat->incReponses();
            DAO::update($stat);
            echo JsUtils::execute('window.location = " /trivia/CQuestion/gagner/'.$p[0].'"');
        }
    }

    /**
     * @brief Permet de savoir si le joueur a gagné la partie, auquel cas la
     * @details si le nombre de manches est égal à 25, on vérifie quel joueur a le plus de couronnes. Si le nombre de couronne est égal, alors on vérifie qui a le plus grand nombre de bonnes réponses.
     */
    public function gagner($p){
        $this->loadView("vHeader");
        $idJoueur = $_SESSION['joueur1']->getId();
        $partie = DAO::getOne("Partie", "id ='" . $p[0] . "'");
        if ($partie->getJoueur1()->getId() == $idJoueur) {
            $idJoueur2 = $partie->getJoueur2()->getId();
        } else {
            $idJoueur2 = $partie->getJoueur1()->getId();
        }
        $score = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");
        if ($score->getNbManches() == 25) {
            $partie->setPartieFini("1");
            DAO::update($partie);
            $couronneJ1 = DAO::getAll("Couronne", "idJoueur='" . $idJoueur . "' AND idPartie= '" . $p[0] . "'");
            $couronneJ2 = DAO::getAll("Couronne", "idJoueur='" . $idJoueur2 . "' AND idPartie= '" . $p[0] . "'");
            $scoreJ1 = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");
            $scoreJ2 = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur2 . "'");
            if (sizeof($couronneJ1) > sizeof($couronneJ2)) {
                $scoreJ1->setGagne("1");
                echo JsUtils::execute('alert("Vous avez gagné, vous avez plus de couronne !")');
                echo JsUtils::execute('swal({   title: "Gagné !",   text: "vous avez plus de couronne !",   imageUrl: "/trivia/images/victoire.png" });');
            } elseif (sizeof($couronneJ1) < sizeof($couronneJ2)) {
                $scoreJ2->setGagne("1");
                //echo JsUtils::execute('alert("Vous avez perdu votre adversaire à plus de couronne !")');
                echo JsUtils::execute('swal({   title: "Perdu !",   text: "Vous avez perdu votre adversaire à plus de couronne !",   imageUrl: "/trivia/images/loose.png" });');
            } elseif (sizeof($couronneJ1) == sizeof($couronneJ2)) {
                if ($scoreJ1->getNbBonnesReponses() > $scoreJ2->getNbBonnesReponses()) {
                   // echo JsUtils::execute('alert("Vous avez gagné car vous avez le meilleur nombre de bonnes réponses !")');
                    echo JsUtils::execute('swal({   title: "Victoire !",   text: "Vous avez gagné car vous avez le meilleur nombre de bonnes réponses !,   imageUrl: "/trivia/images/victoire.png" });');
                    $scoreJ1->setGagne("1");

                } elseif ($scoreJ1->getNbBonnesReponses() == $scoreJ2->getNbBonnesReponses()) {
                    $scoreJ2->setEgalite("1");
                    $scoreJ1->setEgalite("1");
                    //echo JsUtils::execute('alert("Egalité !")');
                    echo JsUtils::execute('swal({   title: "Egalité !",   text: "La prochaine fois essaye de battre ton adversaire",   imageUrl: "/trivia/images/egalite.png" });');

                } else {
                    $scoreJ2->setGagne("1");
                    //echo JsUtils::execute('alert("Vous avez perdu !")');
                    echo JsUtils::execute('swal({   title: "Vous avez perdu!",   text: "Ce sera mieux la prochaine fois",   imageUrl: "/trivia/images/loose.png" });');
                }

            }
            DAO::update($scoreJ1);
            DAO::update($scoreJ2);

            //echo JsUtils::execute('window.location = " /trivia/CJoueur"');
            echo JsUtils::execute('setTimeout(function(){
                        $(location).attr("href","/trivia/CJoueur");
                    }, 2000);');

        } else {
            // Mauvaise reponse -> retour au menu, changement JoueurEnCours
            echo JsUtils::execute('swal({   title: "Mauvaise réponse !",   text: "A l autre joueur de jouer",   imageUrl: "/trivia/images/pouce.png" });');


            //echo JsUtils::execute('alert("Mauvaise réponse, à l autre joueur de jouer ! ")');
            echo JsUtils::execute('setTimeout(function(){
                        $(location).attr("href","/trivia/CJoueur");
                    }, 1500);');


            //echo JsUtils::get("CJoueur/index", "{}", "body");

            //->changementJoueurEnCours();

        }
    }

    /**
     * @brief Permet d'ajouter une question dans la base, en rapport à un domaine.
     */
        public function ajoutQuestion() {
            $idJoueur = $_SESSION["joueur1"]->getId();
            //var_dump($idJoueur);
            $question=new Question();
            RequestUtils::setValuesToObject($question);
            $domaine=DAO::getOne("Domaine", $_POST["idQuestion"]);
            //var_dump($domaine);
            $question->setDomaine($domaine->getId());
            $question->setJoueur($idJoueur);
            DAO::insert($question);
            if(DAO::insert($question)==1)
                echo "Nouvelle question " . $question->getLibelle() . " ajoutée avec succès";
            else
                echo "Erreur. Impossible d'ajouter cette nouvelle question.";
        }

    //}

    /**
     * @brief Permet de signaler une question affichée en cours de partie, avec un message attaché pour l'administrateur. Elle appelle la fonction ajouterSignalement.
     * @details Affiche la vue vSignalement
     */
    public function signalerQuestion($idQuestion){

        $this->loadView("VSignalement");
        echo JsUtils::postFormAndBindTo("#btSignalement","click","/trivia/CQuestion/ajouterSignalement/" .$idQuestion[0],"frmSignalement","#messageSignalement");
    }

    /**
     * @brief Permet d'envoyer un rapport de signalement de question d'un joueur à un administrateur.
     * @details Les informations de la question et du joueur sont envoyé à l'administrateur avec un message d'explication rédigé par le joueur.
     */
    public function  ajouterSignalement($idQuestion){
        // il faut prendre la texte area et mettre dans le champ libelle de la table probleme
        // Puis mettre dans la table signalement l'id du problème, idJouee-> session, , idQuestion et la date grace à la fonction date

        $probleme=new Probleme();
        RequestUtils::setValuesToObject($probleme);
        $probleme->setLibelle($_POST["signalement"]);
        if(DAO::insert($probleme)==1) {
            $idProbleme = $probleme->getId();
            $idJoueur = $_SESSION["joueur1"]->getId();
            $signalement = new signalement();
            $signalement->setIdProbleme($idProbleme);
            $signalement->setIdJoueur($idJoueur);
            $signalement->setIdQuestion($idQuestion[0]);
            $signalement->setDateS(date("Y-m-d H:i:s"));
            DAO::insert($signalement);
            echo JsUtils::execute('alert("Votre MacBook Pro à bien été envoyé")');

        }

    }



    public function afficherRoulette($params) {
        //$this->loadView("vHeader");
        $aChanger = array("jouer", "rejoindre");
        $idPartie = str_replace($aChanger, "", $params[0]); // récupere l'id de la partie
        echo JsUtils::doSomethingOn("#divListe","hide"); // cache le menu principal avec les parties
        echo JsUtils::getAndBindTo("#question", "click", "/trivia/CQuestion/randomQuestion/".$idPartie,"{}","#divMessage");
       // echo JsUtils::getAndBindTo("#btAjQu", "click", "/trivia/CQuestion/randomQuestion".$idPartie, "{}","#divMessage");
        $joueur = $_SESSION['joueur1'];




        $this->selectDomaine($joueur);
        $domains = $this->selectDomaines($joueur);
        $this->loadView("vRoulette",$domains);



    }


    /**
     * Récupère tous les domaines qui font partie du monde du joueur
     * @param unknown $joueur
     * @return $domaine
     */
    public function selectDomaines($joueur){
        $domaine = DAO::getAll("Domaine","idMonde =".$joueur->getMonde()->getId());

        return $domaine;
    }

    /**
     * Retourne un domaine aléatoire
     * @param unknown $joueur
     * @return $domaine
     */
    public function selectDomaine($joueur){
        $domaine = DAO::getOne("Domaine","idMonde =".$joueur->getMonde()->getId()." ORDER BY rand() limit 1");
        //$domaine = DAO::getOne("Domaine","idMonde =".$joueur->getMonde()->getId()." AND libelle like 'Couronne'");
        $_SESSION['domaine'] = $domaine;

        return $domaine;
    }

} 