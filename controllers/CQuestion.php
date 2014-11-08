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

    public function randomQuestion($params){
       // var_dump($params[0]);
        $aChanger = array("jouer", "rejoindre");
        $idPartie = str_replace($aChanger, "", $params[0]); // récupere l'id de la partie
        $idJoueur = $_SESSION['joueur1']->getId();
      //  var_dump($idPartie);


        echo JsUtils::doSomethingOn("#divListe","hide"); // cache le menu principal avec les parties
        $question=DAO::getOne("Question", "1=1 ORDER BY RAND() LIMIT 1");
        DAO::getOneToMany($question, "reponses");
        //echo $reponses;
        $this->loadView("vQuestion", $question);
        echo JsUtils::getAndBindTo(".reponse", "click", "/trivia/CQuestion/checkAnswer/" . $idPartie, "{}", "#divQuestion");





    }

    public function checkAnswer($p){
        //var_dump($p);// id de la partie
        $idJoueur = $_SESSION['joueur1']->getId();
        $estBonne=DAO::getOne("Reponse",$p[1])->getEstBonne();
        if($estBonne == 1){
            $score = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");
           // var_dump($score);
            $score->incRepSuccessives();
            $score->incNbBonnesReponses();
            DAO::update($score);
            echo JsUtils::execute('alert("Bonne réponse")');
            // nouvelle question


            if ($score->getRepSuccessives()==3){
                $score->setRepSuccessives("0");
                DAO::update($score);
                echo JsUtils::execute('alert("Tu vas pouvoir jouer une couronne GG ! ")');
                echo JsUtils::execute('window.location = " /trivia/CCouronne/couronne/'.$p[0].'"');

            }
            else {
                //echo JsUtils::doSomethingOn("#divListe","hide");
                $question = new  CQuestion();
                $question->randomQuestion($p);
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
            if ($partie->getJoueurEnCours() == $partie->getJoueur1() ){
                $score->incNbManches();
                $idJoueur1= $partie->getJoueur1()->getId();
                $scoreVoulu = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur1 . "'");
                $nbManches = $score->getNbManches();
                $scoreVoulu->setNbManches($nbManches);
                DAO::update($scoreVoulu);



            }
            DAO::update($score);

            if($score->getNbManches() ==25){
                $partie->setPartieFini("1");
                DAO::update($partie);
                $couronneJ1 = DAO::getAll("Couronne","idJoueur='".$idJoueur."' AND idPartie= '".$p[0]."'");
                $couronneJ2 = DAO::getAll("Couronne","idJoueur='".$idJoueur1."' AND idPartie= '".$p[0]."'");
                $scoreJ1 = DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur . "'");
                $scoreJ2= DAO::getOne("Score", "idPartie = '" . $p[0] . "' AND idJoueur = '" . $idJoueur1 . "'");



                if (sizeof($couronneJ1)>sizeof($couronneJ2)) {
                    $scoreJ1->setGagne("1");
                    echo JsUtils::execute('alert("Vous avez gagné, vous avez plus de couronne !")');

                }
                elseif(sizeof($couronneJ1)<sizeof($couronneJ2)){
                    $scoreJ2->setGagne("1");
                    echo JsUtils::execute('alert("Vous avez perdu votre adversaire à plus de couronne !")');
                }
                elseif(sizeof($couronneJ1)==sizeof($couronneJ2)){
                    if($scoreJ1->getNbBonnesReponses()>$scoreJ2->getNbBonnesReponses()){
                        echo JsUtils::execute('alert("Vous avez gagné car vous avez le meilleur nombre de bonnes réponses !")');
                        $scoreJ1->setGagne("1");

                    }
                    elseif ($scoreJ1->getNbBonnesReponses()==$scoreJ2->getNbBonnesReponses()){
                        $scoreJ2->setEgalite("1");
                        $scoreJ1->setEgalite("1");
                        echo JsUtils::execute('alert("Egalité !")');
                    }
                    else{
                        $scoreJ2->setGagne("1");
                        echo JsUtils::execute('alert("Vous avez perdu!")');
                    }

                }
                DAO::update($scoreJ1);
                DAO::update($scoreJ2);

                echo JsUtils::execute('window.location = " /trivia/CJoueur"');

            }
            else{
                // Mauvaise reponse -> retour au menu, changement JoueurEnCours
                echo JsUtils::execute('alert("Mauvaise réponse, à l autre joueur de jouer ! ")');
                echo JsUtils::execute('window.location = " /trivia/CJoueur"');
                //->changementJoueurEnCours();

            }






        }}

        //        $idJoueur = $_SESSION['joueur1']->getId();

        public function ajoutQuestion() {
            $idJoueur = $_SESSION["joueur1"]->getId();
            var_dump($idJoueur);
            $question=new Question();
            RequestUtils::setValuesToObject($question);
            $domaine=DAO::getOne("Domaine", $_POST["idQuestion"]);
            var_dump($domaine);
            $question->setDomaine($domaine->getId());
            $question->setJoueur($idJoueur);
            DAO::insert($question);
            if(DAO::insert($question)==1)
                echo "Nouvelle question " . $question->getLibelle() . " ajoutée avec succès";
            else
                echo "Erreur. Impossible d'ajouter cette nouvelle question.";
        }

    //}

} 