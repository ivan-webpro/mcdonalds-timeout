<?php

require_once __DIR__ . '/config.inc.php';

ob_start();

$title = 'Конкурс';

include __DIR__ . '/templates/html/header.tpl.php';

include __DIR__ . '/templates/contest/contest.tpl.php';

include __DIR__ . '/templates/html/footer.tpl.php';

$buffer = ob_get_contents();

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
ob_end_clean();
print $buffer;
