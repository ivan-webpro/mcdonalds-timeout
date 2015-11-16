<?php
require_once __DIR__ . '/../config.inc.php';

if (session_id() == '') session_start();
$response = array("error" => true);
ob_start();

$id = filter_input(INPUT_POST, 'id');
$ip = _get_client_ip();

if (isset($_SESSION['login']) && isset($_SESSION['login']['id'])) {
    $ip = 'user'.$_SESSION['login']['id'];
}
if ($id && $ip) {
    $query = "INSERT INTO `like` (`user_id`, `date`, `datetime`, `ip`, `points`) VALUES ('%s', NOW(), NOW(), '%s', 10)";
    $query = sprintf($query,
            mysql_real_escape_string($id),
            mysql_real_escape_string($ip));
    mysql_query($query, $mysql);
    $insert_id = mysql_insert_id($mysql);
    if ($insert_id) {
        $query = "SELECT (`user`.`points` + `user`.`points2` + COALESCE((SELECT SUM(`points`) FROM `share` WHERE `user_id` = `user`.`id`),0)"
            . " + COALESCE((SELECT SUM(`points`) FROM `like` WHERE `user_id` = `user`.`id`),0)) as `points`"
            . " FROM `user` "
            . " WHERE `id` = '%s'";
        $query = sprintf($query,
            mysql_real_escape_string($id));
        $result = mysql_query($query);
        if ($row = mysql_fetch_assoc($result)) {
            $response = array("error" => false, 'id' => $insert_id, 'points' => $row['points']);
        }
        mysql_free_result($result);
    }
}


ob_end_clean();
print json_encode($response);


function _get_client_ip() {
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
