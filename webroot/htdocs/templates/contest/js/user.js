$(document).ready(function(){
    $(".fb-share").bind('click', function() {
        var cur_id = $(this).attr('userid');
        var city_id = $(this).attr('cityid');
        FB.ui(
            {
              method: 'feed',
              //name: 'Facebook Dialogs',
              link: 'http://mcdonalds.timeout.ru/contest.php?user='+cur_id,
              picture: 'http://mcdonalds.timeout.ru/upload/social/fb/'+city_id+'.jpg',
              //caption: '',
              //description: descr,
            },
            function(response) {
                if (response && response.post_id) {
                    var recursiveDecoded = decodeURIComponent( jQuery.param( response ) );
                    jQuery.post( "/ajax/share.php", { 'response' : recursiveDecoded, 'id' : cur_id, 'type' : 'fb' },function(data) {
                        var obj = $.parseJSON(data);
                        if (!obj.error) {
                            $("#user"+cur_id+'-points').html(obj.points);
                        }
                    });
                }
            }
        );
        event.stopPropagation();
        return false;
    });
    
    $(".vk-share").bind('click', function() {
        var cur_id = $(this).attr('userid');
        var city_id = $(this).attr('cityid');
	var url = '//vk.com/share.php?url=http://mcdonalds.timeout.ru/contest.php?user='+cur_id;
        var image = 'http://mcdonalds.timeout.ru/upload/social/vk/'+city_id+'.jpg';
	url += '&image=' + encodeURIComponent( image );
	window.open(url,'','toolbar=0,status=0,width=636,height=348');
        jQuery.post( "/ajax/share.php", { 'response' : null, 'id' : cur_id, 'type' : 'vk' }, function(data) {
            var obj = $.parseJSON(data);
            if (!obj.error) {
                $("#user"+cur_id+'-points').html(obj.points);
            }
        });
        event.stopPropagation();
        return false;
    });
    
    $(".ok-share").bind('click', function() {
        var cur_id = $(this).attr('userid');
        var city_id = $(this).attr('cityid');
        var url = 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=http://mcdonalds.timeout.ru/contest.php?user='+cur_id;
	window.open(url,'','toolbar=0,status=0,width=636,height=348');
        jQuery.post( "/ajax/share.php", { 'response' : null, 'id' : cur_id, 'type' : 'ok' }, function(data) {
            var obj = $.parseJSON(data);
            if (!obj.error) {
                $("#user"+cur_id+'-points').html(obj.points);
            }
        });
        event.stopPropagation();
        return false;
    });
    
    $(".tw-share").bind('click', function() {
        var cur_id = $(this).attr('userid');
        var city_id = $(this).attr('cityid');
        var text1 = $(this).attr('text1');
        text1 = 'Прими участие в конкурсе - напиши свой факт, копи баллы и выиграй Apple Watch или обед в «Макдонадлс».';
        var url = 'http://twitter.com/share?text='+encodeURIComponent(text1)+'&url=http://mcdonalds.timeout.ru/contest.php?user='+cur_id;
	window.open(url,'','toolbar=0,status=0,width=636,height=348');
        jQuery.post( "/ajax/share.php", { 'response' : null, 'id' : cur_id, 'type' : 'tw' }, function(data) {
            var obj = $.parseJSON(data);
            if (!obj.error) {
                $("#user"+cur_id+'-points').html(obj.points);
            }
        });
        event.stopPropagation();
        return false;
    });
    
    $(".like").bind('click', function() {
        var cur_id = $(this).attr('userid');
        jQuery.post( "/ajax/like.php", { 'id' : cur_id }, function(data) {
            var obj = $.parseJSON(data);
            if (!obj.error) {
                $("#user"+cur_id+'-points').html(obj.points);
            } else {
		if (obj.needlogin) {
			$("#modal_like").modal("show");
		}
	    }
        });
        event.stopPropagation();
        return false;
    });
    
    $(".story").bind('click', function() {
        var cur_id = $(this).attr('userid');
        location.href = '/contest.php?user='+cur_id;
    })
});
