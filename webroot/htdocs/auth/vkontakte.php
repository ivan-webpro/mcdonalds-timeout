<?php
require_once __DIR__ . '/../config.inc.php';

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . filter_input(INPUT_SERVER, 'PHP_SELF');    // Текущая страница скрипта

$app_id     = '5143789';
$app_secret = '9Hr5d2jKpMg6LtZlzDcH';
$auth_url   = 'http://oauth.vk.com/authorize';
$params = array(
    'client_id'     => $app_id,
    'redirect_uri'  => $current_url,
    'response_type' => 'code',
    'scope'         => 'email',
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
        'client_secret' => $app_secret,
        'code'          => $code,
        'redirect_uri'  => $current_url
    );
    $url = 'https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($token_params));
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $vk_token = json_decode($result, true);
    if (isset($vk_token['access_token'])) {
        $social_email = isset($vk_token['email']) ? $vk_token['email'] : null;
        $params = array(
            'uids'         => $vk_token['user_id'],
            'fields'       => 'uid,first_name,last_name,photo_200,email,sex',
            'access_token' => $vk_token['access_token'],
        );
        $url = 'https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        $userInfo = json_decode($result, true);
        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];
            if (isset($userInfo['uid'])) {
                $picture = $userInfo['photo_200'];
                $name = $userInfo['first_name'].' '.$userInfo['last_name'];
                if (session_id() == '') session_start();
                $_SESSION['auth'] = array();
                $_SESSION['auth']['type'] = 'vk';
                $_SESSION['auth']['id'] = $userInfo['uid'];
                $_SESSION['auth']['name'] = $name;
                $_SESSION['auth']['email'] = $social_email;
                $_SESSION['auth']['picture'] = $picture;
		$_SESSION['login']['social'] = 'vk_'.$userInfo['uid'];
            }
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
	if (isset($_SESSION['login']) && isset($_SESSION['login']['id'])) {
		header("Location: /contest.php?user=".$_SESSION['login']['id']);
	} else {
		header("Location: /contest.php");
	}
    exit;
}
header("Location: /" );
exit;
