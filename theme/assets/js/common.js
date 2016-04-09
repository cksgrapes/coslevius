$(function(){
  slider();

  $('.global-nav__sp-title').on('click', function(){
    $(this).next().slideToggle();
  });

   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 600; // ミリ秒
　　　 // 移動先を取得
      var href= $(this).attr("href");
      var target = $(href === "#" || href === "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });

  var $input_hide = $('.form__input--hide'),
      $form_confirm = $('.mw_wp_form_confirm'),
      $input_cosplan = '.form__input--cosplan',
      $input_ippan_details = '.form__input--ippan-details',
      $input_other_details = '.form__input--other-details';

  if ($input_hide.length) {
    $('input[name^="events_sankawaku"]').on('change', function(){
      if ($(this).attr('value') === 'コスプレ') {
        $(this).parents('dl').siblings($input_cosplan).show();
        $(this).parents('dl').siblings($input_ippan_details).hide();
      } else {
        $(this).parents('dl').siblings($input_cosplan).hide();
        $(this).parents('dl').siblings($input_ippan_details).show();
      }
    });
    $('input[name^="events_sankawaku_ippan"]').on('change', function(){
      if ($(this).attr('value') === 'その他') {
        $(this).parents('dl').siblings($input_other_details).show();
      } else {
        $(this).parents('dl').siblings($input_other_details).hide();
      }
    });

    if ($form_confirm.length) {
      $input_hide.show();
      $('.form__input input').each(function(){
        if ($(this).attr('value') === '') {
          $(this).parents('.form__input').hide();
        }
      });
      $('input[name^="events_sankawaku"]').each(function(){
       if ( $(this).attr('value') === 'コスプレ') {
          $(this).parents('.form__input').siblings('.form__input--ippan-details').hide();
       }
      });
      $('.form__member__box').each(function(){
        if ($(this).find('.form__input--cosname').is(':hidden')) {
          $(this).hide();
        }
      });
    } else {
      $input_hide.hide();
      $('.form__member__box').hide();
      $('.form__member__box').eq(0).show();
      $('.form__member__box').each(function(){
        if($(this).find('input[name^="events_cosname"]').attr('value') !== ""){
          $(this).show();
        }
      });
      $('.form__member__add').on('click',function(){
        $(this).parent().next().show();
      });
    }

    var url   = location.href;
    params    = url.split("?");
    spparams   = params[1].split("&");
    var paramArray = [];
    for ( i = 0; i < spparams.length; i++ ) {
        vol = spparams[i].split("=");
        paramArray.push(vol[0]);
        paramArray[vol[0]] = vol[1];
    }
    eventdate = paramArray.eventDate;
    eventdate = decodeURI(paramArray.eventDate);
    eventdate = eventdate.replace(/\s/g, '');
    eventdate = eventdate.replace(/(第.+?章).+?年/g, "$1");
    eventdate = eventdate.replace(/[A-Za-z0-9]/g, function(s) {
      return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
    });
    selector = 'option[value="' + eventdate + '"]';
    $(selector).attr('selected','selected');

  }
});

function slider() {
  // $('.top-slide__wrap').slick();
  $('.top-slide__wrap').slick({
    // slidesToShow: 1,
    infinite: true,
    variableWidth: true,
    centerMode: true,
    autoplay: true,
    autoplaySpeed: 3000,
    // appendArrows: $('.top-side__ctrls'),
    // prevArrow: '<li class="top-side__ctrls__prev">右</li>',
    // nextArrow: '<li class="top-side__ctrls__next">左</li>',
    responsive: [
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: false,
          mobileFirst: true,
          variableWidth: false,
          centerMode: false
        }
      }
    ]
  });
}
