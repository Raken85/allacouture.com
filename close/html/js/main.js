//слайдер видеогалереи
$('.section__video-slider').each(function(i, wrap) {
  var main = $(wrap).find('.slider_videos'), 
      thumbs = $(wrap).find('.slider_videos_thumb');

  main.slick({
    slidesToShow: 1,
    dots: false,
    arrows: true,
    asNavFor: thumbs
  });
  thumbs.slick({
    slidesToShow: 4,
    dots: false,
    arrows: false,
    focusOnSelect: true,
    asNavFor: main,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
        }
      }
    ]
  });
});

//Попапы в друзьях
function friend_gallery(gallery_name) {
	$.fancybox.open($('div.slider__slide:not(.slick-cloned) img[data-lightgroup="'+gallery_name+'"]'), {type: 'image', padding : 0});
}

//Поле телефона в попапах
/*function phone_country() {
	$(".js-mask-phone").intlTelInput();
	$(".js-mask-phone").intlTelInput("setCountry", "ru");
}
phone_country();
$(".js-mask-phone").on("countrychange", function(e, countryData) {
	var phonemask = get_phonemask(countryData['iso2']);
	$.mask.definitions['9'] = '';
	$.mask.definitions['#'] = '[0-9]';
	$(this).unmask();
	$(this).attr('placeholder',phonemask.replace(new RegExp('#', 'g'), '_'));
	$(this).mask(phonemask);
	$(this).blur();
	$(this).focus();
});*/
// слайдер преимуществ
$('.slider_advantages').slick({
  slidesToShow: 9,
  slidesToScroll: 1,
  //infinite:false,
  dots: false,
  arrows: true,
  //mobileFirst: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 1023,
      settings: {
        slidesToShow: 7,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 4,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
      }
    },
  ]
});

// большой слайдер
$('.slider_main').slick({
  arrows: false,
  dots: true,
  //autoplay: true,
  responsive: [
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        adaptiveHeight: true
      }
    },
  ]
});

// слайдер акций
$('.slider_promo').slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  //infinite:false,
  dots: false,
  arrows: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});

// слайдер youtube
$('.slider_video').slick({
  dots: false,
  arrows: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 767,
      settings: {
        arrows: false
      }
    }
  ]
});

// слайдер новинки, бестселлеры
$('.slider_products').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: 'window',
  //infinite: false,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 3,
        arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        arrows: false
      }
    }
  ]
});

// слайдер недавно просмотренные
$('.slider_recent').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 3,
        arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        arrows: false
      }
    }
  ]
});

// слайдер новости
$('.slider_news').slick({
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  swipe: false,
  mobileFirst: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 0,
      settings: 'unslick'
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});

// слайдер друзья
$('.slider_friends').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        arrows: false
      }
    }
  ]
});

// слайдер в карточке друга
$('.slider_friend').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  arrows: true
});

// слайдер пресса
$('.slider_press').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        arrows: false
      },
    },
    {
      breakpoint: 440,
      settings: {
        slidesToShow: 1,
        arrows: false
      }
    }
  ]
});

// слайдер галерея в новостях
$('.slider_gallery').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        arrows: false,
        dots: true
      }
    }
  ]
});

// слайдер отзывы
$('.slider_reviews').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  swipe: true,
  mobileFirst: true,
  respondTo: 'window',
  responsive: [
    {
      breakpoint: 0,
      settings: {

      }
    },
    {
      breakpoint: 767,
      settings: 'unslick'
    }
  ]
});

// слайдер в логотипе o_O
$('.slider_logo').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  arrows: false,
  autoplay: true,
  fade: true
});


// слайдеры в карточках
$('.product:not(.product_basket)').each(function(i, card) {
  var thumbs = $(card).find('.product__thumbs');
  var mainImg = $(card).find('.product__main-img');

  // слайдер в карточке - вертикальные превьюшки
  thumbs.slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    vertical: true,
    focusOnSelect: true,
    asNavFor: mainImg
  });

  // слайдер в карточке - большая картинка
  mainImg.slick({
    dots: false,
    arrows: false,
    swipe: false,
    asNavFor: thumbs
  });

  // перерисовка слайдеров при ховере
  $(card).on('transitionend webkitTransitionEnd oTransitionEnd', function() {
    thumbs.slick('setPosition');
    mainImg.slick('setPosition');
  });
});

