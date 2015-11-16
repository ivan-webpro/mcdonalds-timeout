<?php
define('TEST_SITE', true);
define('SALT', '***SET_ME***');

define('POINTS_RIGHT_ANSWER', 100);    // Количество баллов за правильный ответ

// Подключение к базе данных
if (TEST_SITE) {
    $mysql = @mysql_connect( '127.0.0.1', '***SET_ME***', '***SET_ME***') or die('Could not connect to server.' );
    @mysql_select_db('mcdonalds', $mysql) or die('Could not select database.');
} else {
    @$mysql = mysql_connect( '127.0.0.1', '***SET_ME***', '***SET_ME***') or die('Could not connect to server.' );;
    @mysql_select_db('external_mcdonalds', $mysql) or die('Could not select database.');
}
@mysql_set_charset('utf8', $mysql );

if (TEST_SITE) {
    set_include_path(get_include_path().':'.$_SERVER['DOCUMENT_ROOT'].'/libs/pear');
} else {
    set_include_path(get_include_path().':/var/www/specialproject/mcdonalds.timeout.ru/libs/pear');
}
require_once __DIR__ . '/functions.inc.php';
