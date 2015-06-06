<br><br>
<div align="center" id="contain">
    <div class="container">
        <div class="row">
            <div class="span4">
                <div class="roulette_container" >
                    <div id="roulette" class="roulette" style="display:none;">

                        <?php
                        $i=0;
                        foreach ($data as $domaine){
                            echo'<img data-value="'.$i.'" class="e" id="'.$domaine->getIcon().'" src="/trivia/images/'.$domaine->getIcon().'"/>';
                            if($domaine->getId() == $_SESSION['domaine']->getId()){
                                $value= $i;
                            }
                            $i++;
                        }
                        ?>
                    </div>
                </div>
                <div class="btn_container">
                    <p>
                        <button class="btn btn-large btn-primary start"> START </button>
                    </p>
                </div>
                <div align="center" id="divBouton"><input type="button" class="btnQuest" value="Afficher Question" id="question"></div>
            </div>

            <div id="speed" style="display:none;"></div>

            <!--<span class="param_name">stop image number :</span> <span class="stop_image_number_param"></span>-->

            <input id="stopImageNumber" name="stopImageNumber" style="display:none;"/>
				<span class="image_sample" style="display:none;">
					<input id="mage" value="<?php echo $value; ?>" />
				</span>
        </div>
			<pre style="display:none">

				var option = {
					speed : <span class="speed_param"></span>,
					duration : <span class="duration_param"></span>,
					stopImageNumber : <span class="stop_image_number_param"></span>,
					startCallback : function() {
						console.log('start');
					},
					slowDownCallback : function() {
						console.log('slowDown');
					},
					stopCallback : function($stopElm) {
						console.log('stop');
					}
				}
				$('div.roulette').roulette(option);
			</pre>

    </div>
</div>
</div>
<script src="<?php echo $GLOBALS["siteUrl"]?>js/1.8.0jquery.min.js"></script>
<script src="<?php echo $GLOBALS["siteUrl"]?>js/1.9.0jquery-ui.min.js"></script>
<script src="<?php echo $GLOBALS["siteUrl"]?>js/roulette.js"></script>
<script src="<?php echo $GLOBALS["siteUrl"]?>js/demo.js"></script>





