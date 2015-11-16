<?php
require_once __DIR__ . '/../config.inc.php';

define('URL_SEPARATOR', '&');

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . filter_input(INPUT_SERVER, 'PHP_SELF');    // Текущая страница скрипта

$app_id     = 'mn6TzFAz2mmysJaLFCp62poPG';
$app_secret = '5cIIcKVD3OxWCvkA3LslyqimR3kYzFJfwBr6iXyrcMmYjNkCig';

if (session_id() == '') session_start();
$contest = filter_input(INPUT_GET, 'contest');
if (!is_null($contest)) {
    $_SESSION['contest'] = true;
}

$auth = filter_input(INPUT_GET, 'auth');
if (!is_null($auth)) {
    $oauth_nonce = md5(uniqid(rand(), true));
    $oauth_timestamp = time();
    $params = array(
        'oauth_callback=' . urlencode($current_url) . URL_SEPARATOR,
        'oauth_consumer_key=' . $app_id . URL_SEPARATOR,
        'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
        'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
        'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
        'oauth_version=1.0'
    );
    $oauth_base_text = implode('', array_map('urlencode', $params));
    $key = $app_secret . URL_SEPARATOR;
    $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode('https://api.twitter.com/oauth/request_token') . URL_SEPARATOR . $oauth_base_text;
    $oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));

    // получаем токен запроса
    $params = array(
        URL_SEPARATOR . 'oauth_consumer_key=' . $app_id,
        'oauth_nonce=' . $oauth_nonce,
        'oauth_signature=' . urlencode($oauth_signature),
        'oauth_signature_method=HMAC-SHA1',
        'oauth_timestamp=' . $oauth_timestamp,
        'oauth_version=1.0'
    );
    $url = 'https://api.twitter.com/oauth/request_token' . '?oauth_callback=' . urlencode($current_url) . implode('&', $params);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = null;
    parse_str($result, $tokenInfo);
    if (count($tokenInfo) > 0 && isset($tokenInfo['oauth_token'])) {
        $oauth_token        = $tokenInfo['oauth_token'];
        $oauth_token_secret = $tokenInfo['oauth_token_secret'];
        $auth_link = 'https://api.twitter.com/oauth/authorize' . '?oauth_token=' . $oauth_token;
        header("Location: $auth_link" );
        exit;
    }
}

$oauth_token = filter_input(INPUT_GET, 'oauth_token');
$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');
if (!is_null($oauth_token) && !is_null($oauth_verifier)) {
    $oauth_nonce = md5(uniqid(rand(), true));
    $oauth_timestamp = time();

    $oauth_base_text = "GET&";
    $oauth_base_text .= urlencode('https://api.twitter.com/oauth/access_token')."&";

    $params = array(
        'oauth_consumer_key=' . $app_id . URL_SEPARATOR,
        'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
        'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
        'oauth_token=' . $oauth_token . URL_SEPARATOR,
        'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
        'oauth_verifier=' . $oauth_verifier . URL_SEPARATOR,
        'oauth_version=1.0'
    );
    
    //$key = $app_secret . URL_SEPARATOR . $oauth_token_secret;
    $key = $app_secret;
    $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode('https://api.twitter.com/oauth/access_token') . URL_SEPARATOR . implode('', array_map('urlencode', $params));
    $oauth_signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

    // получаем токен доступа
    $params = array(
        'oauth_nonce=' . $oauth_nonce,
        'oauth_signature_method=HMAC-SHA1',
        'oauth_timestamp=' . $oauth_timestamp,
        'oauth_consumer_key=' . $app_id,
        'oauth_token=' . urlencode($oauth_token),
        'oauth_verifier=' . urlencode($oauth_verifier),
        'oauth_signature=' . urlencode($oauth_signature),
        'oauth_version=1.0'
    );
    $url = 'https://api.twitter.com/oauth/access_token' . '?' . implode('&', $params);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = null;
    parse_str($result, $tokenInfo);
    
    if (count($tokenInfo) > 0 && isset($tokenInfo['oauth_token'])) {
        // формируем подпись для следующего запроса
        $oauth_nonce = md5(uniqid(rand(), true));
        $oauth_timestamp = time();

        $oauth_token = $tokenInfo['oauth_token'];
        $oauth_token_secret = $tokenInfo['oauth_token_secret'];
        $screen_name = $tokenInfo['screen_name'];
        
        $params = array(
            'oauth_consumer_key=' . $app_id . URL_SEPARATOR,
            'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
            'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
            'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
            'oauth_token=' . $oauth_token . URL_SEPARATOR,
            'oauth_version=1.0' . URL_SEPARATOR,
            'screen_name=' . $screen_name
        );
        $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode('https://api.twitter.com/1.1/users/show.json') . URL_SEPARATOR . implode('', array_map('urlencode', $params));
        $key = $app_secret . '&' . $oauth_token_secret;
        $signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));
        // получаем данные о пользователе
        $params = array(
            'oauth_consumer_key=' . $app_id,
            'oauth_nonce=' . $oauth_nonce,
            'oauth_signature=' . urlencode($signature),
            'oauth_signature_method=HMAC-SHA1',
            'oauth_timestamp=' . $oauth_timestamp,
            'oauth_token=' . urlencode($oauth_token),
            'oauth_version=1.0',
            'screen_name=' . $screen_name
        );
        $url = 'https://api.twitter.com/1.1/users/show.json' . '?' . implode(URL_SEPARATOR, $params);

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
            $_SESSION['auth']['type'] = 'tw';
            $_SESSION['auth']['id'] = $userInfo['id'];
            $_SESSION['auth']['name'] = $userInfo['name'];
            $_SESSION['auth']['email'] = null;
            $_SESSION['auth']['picture'] = $userInfo['profile_image_url'];
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
