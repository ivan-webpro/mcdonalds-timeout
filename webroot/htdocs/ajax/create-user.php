<?php
ob_start();

require_once __DIR__ . '/../config.inc.php';

if (session_id() == '') session_start();
$response = array("error" => true);

$success = true;
if (isset($_SESSION['auth']) && !empty($_SESSION['auth'])) {
    $type = $_SESSION['auth']['type'];
    $social_id = $_SESSION['auth']['id'];
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $password = $_SESSION['auth']['id'];
    $city = filter_input(INPUT_POST, 'city');
    $text = filter_input(INPUT_POST, 'text');
    $file = $_SESSION['auth']['picture'];
    if ($type == 'tw') {
        $file = str_replace('_normal', '_400x400', $file);
    }
    $file = file_get_contents($file); 
    $rules = filter_input(INPUT_POST, 'rules');
} else {
    $type = 'mn';
    $social_id = null;
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $city = filter_input(INPUT_POST, 'city');
    $text = filter_input(INPUT_POST, 'text');
    $file = filter_input(INPUT_POST, 'file');
        $img = preg_replace('#^data:image/[^;]+;base64,#', '', $file);
        $img = str_replace(' ', '+', $img);
        $file = base64_decode($img); 
    $rules = filter_input(INPUT_POST, 'rules');
}
$points = isset($_SESSION['game']) && isset($_SESSION['game']['answer']) ? intval($_SESSION['game']['answer']) : null;

// Проверка social_id
if (!is_null($social_id)) {
    $query = sprintf("SELECT `id` FROM `user` WHERE `social_id` = '%s'",
            mysql_real_escape_string($social_id));
    $result = mysql_query($query, $mysql);
    if ($row = mysql_fetch_assoc($result)) {
        $success = false;
        $response['social_id'] = 'Такой пользователь уже зарегистрирован';
    }
    mysql_free_result($result);
}

// Проверка имени
if (strlen($name) < 3 && strlen($name) > 150) {
    $success = false;
    $response['name'] = 'Имя должно быть длиннее 3 и не больше 150 символов';
}

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $query = sprintf("SELECT `id` FROM `user` WHERE `email` = '%s'",
            mysql_real_escape_string($email));
    $result = mysql_query($query, $mysql);
    if ($row = mysql_fetch_assoc($result)) {
        $success = false;
        $response['email'] = 'Такой email уже зарегистрирован';
    }
    mysql_free_result($result);
} else {
    $success = false;
    $response['email'] = 'Неверный email';
}

if (strlen($password) < 4 && strlen($password) > 16) {
    $success = false;
    $response['password'] = 'Имя должно быть длиннее 4 и не больше 16 символов';
} else {
    $password = crypt($password, SALT);
}

// Проверка города
if (preg_match('/([^\s]+)\s\((.+)\)/', $city, $matches)) {
    $query = sprintf("SELECT `id` FROM `city` WHERE `name` = '%s' AND `region` = '%s'",
            mysql_real_escape_string($matches[1]),
            mysql_real_escape_string($matches[2]));
    $result = mysql_query($query, $mysql);
    if ($row = mysql_fetch_assoc($result)) {
        $city = $row['id'];
    } else {
        $success = false;
        $response['city'] = 'Нет такого города';
    }
    mysql_free_result($result);
} else {
    $success = false;
    $response['city'] = 'Нет такого города';
}

if (strlen($text) > 300) {
    $success = false;
    $response['text'] = 'Факт о городе не должен быть длинее 300 символов';
}

if (is_null($points)) {
    $success = false;
    $response['points'] = 'Сведения о набранных баллах отсутствуют';
}
if ($success) {
    $query = sprintf("INSERT INTO `user` (`type`, `social_id`, `name`, `email`, `password`, `city`, `text`, `status`, `points`, `created`, `modify`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', 0, '%s', NOW(), NOW())",
            mysql_real_escape_string($type),
            mysql_real_escape_string($social_id),
            mysql_real_escape_string($name),
            mysql_real_escape_string($email),
            mysql_real_escape_string($password),
            mysql_real_escape_string($city),
            mysql_real_escape_string($text),
            mysql_real_escape_string($points));
    mysql_query($query, $mysql);
    $user_id = mysql_insert_id($mysql);
    if ($user_id) {
        if (!empty($text)) {
            send_email($email, 0, $user_id);
        }
        if (!empty($file)) {
            $dir = __DIR__. '/../upload/profile/';
            $img = imagecreatefromstring($file);
            $dest = imagecreatetruecolor(200, 200);
            $cx = imagesx($img);
            $cy = imagesy($img);
            if ($cx < 200 && $cy < 200) {
                $a1 = 0;
                if ( $cx > $cy ) {
                   $a1 = $cy / 200;
                }
                $c = $cx > $cy ? $cy : $cx;
                imagecopyresampled($dest, $img, 0, 0, $a1, 0, 200, 200, $c, $c);
            } else {
                $a1 = 0;
                $b1 = 0;
                if ($cx > $cy) {
                    $new_width = 200;
                    $new_height = floor( $cy * ( 200 / $cx ) );
                    $b1 = (200 - $new_height) / 2;
                } else {
                    $new_height = 200;
                    $new_width = floor( $cx * ( 200 / $cy ) );
                    $a1 = (200 - $new_width) / 2;
                }
                imagecopyresized($dest, $img, $a1, $b1, 0, 0, $new_width, $new_height, $cx, $cy);
            }
            $file = $dir . $user_id . '.jpg';
            $success = imagejpeg($dest, $file);
        }
    } else {
        $success = false;
        $response['mysql'] = mysql_error();
    }
    if ($success) {
        $_SESSION['game'] = array();
        $_SESSION['login'] = array();
        $_SESSION['login']['id'] = $user_id;
        $response = array('error' => false, 'id' => intval($_SESSION['login']['id']));
    }
}

if (!$success) {
    if (isset($response['social_id'])) {
        $response['errortext'] = $response['social_id'];
    } elseif (isset($response['email'])) {
        $response['errortext'] = $response['email'];
    } elseif (isset($response['name'])) {
        $response['errortext'] = $response['name'];
    } elseif (isset($response['password'])) {
        $response['errortext'] = $response['password'];
    } elseif (isset($response['city'])) {
        $response['errortext'] = $response['city'];
    } elseif (isset($response['text'])) {
        $response['errortext'] = $response['text'];
    } elseif (isset($response['points'])) {
        $response['errortext'] = $response['points'];
    }
}

ob_end_clean();
print json_encode($response);
