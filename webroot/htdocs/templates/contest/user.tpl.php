<?php
//$html_metas[] = '<meta property="og:title" content="Мой родной город — '.$city1.'" />';
$html_metas[] = '<meta property="og:title" content="Узнай интересный факт о городе" />';
$html_metas[] = '<meta property="og:url" content="http://mcdonalds.timeout.ru/contest.php?user='.$id1.'" />';
$html_metas[] = '<meta property="og:type" content="website" />';
$html_metas[] = '<meta property="og:image" content="http://mcdonalds.timeout.ru/upload/social/ok/'.$cityid1.'.jpg" />';
$html_metas[] = '<link rel="image_src" href="http://mcdonalds.timeout.ru/upload/social/ok/'.$cityid1.'.jpg">';
$html_metas[] = '<meta property="og:image:width" content="548" />';
$html_metas[] = '<meta property="og:image:height" content="343" />';
//$html_metas[] = '<meta property="og:description" content="'.$moderated1.'" />';
//$html_metas[] = '<meta name="description" content="'.$moderated1.'">';
$html_metas[] = '<meta property="og:description" content="Прими участие в конкурсе - напиши свой факт, копи баллы и выиграй Apple Watch или обед в «Макдонадлс»." />';
$html_metas[] = '<meta name="description" content="Прими участие в конкурсе - напиши свой факт, копи баллы и выиграй Apple Watch или обед в «Макдонадлс».">';

if (session_id() == '') session_start();
?>
<section class="user_page user_page_2">
    <div class="container">
        <div class="row">
<?php include __DIR__ . '/../menu/menu.tpl.php'; ?>
        </div>
        <div class="row user">
            <div class="col-md-2 col-sm-4 text-left avatar">
<?php
$pic = 'upload/profile/'.$id1.'.jpg';
if (!file_exists(__DIR__.'/../../'.$pic)) {
    $pic = 'img/no-photo.png';
}
?>
                <img src="<?=$pic?>" class="author img-circle" alt="">
                <!-- <p>Макс. размер: 200х200 px -->
                <!-- <br>Формат фото: jpg, jpeg, png</p> -->
                <!-- <button class="btn upload"></button> -->
<?php if (isset($_SESSION['login']) && isset($_SESSION['login']['id']) && $_SESSION['login']['id'] == $id1) : ?>
                <a href="/logout.php"><button class="btn exit"></button></a>
<?php endif; ?>                
            </div>            
<?php if ($status1 == 1) : ?> 
            <div class="col-md-6 col-sm-8">
<?php else : ?>
            <div class="col-md-4 col-sm-8">
<?php endif; ?>
                <div class="name text-left"><?=$name1?></div>
                <div class="town"><span>Город:</span> <?=$city1?></div>
                
<?php if (isset($_SESSION['login']) && isset($_SESSION['login']['id']) && $_SESSION['login']['id'] == $id1) : ?>
<?php if (!empty($text1)) : ?>                
                <div class="text">
                        <span>Интересный факт о вашем городе:</span>
<?php if ($status1 != 1) : ?>  
                        <p><?=$text1?></p>
<?php else : ?>
		<div class="text">
                    <form action="">
                        <textarea id="usertext" name="" placeholder="Интересный факт о твоем городе" id="" cols="50" rows="6"><?=$text1?></textarea>
                        <button class="btn send usertextsend"></button>
                    </form>
                </div>
<?php endif; ?>
                </div>
<?php if ($status1 === 0) : ?>                
                <div class="attantion"><img src="img/Warning.png" alt=""><p>Отправленный вами факт о вашем городе <br>находится на модерации</p></div>
<?php endif; ?>
<?php if ($status1 === 1) : ?>                
                <div class="attantion"><img src="img/Warning.png" alt=""><p>Отправленный вами факт о вашем городе <br>не одобрен модератором!</p></div>
<?php endif; ?>
 <?php else : ?>
                <div class="text">
                    <p>Напишите и отправьте интересный факт о вашем городе! Это добавит 500 баллов к вашему рейтингу</p>
                    <form action="">
                        <textarea id="usertext" name="" placeholder="Интересный факт о твоем городе" id="" cols="50" rows="6"></textarea>
                        <button class="btn send usertextsend"></button>
                    </form>
                </div>
<?php endif; ?>
<?php else : ?>
<?php if (!empty($text1) && $status1 == 2) : ?>                
                <div class="text">
                        <span>Интересный факт о вашем городе:</span>
                        <p><?=$text1?></p>
                </div>
<?php endif; ?>
<?php endif; ?>
            </div>
            <div class="col-md-5 col-md-offset-1 col-sm-12 text-center">
                    <div class="row">
<?php if ($status1 === 2) : ?>
                        <div class="col-md-12 col-sm-6">
                            <div class="award">
                                <img src="img/Award.png" alt="">
<?php if (isset($_SESSION['login']) && isset($_SESSION['login']['id']) && $_SESSION['login']['id'] == $id1) : ?>
                                <p>Вы на <span><?=$place?></span> месте</p>
<?php else : ?>
                                <p>На <span><?=$place?></span> месте</p>
<?php endif; ?>
                            </div>
                            <div class="scores scores_2">
<?php if (isset($_SESSION['login']) && isset($_SESSION['login']['id']) && $_SESSION['login']['id'] == $id1) : ?>
                                <p><img src="img/line_1.png"> У вас <img src="img/line_2.png"></p>
<?php else : ?>
                                <p><img src="img/line_1.png"> Набрано <img src="img/line_2.png"></p>
