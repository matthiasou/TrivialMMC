<div class="roulette_container" >
    <div class="roulette" style="display:none;"> <img src="/trivia/images/star.png"/> <img src="/trivia/images/flower.png"/> <img src="/trivia/images/coin.png"/> <img src="/trivia/images/mshroom.png"/> <img src="/trivia/images/chomp.png"/> </div>
</div>
<div class="btn_container">
    <p>
        <button class="btn btn-large btn-primary start"> START </button>
        <button class="stop btn-large btn btn-warning"> STOP </button>
    </p>
</div>
<script>
    var option = {
        speed : 10,
        duration : 3,
        stopImageNumber : 0,
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
</script>