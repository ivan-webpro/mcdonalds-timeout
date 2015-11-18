<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 2;
$_SESSION['game']['answer'] = 0;

$city1 = 'city1';
$class1 = 'block_2 town_screen dummy slide';
$trigger1 = 'trigger_1';

$author1 = 'Анатолий Фролов';
$info1 = '24 года, учитель русского языка';
$fact1 = 'В 1960 году улицы в каждом из районов Москвы получили «тематические» названия. На юго-западе их называли в честь академиков — Волгина, Анохина, Вернадского. А на северо-западе преобладала небесная тематика: Авиационный переулок, улицы Планерная, Аэропортовская.';
$img1 = 'img/Moscow.png';
$expert1 = 'img/experts/Москва.png';
$name1 = 'Москва';
$q_1 = 'В каком году в Москве появился первый лифт? ';
$a_1 = '1899';
$a_2 = '1901';
$a_3 = '1929';

$q1 = 'q1';
$checkbox1 = 'checkbox1';
$checkbox2 = 'checkbox2';
$checkbox3 = 'checkbox3';
$answer1 = 'answer1';
include __DIR__ . '/slide.tpl.php';
?>
