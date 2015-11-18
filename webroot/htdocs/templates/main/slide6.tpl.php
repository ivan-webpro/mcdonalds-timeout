<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 6;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 3) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city5';
$class1 = 'block_6 town_screen slide';
$trigger1 = 'trigger_5';

$author1 = 'Владимир Романов (Abro)';
$info1 = '26 лет, рэпер';
$fact1 = 'Как и многие подмосковные города, Одинцово возник из сельского поселения. Город получил свое название от прозвища боярина Андрея Ивановича Одинца, жившего во второй половине XIV века.';
$img1 = 'img/Odinec.png';
$expert1 = 'img/experts/Одинцово.png';
$name1 = 'Одинцово';
$q_1 = 'Как называется озеро, в котором летом купаются жители Одинцово?';
$a_1 = 'Двойка';
$a_2 = 'Трёха';
$a_3 = 'Червонец';

$q1 = 'q5';
$checkbox1 = 'checkbox13';
$checkbox2 = 'checkbox14';
$checkbox3 = 'checkbox15';
$answer1 = 'answer5';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/04.png">Сыр плавленый</h4><div class="sub_title">Поставщик - ООО "Хохланд Русланд”<br> Раменский район, МО</div><p>Для  приготовления данного сандвича Макдоналдс использует плавленый сыр, приготовленный из молока, без искусственных красителей и ароматизаторов.</p>');
</script>
