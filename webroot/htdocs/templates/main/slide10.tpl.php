<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 10;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 3) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city9';
$class1 = 'block_10 town_screen slide';
$trigger1 = 'trigger_9';

$author1 = 'Виктория Плеханова';
$info1 = '30, визажист';
$fact1 = 'Берлину в Европе принадлежит рекорд по количеству животных в зоопарке. Интересно, что в городе их построено сразу два. Самый известный — Zoologischer Garten — ведет 150-летнюю историю, в начале XX века он считался крупнейшим в мире.';
$img1 = 'img/Berlin.png';
$expert1 = 'img/experts/Берлин.png';
$name1 = 'Берлин';
$q_1 = 'Как первоначально назывались Бранденбургские ворота?';
$a_1 = '«Ворота мира»';
$a_2 = '«Ворота света»';
$a_3 = '«Вторые ворота»';

$q1 = 'q9';
$checkbox1 = 'checkbox25';
$checkbox2 = 'checkbox26';
$checkbox3 = 'checkbox27';
$answer1 = 'answer9';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/08.png">Лук резаный красный</h4><div class="sub_title">Поставщик - компания "Белая Дача”, г.Котельники МО</div><p>Свежий, красный лук, богатый витамином С</p>');
</script>
