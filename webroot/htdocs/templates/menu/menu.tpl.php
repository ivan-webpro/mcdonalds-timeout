<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle cmn-toggle-switch cmn-toggle-switch__htx" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span>toggle menu</span>
                <a class="navbar-brand" href="#">меню</a>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav nav-justified">
                <li<?=$active[0]?>><a href="/">Главная</a></li>
                <li<?=$active[1]?>><a href="/contest.php">Конкурс</a></li>
                <li<?=$active[2]?>><a href="/product.php">Стейк Хаус Классик</a></li>
<?php if (isset($menu_points) && $menu_points) : ?>                
                <li class="visible-xs visible-768">
                    <div class="hidden-lg hidden-md scores">
                        <p><img src="img/line_1.png"> У вас <img src="img/line_2.png"></p>
                        <span><img src="img/Floral_3.png" alt=""><span id="points2"><?php print isset($_SESSION['game']['answer']) ? $_SESSION['game']['answer'] : null; ?></span><img src="img/Floral_4.png" alt=""></span>
                        <p><img src="img/line_3.png"> баллов <img src="img/line_4.png"></p>
                    </div>
                </li>
<?php endif; ?>                
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
