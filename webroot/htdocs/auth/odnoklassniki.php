<?php
require_once __DIR__ . '/../config.inc.php';

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . filter_input(INPUT_SERVER, 'PHP_SELF');    // Текущая страница скрипта

$app_id     = '1233707776';
$app_public = 'CBAEOJIKEBABABABA';
$app_secret = '71ED3C598D7E12645792F880';
$auth_url = 'https://connect.ok.ru/oauth/authorize';
$params = array(
    'client_id'     => $app_id,
    'redirect_uri'  => $current_url,
    'response_type' => 'code',
    'scope'         => ''
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
        'code'          => $code,
        'redirect_uri'  => $current_url,
        'grant_type'     => 'authorization_code',
        'client_id'     => $app_id,
        'client_secret' => $app_secret,

    );
    $url = 'https://api.odnoklassniki.ru/oauth/token.do';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); // передаём параметры
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token']) && isset($app_public)) {
        $sign = md5("application_key={$app_public}fields=uid,gender,name,pic_3,emailformat=jsonmethod=users.getCurrentUser" . md5("{$tokenInfo['access_token']}{$app_secret}"));

        $params = array(
            'method' => 'users.getCurrentUser',
            'access_token' => $tokenInfo['access_token'],
            'application_key' => $app_public,
            'format' => 'json',
            'fields' => 'uid,gender,name,pic_3,email',
            'sig' => $sign,
        );
        $userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['uid'])) {
            if (session_id() == '') session_start();
            $_SESSION['auth'] = array();
            $_SESSION['auth']['type'] = 'ok';
            $_SESSION['auth']['id'] = $userInfo['uid'];
            $_SESSION['auth']['name'] = $userInfo['name'];
            $_SESSION['auth']['email'] = null;
            $_SESSION['auth']['picture'] = $userInfo['pic_3'];
            $_SESSION['login']['social'] = 'ok_'.$userInfo['uid'];
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