// поиск
$('.search__btn').click(function(e) {
  e.preventDefault();
  $(this).parent().toggleClass('is-open');
  $(this).parent().find('.search__input').focus();
});

// Карта
if ($('#yamap').length) {
  ymaps.ready(function () {

    map = new ymaps.Map('yamap', {
      center: [55.755272, 37.641045],
      zoom: 16
    });

    var myPlacemark = new ymaps.Placemark([55.755272, 37.641045], { hintContent: 'Хохловский переулок, дом 3', balloonContent: 'Хохловский переулок, дом 3' }, {});
    map.geoObjects.add(myPlacemark);
  });
}

// разворачивание плавающих панелек справа
$('.floating__toggle').click(function() {
  $(this).parent().toggleClass('closed');
});

// попапы
$('[data-open-popup]').click(function(e) {
  e.preventDefault();
  var popupId = $(this).data('open-popup');
  if (popupId) {
    $('.modal-overlay').removeClass('closed');
    $('.modal#' + popupId).removeClass('closed');
    $('.modal#' + popupId).find('.slick-slider').each(function(i, sl) {$(sl).slick('setPosition')});
  }
});

$('.modal__close').click(function() {
  $('.modal-overlay').addClass('closed');
  $('.modal').addClass('closed');
});

$('.modal-overlay').click(function() {
  $('.modal-overlay').addClass('closed');
  $('.modal').addClass('closed');
});

// маски на формах
$.mask.definitions['9'] = '[0-9]';
$(".js-mask-phone").mask('+7 (999) 999-99-99');
$('.js-mask-date').mask('99.99.9999');
$('.phone-input input').mask('+7 (999) 999-99-99');
$('.phone-input input').attr('placeholder', '+7 (___) ___-__-__');

// мобильное меню
$('.menu__burger').click(function(e) {
  $(this).toggleClass('is-opened');
  $('.menu_mobile .menu__container').toggleClass('menu__container_opened');
  $('.menu__submenu').removeClass('menu__submenu_opened');
  e.stopPropagation();
});

$('.menu__link_parent').click(function(e) {
  e.preventDefault();
  $(this).siblings('.menu__submenu').toggleClass('menu__submenu_opened');
});


// выбор даты для личного калинета
$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: '&#x3c;Пред',
    nextText: 'След&#x3e;',
    currentText: 'Сегодня',
    monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
    dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
    dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    weekHeader: 'Нед',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};

$('.js-datepicker').datepicker($.extend({
        inline: true,
        changeYear: true,
        changeMonth: true,
    },
    $.datepicker.regional['ru']
));

// фиксированная шапка
$(window).scroll(function() {
  var fullHeaderHeight = $('.header').outerHeight();
  var topHeaderHight = $('.header__top').outerHeight()
  if ($(window).scrollTop() > topHeaderHight) {
    if (!$('.header').hasClass('header_fixed')) {
      $('.header').addClass('header_fixed');
      $('.page').css({'padding-top': fullHeaderHeight + 'px'});
    }
  } else {
    $('.header').removeClass('header_fixed');
    $('.page').removeClass('header_fixed');
    $('.slider_logo').slick('setPosition');
    $('.page').css({'padding-top': 0});
  }
});

// выбор стран в поле с телефоном
$('.js-phone-input').intlTelInput({
  autoHideDialCode: false,
  autoPlaceholder: 'aggressive',
  initialCountry: 'ru',
  preferredCountries: ['ru', 'ua']
});

$('.page').jarallax({
    speed: 0.8,
    imgSize: '100% auto',
    imgPosition: '50% 100%'
});

$('.js-tipsy').tipsy({fade: true, gravity: 's',html: true });

$('.footer__scroll-top-btn').on('click', function(event) {
  event.preventDefault();
  $('body,html').animate({scrollTop:0},500);
});

