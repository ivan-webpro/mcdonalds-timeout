$(document).ready(function(){
    if (product) {
        $(".burger").hide();
    }
    var trigger_start = false;
    var trigger_bottom = false;
    var trigger_bottom2 = false;
    $('.start2').on('click', function() { 
        location.href = '/#play';
    });
    $('.start').on('click', function() { 
        if (!start2) {
            trigger_start = true;
            $("#modal_1").modal("show");
            load_next_slide("q0");
            if (product) {
                $(".burger").show();
            }
            return false;
        } else {
            location.href = '/contest.php?user='+start2;
            return false;
        }
    });
    
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        if (!trigger_start && !start2 && !product) {
            trigger_bottom = true;
            trigger_bottom2 = true;
        }
    }
    $(window).scroll(function() {
        if (!trigger_start  && !start2 && !product) {
            if (($(document).height() - $(window).scrollTop() - $(window).height()) < 50 ) {
                if (!trigger_bottom) {
                    trigger_bottom = true;
                } else {
                    trigger_bottom2 = true;
                }
            } else {
                trigger_bottom = false;
            }
        }
    });
    $(document).bind('mousewheel', function(evt) {
        if (!trigger_start  && !start2 && !product) {
            var delta = evt.originalEvent.wheelDelta;
            if (delta < 0) {
                if (!trigger_start && trigger_bottom && trigger_bottom2) {
                    $("#modal_1").modal("show");
                    load_next_slide("q0");
                    trigger_start = true;
                } else {
                    setTimeout(function() { trigger_bottom2 = true; }, 1000);
                }
            }
        }
    });
    
    $('#modal_1').on('hide.bs.modal', function (e) {
        var last_id = $('.slide:last').attr("id");
        if (typeof last_id !== 'undefined') {
            window.history.pushState({}, null, "/#"+last_id);
        }
        $("html,body").animate({scrollTop: $('.slide:last').offset().top});
	$(".start").hide();
        burger_trigger();
    });
    $('#modal_2').on('show.bs.modal', function (e) {
	burger_trigger();
	$('#modal_2').scrollTop = 0;
    });
    $('#modal_3').on('show.bs.modal', function (e) {
	burger_trigger();
	$('#modal_3').scrollTop = 0;
    });
    $('#modal_2').on('hide.bs.modal', function (e) {
        var last_id = $('.slide:last').attr("id")
        if (typeof last_id !== 'undefined') {
            window.history.pushState({}, null, "/#"+last_id);
        }
        if ($('.block_12').length) {
            $(".slide").eq(-2).hide();
            $("html,body").animate({scrollTop: $('.block_12').offset().top})
        } else {
            $("html,body").animate({scrollTop: $('.slide:last').offset().top});
            $(".slide").eq(-2).hide();
        }
        
        burger_trigger1();
	if (typeof block12_trigger !== 'undefined') {
		$("html,body").animate({scrollTop: $('.orange').offset().top});
	}
    });
    $('#modal_3').on('hide.bs.modal', function (e) {
        var last_id = $('.slide:last').attr("id");
        if (typeof last_id !== 'undefined') {
            window.history.pushState({}, null, "/#"+last_id);
        }
        if ($('.block_12').length) {
            $(".slide").eq(-2).hide();
            $("html,body").animate({scrollTop: $('.block_12').offset().top})
        } else {
            $("html,body").animate({scrollTop: $('.slide:last').offset().top});
            $(".slide").eq(-2).hide();
        }

        burger_trigger1();
	if (typeof block12_trigger !== 'undefined') {
		$("html,body").animate({scrollTop: $('.orange').offset().top});
	}
    });
});


function load_next_slide(q) {
    var aa = 0;
    if (q !== "q0") {2004
        var a = $("input[name="+q+"]:checked").val();
        if (typeof a !== "undefined") {
            aa = a;
        } else {
            return false;
        }
    }
console.log("Номер ответа: "+aa);
    $.ajax({
	url: '/ajax/load-next-slide.php',
	data:  {'a': aa},
	beforeSend: function() { console.log('Начинаем запрос данных');
	},
    }).done(function(data) {
	console.log(data);
        var obj = $.parseJSON(data);
        if (!obj.error) {
            if (aa != 0) {    
                if (obj.correct) {
                    $("#modal_2").modal("show");
                } else {
                  $("#modal_3").modal("show");
                }
            }
            $("#points").html(obj.points);
            $("#points2").html(obj.points);
            if (obj.slide === 13) {
                $('.slide:last').fadeOut('slow', function() {
                    $(this).replaceWith(obj.data);
                    $("#final_points2").html(obj.points);
                    $(this).fadeIn('slow', function() {
                        $('.slide').hide();
                        $("html,body").animate({scrollTop: $('.orange').offset().top});
                        $('.burger_fade').removeClass('hidden').addClass('visible_block');
                        $('.form_fade').removeClass('hidden').addClass('visible_block');
                    });
                });
            } else {
                $('.slide:last').after(obj.data);
                if (obj.slide === 12) {
                    $("#final_points").html(obj.points);
                }
            }
        }
    })
	.fail(AjaxError)
	.always(function() {console.log("запрос завершён");});
}

function AjaxError(x, e) {
  if (x.status == 0) {
    console.log(' Check Your Network.');
  } else if (x.status == 404) {
    console.log('Requested URL not found.');
  } else if (x.status == 500) {
    console.log('Internel Server Error.');
  }  else {
     console.log('Unknow Error.\n' + x.responseText);
  }
}

