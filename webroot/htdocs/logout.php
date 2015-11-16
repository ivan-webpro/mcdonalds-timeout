<?php
require_once __DIR__ . '/config.inc.php';

if (session_id() == '') session_start();
$_SESSION['game'] = array();
$_SESSION['auth'] = array();
$_SESSION['login'] = array();
header("Location: /");
exit;
