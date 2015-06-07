<br><br>
    <form id="frmScore" name="frmScore" class="score">
             <?php //var_dump($data)?>
            <TABLE width="100%">

                <TR>
                    <TH> Manche N° <?php echo $data["scoreJ1"]->getNbManches();?></TH>
                    <TH> Réponses successives : <br>  <div id="verte"><?php echo $data["scoreJ1"]->getRepSuccessives();?></div>  </TH>
                    <TH> Bonnes réponses : <br>Vous : <div id="verte"><?php echo $data["scoreJ1"]->getNbBonnesReponses();?></div> Votre adversaire : <div id="rouge"><?php  echo $data["scoreJ2"]->getNbBonnesReponses();?></div> </TH>
                    <TH>                    </TH>
                    <TH> Couronnes débloquées : <br> Vous : <div id="verte"><?php echo sizeof($data["couronneJ1"]);?> </div> Votre adversaire : <div id="rouge"><?php echo sizeof($data["couronneJ2"]);?></div></TH>
                </TR>

            </TABLE>




    </form>
