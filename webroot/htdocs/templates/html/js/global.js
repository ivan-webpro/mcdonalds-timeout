$(document).ready(function(){
	globalshare();
});

function globalshare() {
    $(".fb-globalshare").unbind('click');
    $(".fb-globalshare").bind('click', function() {
        FB.ui(
            {
              method: 'feed',
              //name: 'Facebook Dialogs',
              link: 'http://mcdonalds.timeout.ru/',
              picture: 'http://mcdonalds.timeout.ru/upload/social/SharingFB3.jpg',
              //caption: '',
              //description: descr,
            }
        );
        event.stopPropagation();
        return false;
    });

    $(".vk-globalshare").unbind('click');    
    $(".vk-globalshare").bind('click', function() {
	var url = '//vk.com/share.php?url=http://mcdonalds.timeout.ru/';
        var image = 'http://mcdonalds.timeout.ru/upload/social/SharingVK3.jpg';
	url += '&image=' + encodeURIComponent( image );
	window.open(url,'','toolbar=0,status=0,width=636,height=348');
        event.stopPropagation();
        return false;
    });
    
    $(".ok-globalshare").unbind('click');
    $(".ok-globalshare").bind('click', function() {
        var url = 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=http://mcdonalds.timeout.ru/';
	window.open(url,'','toolbar=0,status=0,width=636,height=348');
        event.stopPropagation();
        return false;
    });
    
    $(".tw-globalshare").unbind('click');
    $(".tw-globalshare").bind('click', function() {
        var text1 = 'Ответь на вопросы викторины, поделись фактом о любимом городе и выиграй Apple Watch или бесплатный обед в Макдоналдс';
        var url = 'http://twitter.com/share?text='+encodeURIComponent(text1)+'&url=http://mcdonalds.timeout.ru/';
	window.open(url,'','toolbar=0,status=0,width=636,height=348');
        event.stopPropagation();
        return false;
    });

}
