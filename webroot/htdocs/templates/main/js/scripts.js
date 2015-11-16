function burger_trigger() {
    if ($('.trigger_1').is(':visible')) {
        $('.l1 .i1').addClass('hidden');
        $('.l1 .i2').addClass('db').css('bottom', 0);
    }
    if ($('.trigger_2').is(':visible')) {
        $('.l2 .i1').addClass('hidden');
        $('.l2 .i2').addClass('db').animate({bottom: '-47px'}, 400);
    }
    if ($('.trigger_3').is(':visible')) {
        $('.l3 .i1').addClass('hidden');
        $('.l3 .i2').addClass('db').animate({bottom: '-90px'}, 400);
    }
    if ($('.trigger_4').is(':visible')) {
        $('.l4 .i1').addClass('hidden');
        $('.l4 .i2').addClass('db').animate({bottom: '-125px'}, 400);
    }
    if ($('.trigger_5').is(':visible')) {
        $('.l5 .i1').addClass('hidden');
        $('.l5 .i2').addClass('db').animate({bottom: '-155px'}, 400);
    }
    if ($('.trigger_6').is(':visible')) {
        $('.l6 .i1').addClass('hidden');
        $('.l6 .i2').addClass('db').animate({bottom: '-185px'}, 400);
    }
    if ($('.trigger_7').is(':visible')) {
        $('.l7 .i1').addClass('hidden');
        $('.l7 .i2').addClass('db').animate({bottom: '-225px'}, 400);
    }
    if ($('.trigger_8').is(':visible')) {
        $('.l8 .i1').addClass('hidden');
        $('.l8 .i2').addClass('db').animate({bottom: '-255px'}, 400);
    }
    if ($('.trigger_9').is(':visible')) {
        $('.l9 .i1').addClass('hidden');
        $('.l9 .i2').addClass('db').animate({bottom: '-290px'}, 400);
    }
    if ($('.trigger_10').is(':visible')) {
        $('.l10 .i1').addClass('hidden');
        $('.l10 .i2').addClass('db').animate({bottom: '-325px'}, 400);
    }
    if ($('.orange').is(':visible')) {
        $('.burger_fade').removeClass('hidden').addClass('visible_block animated bounceInDown');
        setTimeout(function() {
                $('.form_fade').removeClass('hidden').addClass('visible_block animated bounceInRight');
        }, 1000);
    }
}

$(document).ready(function(){
	 $('.slider-for').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: false,
		  fade: true,
		  speed: 0,
		  asNavFor: '.slider-nav'
		});
		$('.slider-nav').slick({
		  slidesToShow: 10,
		  slidesToScroll: 1,
		  vertical: true,
		  asNavFor: '.slider-for',
		  dots: true,
		  centerMode: true,
		  focusOnSelect: true
		});
	(function() {

  "use strict";

  var toggles = document.querySelectorAll(".cmn-toggle-switch");

  for (var i = toggles.length - 1; i >= 0; i--) {
    var toggle = toggles[i];
    toggleHandler(toggle);
  };

  function toggleHandler(toggle) {
    toggle.addEventListener( "click", function(e) {
      e.preventDefault();
      (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
    });
  }

})();

    $('.part.slick-slide').bind('mouseover', function(e) {
        var cur = $(this).attr("data-slick-index");
        $(".descr.row.slick-slide[data-slick-index!="+cur+"]").removeClass("slick-active").css("opacity", "0").css("left", "0").hide();
        $(".descr.row.slick-slide[data-slick-index="+cur+"]").addClass("slick-active").css("opacity", "1").css("left", "0").show();
    });
    $('.part.slick-slide').bind('click', function(e) {
        e.stopPropagation();
        var cur = $(this).attr("data-slick-index");
        setTimeout(function() {
            $(".descr.row.slick-slide[data-slick-index!="+cur+"]").removeClass("slick-active").css("opacity", "0").css("left", "0").hide();
            $(".descr.row.slick-slide[data-slick-index="+cur+"]").addClass("slick-active").css("opacity", "1").css("left", "0").show();
        }, 100);
    });    
});						
