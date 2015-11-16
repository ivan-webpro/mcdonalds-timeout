<?php
include __DIR__ . '/config.inc.php';
ini_set('max_execution_time', 900);
$query = "SELECT `id`, `name` FROM `city` ORDER BY `id`";
$result = mysql_query($query, $mysql);
while ($row = mysql_fetch_assoc($result)) {
    var_dump($row['name']);
    $imgx = 537;//548;//486;
    $stop = $imgx * .9;
    $imgy = 240;//343;//255;
    
    $size = 45;//41;
    $text = mb_strtoupper("#".$row['name']);
    $font = __DIR__ . '/upload/social/font.ttf';
    do {
        $size--;
        $box = imagettfbbox($size, 0, $font, $text);
        $width = abs($box[2]) + abs($box[0]);
        $height = abs($box[1]) + abs($box[5]);
        $x = ($imgx - $width) / 2;
        $y = ($imgy + $height / 2) / 2;
    } while ($width > $stop);
    
    $file = file_get_contents(__DIR__ . '/upload/social/vk/vk.jpg');
    $im = imagecreatefromstring($file);
    $color = imagecolorallocate($im, 255, 168, 0);
    imageTTFText($im, $size, 0, $x, $y, $color, $font, $text);
    
    $dest = __DIR__ . '/upload/social/vk/'.$row['id'].'.jpg';
    imagejpeg($im, $dest);
    
}
mysql_free_result($result);
