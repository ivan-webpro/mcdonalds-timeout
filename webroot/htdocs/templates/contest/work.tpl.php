<div class="col-lg-4 col-md-6 col-sm-6 text-cente">
    <div class="text-center <?=$color1?> story" userid="<?=$id?>">
<?php
$pic = 'upload/profile/'.$id.'.jpg';
if (!file_exists(__DIR__.'/../../'.$pic)) {
    $pic = 'img/no-photo.png';
}
?>
        <img src="<?=$pic?>" class="author img-circle" alt="" width="118px" height="118px">
        <div class="name text-left"><?=$name?></div>
        <div class="scores">
            <span><img src="img/Floral_3.png" alt=""><span id="user<?=$id?>-points"><?=$points?></span><img src="img/Floral_4.png" alt=""></span>
            <p>баллов</p>
        </div>
        <div class="like text-right" userid="<?=$id?>">лайк &nbsp;<img src="img/Like.png" alt=""></div>
        <h4><img src="img/line_1.png" class="pull-left"><span><?=$city?></span><img src="img/line_2.png" class="pull-right"></h4>
        <div class="text">
            <p><?=$text?></p>
        </div>
        <div class="social_2">
            <span>Поделиться</span>
            <ul>
                <li><a href="" id="fb_3" class="fb-share" userid="<?=$id?>" cityid="<?=$cityid?>"></a></li>
                <li><a href="" id="vk_3" class="vk-share" userid="<?=$id?>" cityid="<?=$cityid?>"></a></li>
                <li><a href="" id="ok_3" class="ok-share" userid="<?=$id?>" cityid="<?=$cityid?>"></a></li>
                <li><a href="" id="tw_3" class="tw-share" userid="<?=$id?>" cityid="<?=$cityid?>" text1="<?=$text?>"></a></li>
            </ul>
        </div>
    </div>
</div>
