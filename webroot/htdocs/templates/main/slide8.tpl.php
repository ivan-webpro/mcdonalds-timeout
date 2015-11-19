<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 8;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 2) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city7';
$class1 = 'block_8 town_screen slide';
$trigger1 = 'trigger_7';

$author1 = 'Александр Белов';
$info1 = '24, футбольный болельщик';
$fact1 = '«Котельники» - последняя новая станция метрополитена, построенная в Москве. Первый поезд с пассажирами отправился 21 сентября 2015 года.';
$img1 = 'img/IceCastle.png';
$expert1 = 'img/experts/Котельники.png';
$name1 = 'Котельники';
$q_1 = 'Какой микрорайон не имеет отношения к Котельникам?';
$a_1 = '«Белая дача»';
$a_2 = '«Южный»';
$a_3 = '«Северный»';

$q1 = 'q7';
$checkbox1 = 'checkbox19';
$checkbox2 = 'checkbox20';
$checkbox3 = 'checkbox21';
$answer1 = 'answer7';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/06-2.png">Сыр плавленый </h4><div class="sub_title">Поставщик - ООО "Хохланд Русланд”<br> Раменский район, МО</div><p>Для  приготовления данного сандвича Макдоналдс использует плавленый сыр, приготовленный из молока, без искусственных красителей и ароматизаторов.</p>');
</script>
