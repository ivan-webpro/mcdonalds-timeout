<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 3;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 1) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city2';
$class1 = 'block_3 town_screen slide';
$trigger1 = 'trigger_2';

$author1 = 'Дарья Ходоровская';
$info1 = '25 лет, журналист';
$fact1 = 'Римская кухня — исторически это кухня бедных, основанная на самых простых и дешевых ингредиентах: бычий хвост, бобовые, паста с сытными соусами. Чтобы попробовать национальную кухню, нужно идти не в ресторан, а в семейную тратторию в отдалении от достопримечательностей.';
$img1 = 'img/Rome.png';
$expert1 = 'img/experts/Рим.png';
$name1 = 'Рим';
$q_1 = 'Какое из этих знаменитых римских творений не относится к эпохе барокко?';
$a_1 = 'Площадь Навона';
$a_2 = 'Церковь Сант-Иньяцио';
$a_3 = 'Палаццо Фарнезе';

$q1 = 'q2';
$checkbox1 = 'checkbox4';
$checkbox2 = 'checkbox5';
$checkbox3 = 'checkbox6';
$answer1 = 'answer2';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/01.png">Булочка</h4><div class="sub_title">Поставщик - ООО "Ист Болт Рус”<br> Москва</div><p>В пекарне Ист Болт Рус используется пшеничная мука высшего сорта, которая производится на предприятии ОАО «Рязаньзернопродукт».</p><br><div class="video"><video preload="" controls="" style="display: inline;" poster="/upload/video/1.png"><source src="/upload/video/Булочка_1.mp4"></video></div>');
</script>
