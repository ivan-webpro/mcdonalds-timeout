<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 2;
$_SESSION['game']['answer'] = 0;

$city1 = 'city1';
$class1 = 'block_2 town_screen dummy slide';
$trigger1 = 'trigger_1';

$author1 = 'Анатолий Фролов';
$info1 = '24 года, учитель русского языка';
$fact1 = 'В 1960 году улицы в каждом из районов Москвы получили «тематические» названия. Например, на юго-западе их называли в честь академиков — Волгина, Анохина, Вернадского, а в районе станции метро «Аэропорт» преобладает космическая тематика.';
$img1 = 'img/Moscow.png';
$expert1 = 'img/experts/Москва.png';
$name1 = 'Москва';
$q_1 = 'Сколько лет Успенскому собору?';
$a_1 = '535';
$a_2 = '536';
$a_3 = '539';

$q1 = 'q1';
$checkbox1 = 'checkbox1';
$checkbox2 = 'checkbox2';
$checkbox3 = 'checkbox3';
$answer1 = 'answer1';
include __DIR__ . '/slide.tpl.php';
?>
