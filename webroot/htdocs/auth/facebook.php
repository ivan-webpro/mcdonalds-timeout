<?php
require_once __DIR__ . '/../config.inc.php';

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . filter_input(INPUT_SERVER, 'PHP_SELF');    // Текущая страница скрипта

$app_id     = '1607478269517815';
$app_secret = 'a09c179c3507af7bf404095b9084ee31';
$auth_url   = 'https://www.facebook.com/dialog/oauth';
$params = array(
    'client_id'     => $app_id,
    'redirect_uri'  => $current_url,
    'response_type' => 'code',
    'scope'         => 'email,public_profile'
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

    $token_params = array(
        'client_id'     => $app_id,
        'redirect_uri'  => $current_url,
        'client_secret' => $app_secret,
        'code'          => $code,
        'scope'         => ''
    );
    $url = 'https://graph.facebook.com/oauth/access_token' . '?' . urldecode(http_build_query($token_params));
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = null;
    parse_str($result, $tokenInfo);
    if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
        $params = array('access_token' => $tokenInfo['access_token'], 'type' => 'large');
        $url = 'https://graph.facebook.com/me?fields=id,email,gender,name&' . urldecode(http_build_query($params));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        $userInfo = json_decode($result, true);
        if (isset($userInfo['id'])) {
            $picture = 'https://graph.facebook.com/'.$userInfo['id'].'/picture?type=large';
            if (session_id() == '') session_start();
            $_SESSION['auth'] = array();
            $_SESSION['auth']['type'] = 'fb';
            $_SESSION['auth']['id'] = $userInfo['id'];
            $_SESSION['auth']['name'] = $userInfo['name'];
            $_SESSION['auth']['email'] = $userInfo['email'];
            $_SESSION['auth']['picture'] = $picture;
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
header("Location: / " );
exit;
