<?php
$colors = array('color_1', 'color_2', 'color_3', 'color_4', 'color_5', 'color_6');

$cur_city = "Поиск города";
if (!is_null($search)) {
    $query = "SELECT `name` FROM `city` WHERE `id` = $search";
    $result = mysql_query($query);
    if ($row = mysql_fetch_assoc($result)) {
        $cur_city = $row['name'];
    }
    mysql_free_result($result);
}
$query = "SELECT `user`.`id` as `id`"
        . ", `user`.`name` as `name`"
        . ", `city`.`name` as `cname`"
        . ", `user`.`city` as `city`"
        . ", `user`.`text`"
        . ", `user`.`moderated`"
        . ", `user`.`status`"
        . ", (`user`.`points` + `user`.`points2` + COALESCE((SELECT SUM(`points`) FROM `share` WHERE `user_id` = `user`.`id`),0)"
        . " + COALESCE((SELECT SUM(`points`) FROM `like` WHERE `user_id` = `user`.`id`),0)) as `points`"
        . " FROM `user`, `city`"
        . " WHERE `city`.`id` = `user`.`city`"
	. " AND `user`.`status` = 2";
if (!is_null($search)) {
    $query .= " AND `user`.`city` = $search";
}
$sort = filter_input(INPUT_GET, 'sort');
switch($sort) {
    case 'random' :
        $query .= " ORDER BY RAND()";
        $active = array(' active', '', '');
        break;
    case 'new' :
        $query .= " ORDER BY `user`.`created` DESC";
        $active = array('', ' active', '');
        break;
    case '-new' :
        $query .= " ORDER BY `user`.`created` ASC";
        $active = array('', ' active', '');
        break;
    case 'points' :
        $query .= " ORDER BY `points` DESC";
        $active = array('', '', ' active');
        break;
    case '-points' :
        $query .= " ORDER BY `points` ASC";
        $active = array('', '', ' active');
        break;
    
    default:
        $query .= " ORDER BY `points` DESC";
	$active = array('', '', ' active');
        break;
}
$query .= " LIMIT 10";
?>
<section class="storys_page">
    <div class="block_1_bg"></div>
    <div class="container">
        <div class="row">
<?php include __DIR__ . '/../menu/menu.tpl.php'; ?>
            <div class="col-md-12 hidden-lg text-center">
                <div id="the-basics2">
		    <button class="pull-right hidden-lg h_btn_search btn_search"><img src="img/btn_search.png" alt=""></button>
                    <input class="typeahead search h_search" type="text" placeholder="<?=$cur_city?>" id="usercity2">
                </div>                     
<?php if(isset($_SESSION['login']) && isset($_SESSION['login']['id'])) : ?>                    
                <a class="visible-xxs" href="/contest.php?user=<?=$_SESSION['login']['id']?>"><button class="profileIn"></button></a>
<?php else : ?>
                <button class="logIn visible-xxs" data-toggle="modal" data-target="#modal_1"></button>
<?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container">
            <div class="row prizes">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="title">
                        <h2>призы</h2>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 text-center places_1">
                    <img src="img/Apple_watch.png" alt="">
                    <div class="places  text-left">
                        1 Место<br><span>Apple Watch</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 text-right">
                    <img src="img/icon_4.png" alt="">
                    <div class="places places_2 text-left">
                        2-21 Место<br><span>Обед в Макдоналдс</span>
                    </div>
                </div>
            </div>
        </div>
    <div class="border">
        <div class="container">
             <div class="row">
                 <div class="col-md-8 col-sm-12 title" style="z-index:100">
                     <h2>рейтинг историй</h2>
                     <ul class="tags_filtr">
                         <li>Сортировать:</li>
                         <li><a href="" class="rating-sort<?=$active[2]?>">По рейтингу</a></li>
                         <li><a href="" class="random-sort<?=$active[0]?>">Случайно</a></li>
                         <li><a href="" class="new-first-sort<?=$active[1]?>">Сначала новые</a></li>
                     </ul>
                 </div>
                 <div class="col-md-4 col-sm-15 text-right">
<?php if(isset($_SESSION['login']) && isset($_SESSION['login']['id'])) : ?>                    
                     <a class="h_l" href="/contest.php?user=<?=$_SESSION['login']['id']?>"><button class="profileIn h_l"></button></a>
<?php else : ?>
                     <button class="logIn h_l" data-toggle="modal" data-target="#modal_login"></button>
<?php endif; ?>
                     <br>
                    <div id="the-basics3">
			<button class="pull-right visible-lg  btn_search"><img src="img/btn_search.png" alt=""></button>
                        <input class="typeahead visible-lg search" type="text" placeholder="<?=$cur_city?>" id="usercity3">
                    </div>
                 </div>
             </div>
             <div id="works" class="row">
<?php
$query = sprintf($query,
        mysql_real_escape_string($user));
