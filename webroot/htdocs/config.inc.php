<?php
define('TEST_SITE', false);
define('SALT', '***SET_ME***');

define('POINTS_RIGHT_ANSWER', 100);    // Количество баллов за правильный ответ

// Подключение к базе данных
if (TEST_SITE) {
    $mysql = @mysql_connect( '127.0.0.1', '***SET_ME***', '***SET_ME***') or die('Could not connect to server.' );
    @mysql_select_db('***SET_ME***', $mysql) or die('Could not select database.');
} else {
    @$mysql = mysql_connect( '127.0.0.1', '***SET_ME***', '***SET_ME***') or die('Could not connect to server.' );;
    @mysql_select_db('***SET_ME***', $mysql) or die('Could not select database.');
}
@mysql_set_charset('utf8', $mysql );

if (TEST_SITE) {
    set_include_path(get_include_path().':'.$_SERVER['DOCUMENT_ROOT'].'/libs/pear');
} else {
    set_include_path(get_include_path().':/var/www/specialproject/mcdonalds.timeout.ru/libs/pear');
}
require_once __DIR__ . '/functions.inc.php';

$cookie = _get_client_ip2(); 
setcookie("user", $cookie, time()+2592000, '/');  // 1 месяц

function _get_client_ip2() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}
