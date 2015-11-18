<?php

require_once __DIR__ . '/../config.inc.php';

$response = array("error" => true);
ob_start();

$data = array();
$ids = array();
$query = "SELECT `id`, `name`, `region` FROM `city` WHERE `id` IN (SELECT DISTINCT(`city`) FROM `user` WHERE `status` = 2) ORDER BY `name`, `region`";
$result = mysql_query($query, $mysql);
while ($row = mysql_fetch_assoc($result)) {
    $data[] = $row['name']." (".$row['region'].")";
    $ids[$row['id']] = $row['name']." (".$row['region'].")";
}
mysql_free_result($result);
$response = array('error' => false, 'data' => $data, 'ids' => $ids);

ob_end_clean();
print json_encode($response);
        
