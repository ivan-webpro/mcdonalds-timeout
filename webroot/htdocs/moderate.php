<?php

$valid_passwords = array ( 'adminadmin' => 'Admin123' );
$valid_users = array_keys( $valid_passwords );

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = ( in_array( $user, $valid_users ) ) && ( $pass == $valid_passwords[ $user ] );

if ( !$validated ) {
  header( 'WWW-Authenticate: Basic realm="McDonalds Admin Area"' );
  header( 'HTTP/1.0 401 Unauthorized' );
  die ( 'Not authorized' );
}
?>
<?php
ob_start();

require_once __DIR__ . '/config.inc.php';
$publish = filter_input(INPUT_GET, 'publish', FILTER_VALIDATE_INT);
$block = filter_input(INPUT_GET, 'block', FILTER_VALIDATE_INT);
if (!is_null($publish)) {
    $query = "SELECT `id`, `email` , `status` FROM `user` WHERE `id` = $publish";
    $result = mysql_query($query);
    if ($row = mysql_fetch_assoc($result)) {
        if ($row['status'] != 2) {
            $query = "UPDATE `user` SET `status` = 2, `points2` = 500, `moderated_time` = NOW() WHERE `id` = $publish";
            if (mysql_query($query)) {
                send_email($row['email'], 2, $row['id']);
            }
        }
    }
    mysql_free_result($result);
}
if (!is_null($block)) {
    $query = "SELECT `id`, `email`, `status` FROM `user` WHERE `id` = $block";
    $result = mysql_query($query);
    if ($row = mysql_fetch_assoc($result)) {
        if ($row['status'] != 1) {
            $query = "UPDATE `user` SET `status` = 1, `points2` = 0, `moderated_time` = NOW() WHERE `id` = $block";
            if (mysql_query($query)) {
                send_email($row['email'], 1, $row['id']);
            }        
        }
    }
    mysql_free_result($result);
}
?>
<!DOCTYPE html>
<html>
<head>
<base href="/" />
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="">
%metas%
<link type="image/x-icon" rel="shortcut icon" href="/favicon.ico" />
%styles%
%scripts%
</head>
<body>
<?php




if (session_id() == '') session_start();

// Bootstrap
$html_scripts[] = '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js';
$html_styles[] = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css';
$html_styles[] = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css';
$html_scripts[] = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js';

moderate();

$buffer = ob_get_contents();
$metas = array();
$html_metas = array_unique($html_metas);
foreach ($html_metas as $meta) {
    $metas[] = $meta;
}
$buffer = str_replace('%metas%', join("\n", $metas), $buffer);

$styles = array();
$html_styles = array_unique($html_styles);
foreach ($html_styles as $style) {
    $styles[] = '<link type="text/css" rel="stylesheet" href="'.$style.'" media="all" />';
}
$buffer = str_replace('%styles%', join("\n", $styles), $buffer);

$scripts = array();
$html_scripts = array_unique($html_scripts);
foreach ($html_scripts as $script) {
    $scripts[] = '<script src="'.$script.'"></script>';
}
$buffer = str_replace('%scripts%', join("\n",$scripts), $buffer);
?>
</body>
</html>
<?php
ob_end_clean();
print $buffer;
?>
<?php
function moderate()
{
    $statuses = array(
        0 => 'На модерации',
        1 => 'Неопубликовано',
        2 => 'Опубликовано'
    );
    $classes = array (
        0 => 'danger',
        1 => 'warning',
        2 => 'success'
    );
    print '<table class="table table-striped table-hover table-bordered">';
    print '<thead>';
    print '<tr>';
    print '<th>ID</th>';
    print '<th>Имя</th>';
    print '<th>Email</th>';
    print '<th>Текст</th>';
    print '<th>Статус</th>';
    print '</tr>';
    print '</thead>';
    print '<tbody>';
    $query = "SELECT `id`, `name`, `email`, `text`, `status` FROM `user` WHERE `text` IS NOT NULL AND `text` != '' ORDER BY `status` ASC,`id` DESC";
    $result = mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) {
        print '<tr class="'.$classes[$row['status']].'">';
        print '<td>'.$row['id'].'</td>';
        print '<td><a href="/contest.php?user='.$row['id'].'" target=_blank">'.$row['name'].'</a></td>';
        print '<td>'.$row['email'].'</td>';
        print '<td>'.$row['text'].'</td>';
        switch ($row['status']) {
            case '0':
                print '<td>';
                print '<a class="btn btn-warning" href="moderate.php?block='.$row['id'].'" role="button">не публиковать</a>';
                print ' ';
                print '<a class="btn btn-success" href="moderate.php?publish='.$row['id'].'" role="button">опубликовать</a>';
                print '</td>';
                break;
            case '1':
                print '<td>';
                print '<a class="btn btn-success" href="moderate.php?publish='.$row['id'].'" role="button">опубликовать</a>';
                print '</td>';
                break;
            case '2':
                print '<td>';
                print '<a class="btn btn-warning" href="moderate.php?block='.$row['id'].'" role="button">не публиковать</a>';
                print '</td>';
                break;
            default:
                print '<td colspan="2">статус неизвестен</td>';
                break;
        }
        print '</tr>';
    }
    mysql_free_result($result);
    print '</tbody>';
    print '</table>';
}