<?php endif; ?>
                                <span><img src="img/Floral_3.png" alt=""><span id="user<?=$id1?>-points"><?=$points1?></span><img src="img/Floral_4.png" alt=""></span>
                                <p><img src="img/line_3.png"> баллов <img src="img/line_4.png"></p>
<?php if ($status1 === 2) : ?>
                <div class="like like_points" userid="<?=$id1?>">лайк &nbsp;<img src="img/Like2.png" alt=""></div>
<?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="social_2">
<?php if (isset($_SESSION['login']) && isset($_SESSION['login']['id']) && $_SESSION['login']['id'] == $id1) : ?>
                                <span>Рассказывайте о проекте друзьям 
                                <br>на своих страницах в социальных сетях. <br>Каждый шеринг добавит вам 20 баллов!</span>
                                <ul>
                                    <li><a href="" id="fb_2" class="fb-share" userid="<?=$id1?>" cityid="<?=$cityid1?>"></a></li>
                                    <li><a href="" id="vk_2" class="vk-share" userid="<?=$id1?>" cityid="<?=$cityid1?>"></a></li>
                                    <li><a href="" id="ok_2" class="ok-share" userid="<?=$id1?>" cityid="<?=$cityid1?>"></a></li>
                                    <li><a href="" id="tw_2" class="tw-share" userid="<?=$id1?>" cityid="<?=$cityid1?>" text1="<?=$moderated1?>"></a></li>
                                </ul>
<?php else : ?>
                                <span>Рассказывайте о проекте друзьям 
                                <br>на своих страницах в социальных сетях.</span>
                                <ul>
                                    <li><a href="" id="fb_2" class="fb-share" userid="<?=$id1?>" cityid="<?=$cityid1?>"></a></li>
                                    <li><a href="" id="vk_2" class="vk-share" userid="<?=$id1?>" cityid="<?=$cityid1?>"></a></li>
                                    <li><a href="" id="ok_2" class="ok-share" userid="<?=$id1?>" cityid="<?=$cityid1?>"></a></li>
                                    <li><a href="" id="tw_2" class="tw-share" userid="<?=$id1?>" cityid="<?=$cityid1?>"></a></li>
                                </ul>
<?php endif; ?>
                            </div>
	                </div>
<?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 title">истории других участников</div>
        </div>
        <div class="row">
<?php
$colors = array('color_1', 'color_2', 'color_3', 'color_4', 'color_5', 'color_6');

$query = "SELECT `user`.`id` as `id`"
        . ", `user`.`name` as `name`"
        . ", `city`.`name` as `cname`"
        . ", `user`.`city` as `city`"
        . ", `user`.`text`"
        . ", `user`.`moderated`"
        . ", `user`.`status`"
        . ", (`user`.`points` + `user`.`points2` + COALESCE((SELECT SUM(`points`) FROM `share` WHERE `user_id` = `user`.`id`), 0)"
        . " + COALESCE((SELECT SUM(`points`) FROM `like` WHERE `user_id` = `user`.`id`),0)) as `points`"
        . " FROM `user`"
        . " LEFT JOIN  `city` ON  `city`.`id` =  `user`.`city`"
        . " WHERE `user`.`id` != '%s' AND `user`.`city` = '%s'"
	. " AND `user`.`status` = 2";
$query .= " ORDER BY `points` DESC";
$query .= " LIMIT 20";
$query = sprintf($query,
        mysql_real_escape_string($id1),
        mysql_real_escape_string($cityid1));
$result = mysql_query($query, $mysql);
$count = 0;
while ($row = mysql_fetch_assoc($result)) {
    $count++;
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
    include __DIR__ . '/work.tpl.php';
}
mysql_free_result($result);
if ($count == 0) {
    $query = "SELECT `user`.`id` as `id`"
            . ", `user`.`name` as `name`"
            . ", `city`.`name` as `cname`"
            . ", `user`.`city` as `city`"
            . ", `user`.`text`"
            . ", `user`.`moderated`"
            . ", `user`.`status`"
            . ", (`user`.`points` + `user`.`points2` + COALESCE((SELECT SUM(`points`) FROM `share` WHERE `user_id` = `user`.`id`), 0)"
            . " + COALESCE((SELECT SUM(`points`) FROM `like` WHERE `user_id` = `user`.`id`),0)) as `points`"
            . " FROM `user`"
            . " LEFT JOIN  `city` ON  `city`.`id` =  `user`.`city`"
            . " WHERE `user`.`id` != '%s'"
		. " AND `user`.`status` = 2";
    $query .= " ORDER BY `points` DESC";
    $query = sprintf($query,
            mysql_real_escape_string($id1));
    $result = mysql_query($query, $mysql);
    $count = 0;
    while ($row = mysql_fetch_assoc($result)) {
        $count++;
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
        include __DIR__ . '/work.tpl.php';
    }
    mysql_free_result($result);       
}
?>
        </div>
    </div>	
</section>
<?php include __DIR__ . '/../menu/footer.tpl.php'; ?>
<script>
$(".usertextsend").bind('click', function() {
    var text = $("#usertext").val();
    if (text.length > 2000) {
        alert('Факт о городе не должен быть длинее 2000 символов');
        return false;
    } else {
        if (text.length > 0) {
            $.post('/ajax/save-text.php', {text: text}, function(data) {
                var obj = $.parseJSON(data);
                if (!obj.error) {
                    location.reload();
                } else {
			alert(obj.text);
		}
            });
        }
    }
    return false;
});
</script>
