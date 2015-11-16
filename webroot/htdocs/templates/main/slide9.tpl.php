<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 9;
$_SESSION['game']['correct'] = false;
$a = filter_input(INPUT_GET, 'a', FILTER_VALIDATE_INT);
if ($a === 3) {
    $_SESSION['game']['answer'] += POINTS_RIGHT_ANSWER;
    $_SESSION['game']['correct'] = true;
}

$city1 = 'city8';
$class1 = 'block_9 town_screen slide';
$trigger1 = 'trigger_8';

$author1 = 'Александр Белов';
$info1 = '24, футбольный болельщик';
$fact1 = 'Население Котельников постоянно растет. В 1926 году здесь проживали всего 700 человек. К 2015 году эта цифра увеличилась в 500 раз — в городе сейчас живут более 40 тысяч жителей.';
$img1 = 'img/IceCastle.png';
$expert1 = 'img/experts/Котельники.png';
$name1 = 'Котельники';
$q_1 = 'В каком году поселок Котельники получил статус города?';
$a_1 = '1989';
$a_2 = '1992';
$a_3 = '2004';

$q1 = 'q8';
$checkbox1 = 'checkbox22';
$checkbox2 = 'checkbox23';
$checkbox3 = 'checkbox24';
$answer1 = 'answer8';
include __DIR__ . '/slide.tpl.php';
?>
<script>
    $("#modal_2 .text, #modal_3 .text").html('<h4 class="modal-title" id="myModalLabel"><img src="img/popup/07.png">Салат Айсберг мелкой нарезки</h4><div class="sub_title">Поставщик - компания "Белая Дача”, г.Котельники МО</div><p>Кстати,  компания «Макдоналдс» – одна из первых компаний, которая использует в больших объемах салат «Айсберг» для своих сандвичей и салатов. Овощи для сандвичей и салатов в «Макдоналдс» производит компания ЗАО «Белая Дача Трейдинг», которая на протяжении 20 лет является основным поставщиком в России.</p><br><div class="video"><video preload="" controls="" style="display: inline;"><source src="/upload/video/Салат.mp4"></video></div>');
</script>
