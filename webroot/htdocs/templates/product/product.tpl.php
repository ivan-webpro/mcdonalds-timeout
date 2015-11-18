<?php
if (session_id() == '') session_start();
$html_styles[] = '/css/style.css';
$html_styles[] = '/css/style2.css';
$html_styles[] = '/css/media.css';
$html_styles[] = '/css/media2.css';
$html_scripts[] = '/templates/main/js/scripts.js';
$html_scripts[] = '/templates/main/js/slides.js';

$active = array('', '', ' class="active"');

$_SESSION['game'] = array();
$_SESSION['game']['slide'] = 1;
$_SESSION['game']['answer'] = 0;
?>
	<div class="hidden"></div>
	<section class="product slide">
		<div class="container">
			<div class="row">
<?php include __DIR__ . '/../menu/menu.tpl.php'; ?>
			</div>
			<div class="row">
				<div class="col-md-12 text-center title">
					<h2>стейк хаус классик</h2>
					<span class="text-left">Состав</span>
				</div>
			</div>
			<div class="row tabs_burger">
				<div class="col-md-7">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-3 slider-nav burger">
							<div class="part">
								<img src="img/b10.png" class="i1" alt="">
								<img src="img/b10_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b9.png" class="i1" alt="">
								<img src="img/b9_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b8.png" class="i1" alt="">
								<img src="img/b8_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b7.png" class="i1" alt="">
								<img src="img/b7_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b6.png" class="i1" alt="">
								<img src="img/b6_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b5.png" class="i1" alt="">
								<img src="img/b5_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b4.png" class="i1" alt="">
								<img src="img/b4_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b3.png" class="i1" alt="">
								<img src="img/b3_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b2.png" class="i1" alt="">
								<img src="img/b2_2.png" class="i2" alt="">
							</div>
							<div class="part">
								<img src="img/b1.png" class="i1" alt="">
								<img src="img/b1_2.png" class="i2" alt="">
							</div>
						</div>
						<div class="col-md-10 col-sm-10 col-xs-9 slider-for">
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/1.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>Булочка</span>
									<p>Поставщик - ООО "Ист Болт Рус"- Москва</p>
									<p>В пекарне Ист Болт Рус используется пшеничная 
										мука высшего сорта, которая производится на 
										предприятии ОАО «Рязаньзернопродукт».</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/2.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>СОУС ТОМАТЫ-ГРИЛЬ</span>
									<p>Поставщик - Develey, Германия</p>
									<p>Ни один из соусов для «Макдоналдс» не содержит генномодифицированных продуктов, искусственных красителей и усилителей вкуса.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/3.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>ЛУК РЕЗАНЫЙ КРАСНЫЙ</span>
									<p>Поставщик - компания "Белая Дача" г.Котельники МО</p>
									<p>Свежий, красный лук, богат витамином С</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/4.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>САЛАТ АЙСБЕРГ МЕЛКОЙ НАРЕЗКИ</span>
									<p>Поставщик - компания "Белая Дача" г.Котельники МО</p>
									<p>Кстати, компания «Макдоналдс» – одна из первых компаний, которая использует в больших объемах салат «Айсберг» для своих сандвичей и салатов. Овощи для сандвичей и салатов в «Макдоналдс» производит 
										компания ЗАО «Белая Дача Трейдинг», которая на протяжении 20 лет является основным поставщиком в России.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/5.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>Сыр плавленый</span>
									<p>Поставщик - ООО "Хохланд Русланд" Раменский район, МО</p>
									<p>Для приготовления данного сандвича Макдоналдс использует
									 плавленый сыр, приготовленный из молока, без искусственных 
									 красителей и ароматизаторов.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/6.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>Полуфабрикаты мясные рубленые.</span>
									<p>Поставщик - ООО "МАРР РУССИЯ", Одинцово</p>
									<p>Мясная котлета состоит из 100% говядины, без каких-либо добавок и примесей. Для приготовления мясных полуфабрикатов поставщик использет только высококачественное бескостное мышечное мясо передней и задней четвертины и всегда отслеживают источники его происхождения.
										В ресторане мясные полуфабрикаты доготавливаются в двустороннем гриле, без масла, только соль и перец после жарки..</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/7.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>Сыр плавленый</span>
									<p>Поставщик - ООО "Хохланд Русланд" Раменский район, МО</p>
									<p>Для приготовления данного сандвича Макдоналдс использует
									 плавленый сыр, приготовленный из молока, без искусственных 
									 красителей и ароматизаторов.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/8.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>Полуфабрикаты мясные рубленые.</span>
									<p>Поставщик - ООО "МАРР РУССИЯ", Одинцово</p>
									<p>Мясная котлета состоит из 100% говядины, без каких-либо добавок и примесей. Для приготовления мясных полуфабрикатов поставщик использет только высококачественное бескостное мышечное мясо передней и задней четвертины и всегда отслеживают источники его происхождения.
										В ресторане мясные полуфабрикаты доготавливаются в двустороннем гриле, без масла, только соль и перец после жарки..</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/9.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>БЕКОН ПОРЦИОННЫЙ</span>
									<p>Поставщик - ITALIA ALIMENTARI S.P.A, Италия</p>
									<p>Натуральный, копченый бекон</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-3 col-sm-3 hidden-xs">
									<img src="img/Lines/10.png" class="line" alt="">
								</div>
								
								<div class="col-md-9 col-sm-9">
									<span>Булочка</span>
									<p>Поставщик - ООО "Ист Болт Рус"- Москва</p>
									<p>В пекарне Ист Болт Рус используется пшеничная 
										мука высшего сорта, которая производится на 
										предприятии ОАО «Рязаньзернопродукт».</p>
								</div>
							</div>
						</div>
					</div>					
				</div>
				<div class="col-md-5 text-center right_block">
					<img src="img/Burger_Full.png" id="Burger_Full" alt="">
					<div class="title">Собери свой стейк хаус классик</div>
					<button class="btn start2"></button>
				</div>
			</div>
		</div>
	</section>
<?php include __DIR__ . '/../main/burger.tpl.php'; ?>
<?php include __DIR__ . '/../main/popups.tpl.php'; ?>
<?php //include __DIR__ . '/../menu/footer.tpl.php'; ?>
<?php if (isset($_SESSION['login']) && isset($_SESSION['login']['id'])) : ?>
<script>var product = true; var start2 = <?=$_SESSION['login']['id']?>;</script>
<?php else : ?>
<script>var product = true; var start2 = false;</script>
<?php endif; ?>