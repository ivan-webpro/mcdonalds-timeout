<?php
require_once __DIR__ . '/../config.inc.php';

if (session_id() == '') session_start();
$response = array("error" => true);
ob_start();

$success = true;
$text = filter_input(INPUT_POST, 'text');

if (mb_strlen($text, 'utf8') > 2000) {
    $success = false;
    $response['text'] = 'Факт о городе не должен быть длинее 2000 символов';
}
if (mb_strlen($text, 'utf8') < 200) {
    $success = false;
    $response['text'] = 'Факт о городе не должен быть короче 200 символов';
}

if ($success) {
    if (isset($_SESSION['login']) && isset($_SESSION['login']['id'])) {
        $query = sprintf("SELECT `email` FROM `user` WHERE `id` = '%s'",
                mysql_real_escape_string($_SESSION['login']['id']));
        $result = mysql_query($query);
        $email = null;
        if ($row = mysql_fetch_assoc($result)) {
            $email = $row['email'];
        }
        mysql_free_result($result);
        
        $query = sprintf("UPDATE `user` SET `text` = '%s', `status` = 0, `modify` = NOW(), `moderated_time` = NULL WHERE `id` = '%s'",
                mysql_real_escape_string($text),
                mysql_real_escape_string($_SESSION['login']['id']));
        if (mysql_query($query, $mysql)) {
            if (!empty($text) && !empty($email)) {
                send_email($email, 0, $_SESSION['login']['id']);
            }
            $response = array('error' => false);
        }
    }
}

ob_end_clean();
print json_encode($response);
