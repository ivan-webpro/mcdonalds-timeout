<?php
if (session_id() == '') session_start();
$_SESSION['game']['slide'] = 13;
$id = $name = $email = $picture = null;
if (isset($_SESSION['auth'])) {
    $id = isset($_SESSION['auth']['id']) ? $_SESSION['auth']['id'] : null;
    $name = isset($_SESSION['auth']['name']) ? $_SESSION['auth']['name'] : null;
    $email = isset($_SESSION['auth']['email']) ? $_SESSION['auth']['email'] : null;
    $picture = isset($_SESSION['auth']['picture']) ? $_SESSION['auth']['picture'] : null;
}

$active_menu = array(' class="active"', '', '');
?>
<section class="orange">
    <div class="container">
			<div class="row">
<?php include __DIR__ . '/../menu/menu.tpl.php'; ?>
			</div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center title">
                <h2><span>КЛАСС!</span> ТЫ ОТВЕТИЛ НА ВСЕ <br class="hidden-xs">ВОПРОСЫ И НАБРАЛ <br class="visible-xxs"><div class="red"><span id="final_points2"><?=$_SESSION['game']['answer']?></span> БАЛЛОВ!</div></h2>
                <div class="sub_title">Напиши интересный факт о своем городе и получи еще 500 баллов</div>
            </div>
        </div>
        <div class="row feedback">
            <div class="col-md-6 col-sm-6 text-right burger_fade hidden">
                <div class="hidden-lg hidden_soc_block">
                    <p>Ты можешь зарегистрироваться, 
                    <br>используя свой аккаунт в социальной сети</p>
                    <div class="social_2">
                        <ul>
                            <li><a href="/auth/vkontakte.php?auth" id="vk_2"></a></li>
                            <li><a href="/auth/facebook.php?auth" id="fb_2"></a></li>
                            <li><a href="/auth/odnoklassniki.php?auth" id="ok_2"></a></li>
                            <li><a href="/auth/twitter.php?auth" id="tw_2"></a></li>
                            <!-- <li><a href="/auth/google.php?auth" id="gl"></a></li> -->
                        </ul>
                    </div>
                </div>
                <img src="img/Burger_Full.png" id="Burger_Full" alt="">
            </div>
            <div class="col-md-6 col-sm-6 form_fade hidden">
                <div class="text">
                   
                </div>
                <div class="row">
                    <form role="form" id="userform">
                        <div class="col-md-6">
                            <div class="soc_block visible-lg">
                                <p>Ты можешь зарегистрироваться, 
                                    <br>используя свой аккаунт в социальной сети</p>
                                    
                            </div>
                            <input type="text" id="username" name="username" placeholder="Имя" value="<?=$name?>" required>
                            <input type="email" class="form-control" id="useremail" name="useremail" placeholder="E-mail" value="<?=$email?>" required>
<?php if (!is_null($id)) : ?>
                            <input type="hidden" class="form-control" id="userpassword" name="userpassword" placeholder="Пароль">
<?php else : ?>
                            <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Пароль" required>
<?php endif; ?>
                            <div id="the-basics">
                                <input class="typeahead" type="text" placeholder="Город" id="usercity" name="usercity" required>
                            </div>
                            
<?php if (!is_null($picture)) : ?>
				<div id="userphoto"><div><img id="myImage" src="<?=$picture?>"/></div></div>
<?php else : ?>
				<div id="userphoto"></div>
<?php endif; ?>
                            <button class="btn load_photo"></button>
                            <input type="file" id="userfile" name="userfile" style="visibility:hidden; margin:0; padding:0; height: 1px;">
                        </div>
                        <div class="col-md-6 right_block">
                            
                            <div class="social_2  visible-lg">
                                <ul>
                                    <li><a href="/auth/vkontakte.php?auth" id="vk_2"></a></li>
                                    <li><a href="/auth/facebook.php?auth" id="fb_2"></a></li>
                                    <li><a href="/auth/odnoklassniki.php?auth" id="ok_2"></a></li>
                                    <li><a href="/auth/twitter.php?auth" id="tw_2"></a></li>
                                    <!-- <li><a href="/auth/google.php?auth" id="gl"></a></li> -->
                                </ul>
                            </div>
                            <textarea id="usertext" name="usertext" placeholder="Интересный факт о твоем городе (от 200 до 2000 символов)" cols="30" rows="6" required></textarea>
				<div class="counter">Осталось <span id="counter-digits" class="digits red">2000</span> <span id="digit-text">символов</span></div>
				<div class="counter-hide">&nbsp;</div>
                            <button type="submit" class="btn participate singup"></button>
				<div class="text">Нажав на кнопку "Отправить" вы автоматически соглашаетесь с <a href="/rules.pdf" target="_blank">правилами участия</a> в конкурсе</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade modal_login_error" id="modal_login_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="img/close.png" alt=""></button>
                <h4 class="modal-title" id="myModalLabel">Ошибка!</h4>
            </div>
            <div class="modal-body">
                <p id="login_error_text"></p>
                <br>
            </div>
          </div>
    </div>
