<?php
$html_styles[] = '/css/style.css?v=6';
$html_styles[] = '/css/style2.css?v=6';
$html_styles[] = '/css/media.css?v=6';
$html_styles[] = '/css/media2.css?v=6';
$html_scripts[] = '/templates/main/js/scripts.js?v=6';
$html_scripts[] = '/templates/main/js/slides.js?v=6';

$html_metas[] = '<meta property="og:title" content="Расскажи, чем знаменит твой город" />';
$html_metas[] = '<meta property="og:url" content="http://mcdonalds.timeout.ru" />';
$html_metas[] = '<meta property="og:type" content="website" />';
$html_metas[] = '<meta property="og:image" content="http://mcdonalds.timeout.ru/upload/social/SharingOK3.jpg" />';
$html_metas[] = '<link rel="image_src" href="http://mcdonalds.timeout.ru/upload/social/SharingOK3.jpg">';
$html_metas[] = '<meta property="og:image:width" content="548" />';
$html_metas[] = '<meta property="og:image:height" content="343" />';
$html_metas[] = '<meta property="og:description" content="Ответь на вопросы викторины, поделись фактом о любимом городе и выиграй Apple Watch или бесплатный обед в Макдоналдс." />';
$html_metas[] = '<meta name="description" content="Ответь на вопросы викторины, поделись фактом о любимом городе и выиграй Apple Watch или бесплатный обед в Макдоналдс.">';

$active_menu = array(' class="active"', '', '');
?>
<div class="slides">
    <div class="hidden"></div>
<?php
if (session_id() == '') session_start();
if (isset($_SESSION['game']) && isset($_SESSION['game']['slide']) && $_SESSION['game']['slide'] === 13) {
    include __DIR__ . '/slide13.tpl.php';
?>
<script>
var product = false; 
var start2 = false;
$("html,body").animate({scrollTop: $('.orange').offset().top});
$('.burger_fade').removeClass('hidden').addClass('visible_block');
setTimeout(function() {
    $('.form_fade').removeClass('hidden').addClass('visible_block');
}, 1000);
</script>

<?php
} else {
    include __DIR__ . '/slide1.tpl.php';
//
//    include __DIR__ . '/slide2.tpl.php';
//    include __DIR__ . '/slide3.tpl.php';
//    include __DIR__ . '/slide4.tpl.php';
//    include __DIR__ . '/slide5.tpl.php';
//    include __DIR__ . '/slide6.tpl.php';
//    include __DIR__ . '/slide7.tpl.php';
//    include __DIR__ . '/slide8.tpl.php';
//    include __DIR__ . '/slide9.tpl.php';
//    include __DIR__ . '/slide10.tpl.php';
//    include __DIR__ . '/slide11.tpl.php';
//    include __DIR__ . '/slide12.tpl.php';
//    include __DIR__ . '/slide13.tpl.php';
    
    include __DIR__ . '/social.tpl.php';
    include __DIR__ . '/burger.tpl.php';
    include __DIR__ . '/popups.tpl.php';
}
?>
</div>
