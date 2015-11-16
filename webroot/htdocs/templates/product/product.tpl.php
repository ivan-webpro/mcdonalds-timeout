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
				<div class="col-md-12 text-left title">
					<h2>стейк хаус классик</h2>
					<span>Состав</span>
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
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/1.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8 ">
									<span>БУЛОЧКА ДЛЯ ГАМБУРГЕРА С КУНЖУТОМ 
									ИМПРИНТ 4,5IN</span>

									<p>Мука пшеничная хлебопекарная высший сорт, 
									вода питьевая, сахар-песок, дрожжи хлебопекарные прессованные Рекорд (синяя этикетка), семена кунжута очищенные, масло подсолнечное, глютен пшеничный сухой, соль поваренная пищевая, смесь сухая для приготовления хлебобулочных изделий Профи-Пан 040 (ферменты, антиокислитель аскорбиновая кислота Е300, регулятор кислотности карбонат натрия Е500), регулятор кислотности аскорбиновая кислота.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/2.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>СОУС ТОМАТЫ-ГРИЛЬ</span>

									<p>Пюре томатное (40%), масло растительное, сахар, паприка, лук, спиртовой уксус, крахмал кукурузный модифицированный, соль, свекольный сок, специи, натуральный ароматизатор, загуститель Е415, консервант Е202.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/3.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>ЛУК РЕЗАНЫЙ КРАСНЫЙ</span>

									<p>Лук красный.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/4.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>САЛАТ АЙСБЕРГ МЕЛКОЙ НАРЕЗКИ</span>

									<p>Салат Айсберг.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/5.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>СЫР ПЛАВЛЕНЫЙ «HOCHLAND» «PROCESSED CHEDDAR CHEESE FOOD»</span>

									<p>Сыр Чеддар, масло сливочное, молоко сухое цельное и/или обезжиренное, белок молочный, натуральный ароматизатор сыра Чеддар, эмульгаторы (E331, E339), краситель: каротин, консервант: сорбиновая кислота, соль пищевая, вода питьевая.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/6.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>ПОЛУФАБРИКАТЫ МЯСНЫЕ РУБЛЕНЫЕ. КОТЛЕТА ИЗ ГОВЯДИНЫ 7:1</span>

									<p>100% говядина.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/7.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>СЫР ПЛАВЛЕНЫЙ «HOCHLAND» «PROCESSED CHEDDAR CHEESE FOOD»</span>

									<p>Сыр Чеддар, масло сливочное, молоко сухое цельное и/или обезжиренное, белок молочный, натуральный ароматизатор сыра Чеддар, эмульгаторы (E331, E339), краситель: каротин, консервант: сорбиновая кислота, соль пищевая, вода питьевая.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/8.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>ПОЛУФАБРИКАТЫ МЯСНЫЕ РУБЛЕНЫЕ. КОТЛЕТА ИЗ ГОВЯДИНЫ 7:1</span>

									<p>100% говядина.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/9.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>БЕКОН ПОРЦИОННЫЙ</span>

									<p>Свинина, соль, консерванты (Е250, Е326), стабилизатор (Е450, Е301), коптильные ароматизаторы, глюкозный сироп, натуральные ароматизаторы.</p>
								</div>
							</div>
							<div class="descr row">
								<div class="col-md-4 col-sm-4 hidden-xs">
									<img src="img/Lines/10.png" class="line" alt="">
								</div>
								
								<div class="col-md-8 col-sm-8">
									<span>БУЛОЧКА ДЛЯ ГАМБУРГЕРА С КУНЖУТОМ 
									ИМПРИНТ 4,5IN</span>

									<p>Мука пшеничная хлебопекарная высший сорт, 
									вода питьевая, сахар-песок, дрожжи хлебопекарные прессованные Рекорд (синяя этикетка), семена кунжута очищенные, масло подсолнечное, глютен пшеничный сухой, соль поваренная пищевая, смесь сухая для приготовления хлебобулочных изделий Профи-Пан 040 (ферменты, антиокислитель аскорбиновая кислота Е300, регулятор кислотности карбонат натрия Е500), регулятор кислотности аскорбиновая кислота.</p>
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