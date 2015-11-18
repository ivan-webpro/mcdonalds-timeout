<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 11;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 1) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city10';
$class1 = 'block_11 town_screen slide';
$trigger1 = 'trigger_10';

$author1 = 'Анатолий Фролов';
$info1 = '24 года, учитель русского языка';
$fact1 = 'Российская государственная библиотека – главная в России, и вторая по величине в Европе. В ее фонде – 44 миллиона книг. По количеству посетителей в год и размерам хранилища «Ленинка» уступает только Британской библиотеке.';
$img1 = 'img/MoscwoCity.png';
$expert1 = 'img/experts/Москва.png';
$name1 = 'Москва';
$q_1 = 'Китай-город был назван в честь…';
$a_1 = 'Слова «кита», обозначающего жерди, которые применялись для постройки укреплений';
$a_2 = 'Средневекового района, куда отправили всех азиатов во время опричнины';
$a_3 = 'Единственного магазина, в котором можно было купить изделия из китового уса, ворвани и амбры';

$q1 = 'q10';
$checkbox1 = 'checkbox28';
$checkbox2 = 'checkbox29';
$checkbox3 = 'checkbox30';
$answer1 = 'answer10';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/09.png">Соус томаты-гриль</h4><div class="sub_title">Поставщик -  Develey<br> Германия</div><p>Ни один из соусов для «Макдоналдс» не содержит генномодифицированных продуктов, искусственных красителей и усилителей вкуса.</p>');
</script>
