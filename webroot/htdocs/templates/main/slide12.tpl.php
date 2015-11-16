<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 12;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 1) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}
?>
<section class="block_12 town_screen slide">
    <div class="border">
        <div class="trigger_12"></div>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 title">
                    <h2>Поздравляем!</h2>
                    <div class="sub_title">Ты отлично ответил на наши вопросы</div>
                    <p>Напиши интересный факт о своем городе, и сразу после публикации ты получишь 
                    <br class="visible-lg">7 баллов. Когда мы его одобрим, мы вышлем тебе сообщение на почту</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 scores">
                    <p><img src="img/line_1.png"> У вас <img src="img/line_2.png"></p>
                    <span><img src="img/Floral_3.png" alt=""><span id="final_points"></span><img src="img/Floral_4.png" alt=""></span>
                    <p><img src="img/line_3.png"> баллов <img src="img/line_4.png"></p>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-8 col-md-offset-2 burger12"><img src="img/BurgerChalk.png" alt=""></div>
            <div class="trigger_7"></div>
            </div>
        </div>
    </div>
</section>
<script>
    $('.block_12').viewportChecker({
        classToAdd: 'visible',
        callbackFunction: function(elem, action){
            setTimeout(function() { load_next_slide("q0"); }, 1000);
        }
    });
</script>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/01.png">Булочка</h4><div class="sub_title">Поставщик - ООО "Ист Болт Рус”, Москва</div><p>В пекарне Ист Болт Рус используется пшеничная мука высшего сорта, которая производится на предприятии ОАО «Рязаньзернопродукт».</p><br><div class="video"><video preload="" controls="" style="display: inline;"><source src="/upload/video/Булочка.mp4"></video></div>');
</script>
