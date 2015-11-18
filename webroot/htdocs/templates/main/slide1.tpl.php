<?php
if (session_id() == '') session_start();
$_SESSION['game'] = array();
$_SESSION['game']['slide'] = 1;
$_SESSION['game']['answer'] = 0;
?>
<section class="block_1 text-center slide">
    <div class="block_1_bg"></div>
    <div class="container">
        <div class="row">
            <?php $menu_points = true; include __DIR__ . '/../menu/menu.tpl.php'; ?>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 title">
                <h2>ВКУСНАЯ ГЕОГРАФИЯ</h2>
                <div class="sub_title">ОТВЕТЬ НА ВОПРОСЫ И СОБЕРИ САНДВИЧ</div>
                <p>Узнай интересные факты о шести городах, в которых производят ингредиенты для нового сандвича «Стейк Хаус Классик». Ответь на вопросы викторины, поделись фактом о любимом городе и выиграй бесплатный обед в «Макдоналдс» для себя и твоих друзей.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center rules">
                <div class="icons">
                    <img src="img/icon_1.png" alt="">
                    <span>Ответь <br>на вопросы</span>
                </div>
                <div class="icons"><img src="img/arrow.png" alt=""></div>
                <div class="icons">
                    <img src="img/icon_2.png" alt="">
                    <span>напиши факт <br>о своём городе</span>
                </div>
                <div class="icons"><img src="img/arrow.png" alt=""></div>
                <div class="icons">
                    <img src="img/icon_3.png" alt="">
                    <span>Зови друзей <br>голосовать за тебя</span>
                </div>
                <div class="icons"><img src="img/arrow.png" alt=""></div>
                <div class="icons">
                    <img src="img/Apple_watch.png" alt="">
                    <span>Выиграй<br>Apple Watch</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn participate start"></button>
                <div class="scroll_down visible-lg"><img src="img/scroll_down.png" alt=""></div>
                <div class="social_2 hidden-lg">
                    <ul>
                        <li><a href="" id="vk_2" class="vk-globalshare"></a></li>
                        <li><a href="" id="fb_2" class="fb-globalshare"></a></li>
                        <li><a href="" id="ok_2" class="ok-globalshare""></a></li>
                        <li><a href="" id="tw_2" class="tw-globalshare""></a></li>
                        <!-- <li><a href="" id="gl"></a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (isset($_SESSION['login']) && isset($_SESSION['login']['id'])) : ?>
<script>var product = false; var start2 = <?=$_SESSION['login']['id']?>;</script>
<?php else : ?>
<script>var product = false; var start2 = false;</script>
<?php endif; ?>
<script>
$(document).ready(function(){
    if (window.location.hash === '#play') {
	if (!start2) {
	        trigger_start = true;
	        $("#modal_1").modal("show");
	        load_next_slide("q0");
	} else {
		location.href = '/contest.php?user='+start2;
        	 return false;
	}
    }
});
</script>