$result = mysql_query($query, $mysql);
$count = 0;
while ($row = mysql_fetch_assoc($result)) {
    $count++;
    if ($count >= 10) break;
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
?>
             </div>
             <div class="row text-center">
                 <div class="col-md-12">
<?php if ($count >= 10) : ?>                     
                     <button id="more" class="btn more"></button>
<?php endif; ?>
                     <div class="social_2 hidden-lg">
                         <ul>
                             <li><a href="" id="vk_2" class="vk-globalshare"></a></li>
                             <li><a href="" id="fb_2" class="fb-globalshare"></a></li>
                             <li><a href="" id="ok_2" class="ok-globalshare"></a></li>
                             <li><a href="" id="tw_2" class="tw-globalshare"></a></li>
                             <!-- <li><a href="" id="gl"></a></li> -->
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
    </div>	
</section>
<?php include __DIR__ . '/../menu/footer.tpl.php'; ?>
<div class="modal fade modal_login" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="img/close.png" alt=""></button>
                <h4 class="modal-title" id="myModalLabel">Авторизация</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="manuallogin">
                    <input type="email" class="form-control" id="useremail" name="useremail" placeholder="E-mail" required>
                    <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Пароль" required>
                    <!-- <a href="" class="pull-right forgot">Забыли пароль?</a> -->
                    <br>
                    <div class="social_2">
                        <span>Войти через соц. сети</span>
                        <ul>
                            <li><a href="/auth/vkontakte.php?auth&contest" id="vk_2"></a></li>
                            <li><a href="/auth/facebook.php?auth&contest" id="fb_2"></a></li>
                            <li><a href="/auth/odnoklassniki.php?auth&contest" id="ok_2"></a></li>
                            <li><a href="/auth/twitter.php?auth&contest" id="tw_2"></a></li>
                            <!-- <li><a href="/auth/google.php?auth&contest" id="gl"></a></li> -->
                        </ul>
                    </div>
                    <button class="btn send"><img src="img/buttons/send.png" alt=""></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$('#more').on('click', function() {
    var sh = getParam('search');
    var sr = getParam('sort');
    var str = "";
    if (typeof sh !== 'undefined') {
        str += "search="+sh;
    }
    if (str.length > 0) {
        str += '&';
    }
    if (typeof sr !== 'undefined') {
        str += "sort="+sr;
    }
    var count = $('.story').length;
    $.post('/ajax/get-more.php?'+str, {count: count}, function(data) {
        var obj = $.parseJSON(data);
        if (!obj.error) {
            $("#works").append(obj.data);
            if (obj.count < 10) {
                $("#more").hide();
            }
            return false;
        } else {
            $("#more").hide();
        }
    })
    return false;
});
$('#manuallogin').on('submit', function() {
    var email = $("#useremail").val();
    var password = $("#userpassword").val();
    $.post('/ajax/login.php', {email: email, password: password}, function(data) {
        var obj = $.parseJSON(data);
        if (!obj.error) {
            location.href = '/contest.php?user='+obj.id;
            return false;
        } else {
            $("#useremail").val('');
            $("#userpassword").val('');
        }
    });
    return false;
});

var cities = [];
var ids = [];
$.get('/ajax/load-city-list-search.php', function(data) {
    var obj = $.parseJSON(data);
    if (!obj.error) {
        cities = obj.data;
        ids = obj.ids;
    }
    ids.getKey = function(value){
        for(var key in this){
            if(this[key] == value){
                return key;
            }
        }
        return null;
    };
    
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
    $('#the-basics3 .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'cities',
        source: substringMatcher(cities)
      });
      
      $('#the-basics2 .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'cities',
        source: substringMatcher(cities)
      });
    $('#usercity3').on('focusout change click', function() {
        var val = $(this).val();
        if ($.inArray(val, cities) < 0) {
            $('#the-basics3 .typeahead').typeahead('val', '');
        } else {
            var sel = ids.getKey(val);
            location.href = "/contest.php?search="+sel;
            return false;
        }
    });
    $('#usercity2').on('focusout change click', function() {
        var val = $(this).val();
        if ($.inArray(val, cities) < 0) {
            $('#the-basics2 .typeahead').typeahead('val', '');
        } else {
            var sel = ids.getKey(val);
            location.href = "/contest.php?search="+sel;
            return false;
        }
    });
});

     
$(".random-sort").on('click', function() {
    var sh = getParam('search');
    var sr = getParam('sort');
    var str = "";
    if (typeof sh !== 'undefined') {
        str += "search="+sh;
    }
    if (str.length > 0) {
        str += '&';
    }
    str += 'sort=random';
    location.href = "/contest.php?"+str;
    return false;
});
$(".new-first-sort").on('click', function() {
    var sh = getParam('search');
    var sr = getParam('sort');
    var str = "";
    if (typeof sh !== 'undefined') {
        str += "search="+sh;
    }
    if (str.length > 0) {
        str += '&';
    }
    if (sr == "new") {
        str += 'sort=-new';
    } else {
        str += 'sort=new';
    }
    location.href = "/contest.php?"+str;
    return false;
});
$(".rating-sort").on('click', function() {
    var sh = getParam('search');
    var sr = getParam('sort');
    var str = "";
    if (typeof sh !== 'undefined') {
        str += "search="+sh;
    }
    if (str.length > 0) {
        str += '&';
    }
    if (sr == "points") {
        str += 'sort=-points';
    } else {
        str += 'sort=points';
    }
    location.href = "/contest.php?"+str;
    return false;
});
function getParam ( sname )
{
  var params = location.search.substr(location.search.indexOf("?")+1);
  var sval;
  params = params.split("&");
    // split param and value into individual pieces
    for (var i=0; i<params.length; i++)
       {
         temp = params[i].split("=");
         if ( [temp[0]] == sname ) { sval = temp[1]; }
       }
  return sval;
}
</script>