var action_timer = {
  init: function() {
    var $timer = $('.js-action-timer')
        default_timer = 80768;
    if ($timer.length) {
      $timer.each(function() {
        var _self = $(this),
            time = _self.data('timer') ? _self.data('timer') : default_timer,
            id = _self.data('timer-id'),
            /*Удалить ниже строчку и убрать комменты для записи в localstorage*/
            remain_time = time;

        if (id) {
          /*if (localStorage.getItem("action-timer_"+ id)) {
            time = localStorage.getItem("action-timer_"+ id);
          }
          localStorage.setItem("action-timer_"+ id, time);*/

          var int = setInterval(function(){
            /* var remain_time= parseInt(localStorage.getItem("action-timer_"+ id))*/;
            remain_time = remain_time - 1;
            /*localStorage.setItem("action-timer_"+ id, remain_time);*/
            parseTime_bv(remain_time, _self);
            if (remain_time <= 0) {
                clearInterval(int);
            }
          }, 1000);
        }
      });
    }
    function parseTime_bv(timestamp, $obj){
        if (timestamp < 0) timestamp = 0;
        
        var day = Math.floor( (timestamp/60/60) / 24);
        var hour = Math.floor(timestamp/60/60);
        var mins = Math.floor((timestamp - hour*60*60)/60);
        var secs = Math.floor(timestamp - hour*60*60 - mins*60); 
        var left_hour = Math.floor( (timestamp - day*24*60*60) / 60 / 60 );
     
        $obj.find('.timer-hours').text(left_hour);
     
        if(String(mins).length > 1)
            $obj.find('.timer-mins').text(mins);
        else
            $obj.find('.timer-mins').text("0" + mins);
        if(String(secs).length > 1)
            $obj.find('.timer-secs').text(secs);
        else
            $obj.find('.timer-secs').text("0" + secs);
    }
  }
}.init();

var mCustomScrollbar = {
  init: function() {
    var _self = this;
    var $block = $('.js-scroll'); 
    $block.each(function() {
      if (!$(this).hasClass('mCustomScrollbar')) {
        $(this).mCustomScrollbar();
      }
    });
  },
  destroy: function() {
    var _self = this;
    var $block = $('.js-scroll'); 
    $block.each(function() {
      if ($(this).hasClass('mCustomScrollbar')) {
        $(this).mCustomScrollbar("destroy");
      }
    });
  },
  change: function() {
    var _self = this; 
      handleMediaChange = function (mediaQueryList) {
        if (mediaQueryList.matches) {
          _self.destroy();
        }
        else {
            _self.init();
        }
    }
    var mediaQueryMatch = window.matchMedia("(max-width: 767px)");
    mediaQueryMatch.addListener(handleMediaChange);
    handleMediaChange(mediaQueryMatch);
  },
  start: function() {
    var _self = this;
    _self.init();
     $(window).resize(function() {
      _self.change();
    }).trigger('resize');
  }
}.start()

//Показать или скрыть пароль в инпуте

$(document).ready(function() {

  //добавляем зрачок инпута на страницы
  showPass('js-form-contact__show-psw', 'js-form-contact__input--psw');
  showPass('js-form-contact__show-psw-reg', 'js-form-contact__input--psw-reg');
  showPass('js-form-contact__show-psw-reg-repeat', 'js-form-contact__input--psw-reg-repeat');

  function showPass(eye, input) {
    var eye = $('.' + eye),
        input = $('.' + input);

        eye.on('click', function(e) {
          e.preventDefault();

          input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
          if (input.val() !== '') {
            input.siblings('.form-contact__input-holder').hide();
          } else {
            return false;
          }
        });    
  };
//Кастомные плейсхолдеры. Скрывает плейсходер, если есть текст в инпуте. Так как средствами css эту штуку не получится сделать. P.s. Плейсхолдер кастомный, наложен поверх инпута там, где текст курсивом и с красной звездочкой. 
  var inputs = $('.form-contact__input');

  inputs.each(function(i) {
    var _this = $(this),
        $holder = _this.siblings('.form-contact__input-holder');
    _this.attr('data-placeholder', $holder.text());
    $(document).on('click', function() {
        if (_this.val() !== '' && _this.is(':focus') == false) {
          $holder.hide();
        } else {
          if (_this.val() == '' && _this.is(':focus') == false) {
            $holder.text(_this.data('placeholder')).show();
          }
        }
    })
  });
});