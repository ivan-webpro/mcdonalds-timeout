<?php
require_once __DIR__ . '/../config.inc.php';

if (session_id() == '') session_start();

$response = array("error" => true);
ob_start();

$next_slide = isset($_SESSION['game']) && isset($_SESSION['game']['slide']) ? $_SESSION['game']['slide'] + 1 : null;
if ($next_slide > 1 && $next_slide <= 13) {
    include __DIR__ . '/../templates/main/slide'.$next_slide.'.tpl.php';
    $buffer = ob_get_contents();    
    $points = $_SESSION['game']['points'] + $_SESSION['game']['answer'];
    $correct = isset($_SESSION['game']['correct']) ? $_SESSION['game']['correct'] : false;
    $response = array('error' => false, 'data' => $buffer, 'slide' => $_SESSION['game']['slide'], 'points' => $points, 'correct' => $correct);
}

ob_end_clean();
print json_encode($response);
