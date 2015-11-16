<?php
$html_styles[] = '/css/style.css';
$html_styles[] = '/css/style2.css';
$html_styles[] = '/css/media.css';
$html_styles[] = '/css/media2.css';
$html_scripts[] = '/templates/main/js/scripts.js';
$html_scripts[] = '/templates/contest/js/contest.js';
$html_scripts[] = '/templates/contest/js/user.js';

$active = array('', ' class="active"', '');

$user = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);

if ($user > 0) {
    $name = null;
    $query = "SELECT `user`.`id` as `id`"
            . ", `user`.`name` as `name`"
            . ", `city`.`name` as `cname`"
            . ", `user`.`city` as `city`"
            . ", `user`.`text`"
            . ", `user`.`moderated`"
            . ", `user`.`status`"
            . ", (`user`.`points` + `user`.`points2` + COALESCE((SELECT SUM(`points`) FROM `share` WHERE `user_id` = `user`.`id`),0)"
            . " + COALESCE((SELECT SUM(`points`) FROM `like` WHERE `user_id` = `user`.`id`),0)) as `points`"
            . " FROM `user`, `city`"
            . " WHERE `user`.`id` = '%s' AND `city`.`id` = `user`.`city`";
    $query = sprintf($query,
            mysql_real_escape_string($user));
    $result = mysql_query($query, $mysql);
    if ($row = mysql_fetch_assoc($result)) {
        $id1 = $row['id'];
        $name1 = $row['name'];
        $city1 = $row['cname'];
        $cityid1 = $row['city'];
        $text1 = !is_null($row['moderated']) ? $row['moderated'] : $row['text'];
        $status1 = intval($row['status']);
        $moderated1 = $status1 === 2 ? $text1 : null;
        $points1 = $row['points'];
        mysql_free_result($result);
        
        // Расчёт места
        $query = "SELECT COUNT(*) as `place` FROM `user` WHERE (`user`.`points` + `user`.`points2` + COALESCE((SELECT SUM(`points`) FROM `share` WHERE `user_id` = `user`.`id`),0)"
            . " + COALESCE((SELECT SUM(`points`) FROM `like` WHERE `user_id` = `user`.`id`),0)) > '%s'";
        $query = sprintf($query,
            mysql_real_escape_string($points1));
        $result = mysql_query($query, $mysql);
        $place = 1;
        if ($row = mysql_fetch_assoc($result)) {
            $place += $row['place'];
        }
        mysql_free_result($result);
    } else {
        mysql_free_result($result);
        header("Location: /contest.php");
        exit;
    }
    include __DIR__ .'/user.tpl.php';
} else {
    if (session_id() == '') session_start();
    $search = filter_input(INPUT_GET, 'search', FILTER_VALIDATE_INT);
    include __DIR__ .'/all.tpl.php';
}

?>

