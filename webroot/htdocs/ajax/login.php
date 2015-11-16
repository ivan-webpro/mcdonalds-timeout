<?php
require_once __DIR__ . '/../config.inc.php';

if (session_id() == '') session_start();
$response = array("error" => true);
ob_start();

$success = true;
$type = 'mn';
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

if (!is_null($email) && !is_null($password)) {
    $query = "SELECT `id`, `password` FROM `user` WHERE `email` = '%s' AND`type` = 'mn'";
    $query = sprintf($query,
        mysql_real_escape_string($email));
    $result = mysql_query($query);
    if ($row = mysql_fetch_assoc($result)) {
        $cur_password = crypt($password, SALT);
        if ($cur_password == $row['password']) {
            $_SESSION['login']['id'] = $row['id'];
            $response = array('error' => false, 'id' => $_SESSION['login']['id']);
        }
    }
    mysql_free_result($result);
}

ob_end_clean();
print json_encode($response);