</div>
<div class="modal fade modal_photo" id="modal_photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="img/close.png" alt=""></button>
                <h4 class="modal-title" id="myModalLabel">Твоя фотка</h4>
            </div>
            <div class="modal-body" id="modal-photo"></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../menu/footer.tpl.php'; ?>
<script>
function declOfNum(number, titles) {  
    cases = [2, 0, 1, 1, 1, 2];  
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}
globalshare();
var count = 2000;
$('#usertext').bind('focusin', function() { $(".counter-hide").hide(); $(".counter").show(); });
$('#usertext').bind('focusout', function() {
	if (count > 0 && count <= 1800) {	
		$(".counter-hide").show(); $(".counter").hide();
	}
});
$('#usertext').bind('input propertychange', function() {
	var val = $(this).val();
	count = 2000 - val.length;
	if (count < 0 || count > 1800) {
		$("#counter-digits").addClass("red");
	} else {
		$("#counter-digits").removeClass("red");
	}
	$("#counter-digits").html(count);
	$("#digit-text").html(declOfNum(count, ['символ', 'символа', 'символов']));
});

var cities = [];
$.get('/ajax/load-city-list.php', function(data) {
    var obj = $.parseJSON(data);
    if (!obj.error) {
        cities = obj.data;
    }
    
    var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp('.*'+q+'.*\\s+\\(', 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });

        cb(matches);
      };
    };
    $('#the-basics .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'cities',
        source: substringMatcher(cities)
      });
});
$('#usercity').on('focusout', function() {
    var val = $(this).val();
    if ($.inArray(val, cities) < 0) {
        $('#the-basics .typeahead').typeahead('val', '');
    }
});
$('.load_photo').bind('click', function() {
    $('#userfile').click();
    return false;
});
<?php if (isset($_SESSION['auth']) && isset($_SESSION['auth']['picture']) && !empty($_SESSION['auth']['picture'])) : ?>
var current_image = '';
var social_image = '<img id="myImage" src="<?=$_SESSION['auth']['picture']?>"/>';
<?php else : ?>
var current_image = null;
var social_image = null;
<?php endif; ?>
$(':file').change(function(){
    current_image = null;
    var file = this.files[0];
    var name = file.name;
    var size = file.size;
    var type = file.type;
    if (type === 'image/png' || type === 'image/jpeg') {
        reader = new FileReader();
        reader.onload = (function (tFile) {
            return function (evt) {
                var width = 0;
                var height = 0;
                var x1 = 0;
                var x2 = 0;
                var image = new Image();
                image.src = evt.target.result;
                image.onload = function() {
                    width = this.width;
                    height = this.height;

                    current_image = evt.target.result;
                    if (typeof current_image === 'string' && current_image.length > 0) {
			$("#userphoto").empty();			
                        var div = document.createElement('div');
                        div.innerHTML = '<div id="myImage" style="background: url(\'' + evt.target.result + '\') no-repeat center; background-size: contain;" /></div>';
			document.getElementById('userphoto').appendChild(div);
                    } else {
			$("#userphoto").empty();
			if (social_image.length) {
				var div = document.createElement('div');
				div.innerHTML = socail_image;
				document.getElementById('userphoto').appendChild(div);
			}
                    }
                }
            };
        }(file));
        reader.readAsDataURL(file);
    } else {
        $(this).val('');
        $("#modal_photo .modal-body").empty();
    }
});
var formuser_trigger = false;
$('#userform').on('submit', function() {
    var name = $('#username').val();
    var email = $('#useremail').val();
    var password = $('#userpassword').val();
    var city = $('#usercity').val();
    var text = $('#usertext').val();
    var file = current_image;
    //if (typeof file === 'string' && file.length > 0) {
    if (true && !formuser_trigger) {
	formuser_trigger = true;
        $.post('/ajax/create-user.php', {
                name: name,
                email: email,
                password: password,
                city: city,
                text: text,
                file: file
            },
            function(data) {
                var obj = $.parseJSON(data);
                if (!obj.error) {
                    var cur_id = obj.id;
                    location.href = '/contest.php?user='+cur_id;
                    return false;
                } else {
                    $('#login_error_text').html(obj.errortext);
                    $('#modal_login_error').modal('show');
                }
		formuser_trigger = false;
            }
        );
    }
    return false;
});
</script>
