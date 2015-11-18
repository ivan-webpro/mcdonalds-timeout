<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 4;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 3) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city3';
$class1 = 'block_4 town_screen slide';
$trigger1 = 'trigger_3';

$author1 = 'Владимир Романов (Abro)';
$info1 = '26 лет, рэпер';
$fact1 = 'В 1986 году на Можайском шоссе заработал гастроном «Дубрава» – советский прообраз нынешних гипермаркетов. Помимо просторных залов, в гастрономе располагались кафетерий, детский зал, и даже действовал принцип самообслуживания.';
$img1 = 'img/Odinec.png';
$expert1 = 'img/experts/Одинцово.png';
$name1 = 'Одинцово';
$q_1 = 'Какой поэт жил на даче в Одинцово в 1891-1892 годах?';
$a_1 = 'Афанасий Фет';
$a_2 = 'Валерий Брюсов';
$a_3 = 'Андрей Белый';

$q1 = 'q3';
$checkbox1 = 'checkbox7';
$checkbox2 = 'checkbox8';
$checkbox3 = 'checkbox9';
$answer1 = 'answer3';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/02.png">Бекон порционный</h4><div class="sub_title">Поставщик -  ITALIA ALIMENTARI S.P.A <br> Италия</div><p>Натуральный, копченый бекон.</p>');
</script>
