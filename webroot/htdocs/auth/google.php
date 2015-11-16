<?php
require_once __DIR__ . '/../config.inc.php';

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . filter_input(INPUT_SERVER, 'PHP_SELF');    // Текущая страница скрипта

$app_id     = '34060840310-oj35q4tdb0at0atdshh6a7evsaoq4va4.apps.googleusercontent.com';
$app_secret = 'GOKJ1oYRUmp2B-gYov5lAmmb';
$auth_url = 'https://accounts.google.com/o/oauth2/auth';
$params = array(
    'redirect_uri'  => $current_url,
    'response_type' => 'code',
    'client_id'     => $app_id,
    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
);
$auth_link = $auth_url . '?' . urldecode(http_build_query($params));

if (session_id() == '') session_start();
$contest = filter_input(INPUT_GET, 'contest');
if (!is_null($contest)) {
    $_SESSION['contest'] = true;
}

$auth = filter_input(INPUT_GET, 'auth');
if (!is_null($auth)) {
    header("Location: $auth_link" );
    exit;
}

$code = filter_input(INPUT_GET, 'code');
if (!is_null($code)) {
    $_SESSION['user'] = array();

    $params = array(
        'client_id'     => $app_id,
        'client_secret' => $app_secret,
        'redirect_uri'  => $current_url,
        'grant_type'    => 'authorization_code',
        'code'          => $code
    );
    $url = 'https://accounts.google.com/o/oauth2/token';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = json_decode($result, true);
    
    if (isset($tokenInfo['access_token'])) {
        $params['access_token'] = $tokenInfo['access_token'];
        $url = 'https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        $userInfo = json_decode($result, true);
        if (isset($userInfo['id'])) {
            if (session_id() == '') session_start();
            $_SESSION['auth'] = array();
            $_SESSION['auth']['type'] = 'gl';
            $_SESSION['auth']['id'] = $userInfo['id'];
            $_SESSION['auth']['name'] = $userInfo['name'];
            $_SESSION['auth']['email'] = $userInfo['email'];
            $_SESSION['auth']['picture'] = $userInfo['picture'];
        }
    }
}
if (isset($_SESSION['contest']) && $_SESSION['contest']) {
    if (isset($_SESSION['auth']) && isset($_SESSION['auth']['type']) && isset($_SESSION['auth']['id'])) {
        $query = "SELECT `id`, `password` FROM `user` WHERE `type` = '%s' AND `social_id` = '%s'";
        $query = sprintf($query,
            mysql_real_escape_string($_SESSION['auth']['type']),
            mysql_real_escape_string($_SESSION['auth']['id']));
        $result = mysql_query($query);
        if ($row = mysql_fetch_assoc($result)) {
            $cur_password = crypt($_SESSION['auth']['id'], SALT);
            if ($cur_password == $row['password']) {
                $_SESSION['login']['id'] = $row['id'];
            }
        }
        mysql_free_result($result);
    }
    $_SESSION['contest'] = false;
    header("Location: /contest.php?user=".$_SESSION['login']['id']);
    exit;
}
header("Location: /" );
exit;
