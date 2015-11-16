<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 5;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 2) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city4';
$class1 = 'block_5 town_screen slide';
$trigger1 = 'trigger_4';

$author1 = 'Юлия Кузнецова';
$info1 = '28 лет, актриса';
$fact1 = 'С XVIII века село Ново-Троицкое (нынешнее Раменское) упоминалось как один из центров ткацкого дела. Текстильная фабрика, построенная в 1831 году, вплоть до революции была одним из крупнейших текстильных предприятий России. ';
$img1 = 'img/Раменское.png';
$expert1 = 'img/experts/Раменское.png';
$name1 = 'Раменское';
$q_1 = 'Как называется футбольный клуб города Раменское?';
$a_1 = '«Метеор»';
$a_2 = '«Фортуна»';
$a_3 = '«Сатурн»';

$q1 = 'q4';
$checkbox1 = 'checkbox10';
$checkbox2 = 'checkbox11';
$checkbox3 = 'checkbox12';
$answer1 = 'answer4';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/03.png">Полуфабрикаты мясные рубленые</h4><div class="sub_title">Поставщик  - ООО "МАРР РУССИЯ”, Одинцово</div><p>Мясная котлета состоит  из  100% говядины, без каких-либо добавок и примесей. Для приготовления мясных полуфабрикатов поставщик использует только высококачественное бескостное мышечное мясо передней и задней четвертины и всегда отслеживают источники его происхождения.<br/>В ресторане мясные полуфабрикаты доготавливаются в двустороннем гриле, без масла, только соль и перец после жарки.</p><br><div class="video"><video preload="" controls="" style="display: inline;"><source src="/upload/video/Мясной полуфабрикат.mp4"></video></div>');
</script>
