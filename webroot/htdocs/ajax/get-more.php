<?php
ob_start();
require_once __DIR__ . '/../config.inc.php';

if (session_id() == '') session_start();
$response = array("error" => true);

$count = filter_input(INPUT_POST, 'count');
$search = filter_input(INPUT_GET, 'search');
$sort = filter_input(INPUT_GET, 'sort');
if (!is_null($count)) {
    $colors = array('color_1', 'color_2', 'color_3', 'color_4', 'color_5', 'color_6');
    if (!is_null($search)) {
        $query = "SELECT `name` FROM `city` WHERE `id` = $search";
        $result = mysql_query($query);
        if ($row = mysql_fetch_assoc($result)) {
            $cur_city = $row['name'];
        }
        mysql_free_result($result);
    }
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
            . " WHERE `city`.`id` = `user`.`city`";
    if (!is_null($search)) {
        $query .= " AND `user`.`city` = $search";
    }
    $sort = filter_input(INPUT_GET, 'sort');
    switch($sort) {
        case 'random' :
            $query .= " ORDER BY RAND()";
            $active = array(' active', '', '');
            break;
        case 'new' :
            $query .= " ORDER BY `user`.`created` DESC";
            $active = array('', ' active', '');
            break;
        case '-new' :
            $query .= " ORDER BY `user`.`created` ASC";
            $active = array('', ' active', '');
            break;
        case 'points' :
            $query .= " ORDER BY `points` DESC";
            $active = array('', '', ' active');
            break;
        case '-points' :
            $query .= " ORDER BY `points` ASC";
            $active = array('', '', ' active');
            break;

        default:
            $query .= " ORDER BY `points` DESC";
            $active = array('', '', '');
            break;
    }
    $query .= " LIMIT $count, 10";
    $result = mysql_query($query, $mysql);
    $count = 0;
    while ($row = mysql_fetch_assoc($result)) {
        $count++;
        if ($count >= 10) break;
        $id = $row['id'];
        $name = $row['name'];
        $city = $row['cname'];
        $cityid = $row['city'];
        $text = !is_null($row['moderated']) ? $row['moderated'] : $row['text'];
        $status = intval($row['status']);
        if ($status != 2 ) {
            $text = null;
        }
        $points = $row['points'];

        $color1 = $colors[rand(0, count($colors)-1)];
        include __DIR__ . '/../templates/contest/work.tpl.php';
    }
    mysql_free_result($result);
    $buffer = ob_get_contents();
    if ($count > 0) {
        $response = array("error" => false, "data" => $buffer, 'count' => $count);
    }
}

ob_end_clean();
print json_encode($response);
