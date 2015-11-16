<section id="<?=$city1?>" class="<?=$class1?>">
    <div class="border">
        <div class="container">
            <div class="<?=$trigger1?>"></div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 town_photo">
                    <div class="img"><img src="<?=$img1?>" alt=""></div>
                    <div class="town_title">
                        <img src="img/Floral.png" alt="">
                        <?=$name1?>
                        <img src="img/Floral_2.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 col-md-offset-1 author">
                        <img src="<?=$expert1?>" alt="">
                </div>
                <div class="col-md-4 col-sm-6 esse">
                    <span><?=$author1?></span>
                    <div class="info"><?=$info1;?></div>
                    <p><?=$fact1?></p>
                </div>
                <div class="col-md-4 col-md-offset-1 col-sm-6 question">
                    <div class="q_text"><?=$q_1?></div>
                    <input type="radio" name="<?=$q1?>" class="checkbox" id="<?=$checkbox1?>" value="1" />
                    <label for="<?=$checkbox1?>"><?=$a_1?></label>
                    <br>
                    <input type="radio" name="<?=$q1?>" class="checkbox" id="<?=$checkbox2?>" value="2" />
                    <label for="<?=$checkbox2?>"><?=$a_2?></label>
                    <br>
                    <input type="radio" name="<?=$q1?>" class="checkbox" id="<?=$checkbox3?>" value="3" />
                    <label for="<?=$checkbox3?>"><?=$a_3?></label>
                    <button id="<?=$answer1?>" class="btn answer"></button>
                </div>
                <div class="row">
                    <div class="social_2 col-xs-12 text-center visible-xxs">
                        <ul>
                            <li><a href="" id="vk_2" class="vk-globalshare"></a></li>
                            <li><a href="" id="fb_2" class="fb-globalshare"></a></li>
                            <li><a href="" id="ok_2" class="ok-globalshare"></a></li>
                            <li><a href="" id="tw_2" class="tw-globalshare"></a></li>
                            <!-- <li><a href="" id="gl"></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('#<?=$answer1?>').on('click', function() { load_next_slide("<?=$q1?>"); return false; });
</script>
