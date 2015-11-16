<?php
$html_styles[] = '/templates/html/font/font-face.css';

$html_styles[] = '/libs/animate/animate.css';
$html_styles[] = '/css/normalize.css';

// jQuery
$html_scripts[] = '/libs/jquery/jquery-1.9.1.min.js';
$html_scripts[] = '//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js';
$html_scripts[] = '/libs/jQuery-viewport-checker-master/jquery.viewportchecker.min.js';
$html_scripts[] = '/libs/scrollReveal/scrollReveal.min.js';
$html_scripts[] = '/libs/jquery/typeahead.bundle.min.js';

// Slick
$html_styles[] = '/libs/slick/slick.css';
$html_styles[] = '/libs/slick/slick-theme.css';
$html_scripts[] = '/libs/slick/slick.min.js';
// Bootstrap
$html_styles[] = '/libs/bootstrap/css/bootstrap.css';
$html_scripts[] = '/libs/bootstrap/js/bootstrap.min.js';

// Vkontakte API
$html_scripts[] = '//vk.com/js/api/openapi.js?113';

$html_scripts[] = '/templates/html/js/global.js';

$html_metas = array();
?>
<!DOCTYPE html>
<html>
<head>
<base href="/" />
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
%metas%
<title>McDonlald’s - Timeout - <?=$title?></title>
<link type="image/x-icon" rel="shortcut icon" href="/favicon.ico" />
%styles%
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="/css/style-for-ie.css" />
<![endif]-->
<!--[if lt IE 9]>
<script src="/libs/html5shiv/es5-shim.min.js"></script>
<script src="/libs/html5shiv/html5shiv.min.js"></script>
<script src="/libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="/libs/respond/respond.min.js"></script>
<![endif]-->
%scripts%
</head>
<body>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
    FB.init({
        appId: '1607478269517815',
        status: true,
        cookie: true,
        xfbml: true,
        oauth: true
    });
    FB.Event.subscribe('edge.create', function(response) {
        alert('You liked the URL: ' + response);

      });
};
(function(d) {
    var js, id = 'facebook-jssdk';
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    d.getElementsByTagName('head')[0].appendChild(js);
}(document));
</script>
