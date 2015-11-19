<?php
require_once __DIR__ . '/../config.inc.php';

if (session_id() == '') session_start();
$response = array("error" => true);
ob_start();

$id = filter_input(INPUT_POST, 'id');
$ip = _get_client_ip();

$response['session'] = $_SESSION['login'];
if (isset($_SESSION['login']) && (isset($_SESSION['login']['social']) || isset($_SESSION['login']['id']))) {
	if (isset($_SESSION['login']['social'])) {
		$ip = 'user'.$_SESSION['login']['social'];
	} else {
		    $ip = 'user'.$_SESSION['login']['id'];
	}
} else {
	$response['needlogin'] = true;
}

if (!isset($response['needlogin']) || !$response['needlogin']) {
	if ($id && $ip) {
		//if (isset($_COOKIE['user'])) {
		if (true) {
			$can = false;
			$query = "SELECT `moderated_time` FROM `user` WHERE `id` = '%s'";
			$query = sprintf($query, mysql_real_escape_string($id));
			$result = mysql_query($query, $mysql);
			$moderated_time = null;
			if ($row = mysql_fetch_assoc($result)) {
				$moderated_time = $row['moderated_time'];
			}
			mysql_free_result($result);

			if (!empty($moderated_time)) {
				$now = time();
				$diff = $now - strtotime($moderated_time);
				$hour = $diff / (60 * 60);
				if ($hour < 24) {
					$limit = 500;
					$newtime = $moderated_time;
				} else {
					$limit = 50;
					$plus = 0;
					do {
						$plus++;
						$newtime = strtotime($moderated_time) + (60*60*24)*$plus;
					} while ($newtime < $now);
					$plus--;
					$newtime = date("Y-m-d H:i:s", $newtime);
				}
				$query = "SELECT COUNT(*) as `count` FROM `like` WHERE `user_id` = '%s' AND `datetime` > '%s'";
				$query = sprintf($query, mysql_real_escape_string($id), mysql_real_escape_string($newtime));
				$result = mysql_query($query, $mysql);
				$count = 0;
				if ($row = mysql_fetch_assoc($result)) {
					$count = $row['count'];
				}
				if ($count < $limit) {
					$can = true;
				}
			}
			if ($can) {
			    $query = "INSERT INTO `like` (`user_id`, `date`, `datetime`, `ip`, `points`) VALUES ('%s', NOW(), NOW(), '%s', 1)";
			    $query = sprintf($query,
				    mysql_real_escape_string($id),
				    mysql_real_escape_string($ip));
			    mysql_query($query, $mysql);
			    $insert_id = mysql_insert_id($mysql);
			} else {
				$insert_id = true;
			}
			if ($insert_id) {
				$query = "SELECT (`user`.`points` + `user`.`points2` + COALESCE((SELECT SUM(`points`) FROM `share` WHERE `user_id` = `user`.`id`),0)"
				    . " + COALESCE((SELECT SUM(`points`) FROM `like` WHERE `user_id` = `user`.`id`),0)) as `points`"
				    . " FROM `user` "
				    . " WHERE `id` = '%s'"
		                    . " AND `status` = 2";
				$query = sprintf($query,
				    mysql_real_escape_string($id));
				$result = mysql_query($query);
				if ($row = mysql_fetch_assoc($result)) {
				    $response = array("error" => false, 'id' => $insert_id, 'points' => $row['points']);
				}
				mysql_free_result($result);
			}
			
		}
	}
}


ob_end_clean();
print json_encode($response);


function _get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}
