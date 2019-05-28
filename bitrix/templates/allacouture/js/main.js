var breakpoints = {
  medium: 767,
  small: 321
};

var pagingDigits = function(slider, i) {
  return "<a>" + (i + 1) + "</a>";
};
var pagingDots = function(slider, i) {
  return '<button type="button" data-role="none" role="button" tabindex="0"></button>';
};
function merge_options(a, b){
    var merged = {};
    for (var attrname in a) { merged[attrname] = a[attrname]; }
    for (var attrname in b) { merged[attrname] = b[attrname]; }
    return merged;
}
function ajaxPagination() {
  $("body").on("click", ".news-ajax a, a.news-ajax", function(e) {
    e.preventDefault();
    var link = $(this);

    $.get(link.attr("href"), function(html) {
      var replace = $(html).find("#page-ajax");
      $("#page-ajax").replaceWith(replace);
    });
  });
}
ajaxPagination();

function createCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }

    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

$(function() {
  if (!window.no_hello_popup && !getCookie('no_hello_popup')) {
    setTimeout(function(){
      $.fancybox.open($('#modal-hello'));
    },10000);
  } 
  // createCookie('cookie_info', true, 0);
  // getCookie('geoip_popup');
});



(function(){

	var	validating = {
		init: function() {
      var _self = this;
			$('#modal-hello form').submit(function(e){
				var form = $(this),
            req_inputs = {
              text1: form.find('[name="UF_FIO"]'),
              phone: form.find('[name="REGISTER[PERSONAL_PHONE]"]'),
              email: form.find('[name="REGISTER[EMAIL]"]')
            };
				if (!_self.checkForm(form, req_inputs)) return false;
        createCookie('no_hello_popup', true, 0);
			});

      $('#modal-friends form').submit(function(event) {
        var form = $(this),
            req_inputs = {
              text1: form.find('[name="form_text_1"]'),
              phone: form.find('[name="form_text_4"]'),
              email: form.find('[name="form_text_2"]')
            };
          if (!_self.checkForm(form, req_inputs)) return false;
      });
      $('.registration__form form[name="regform"]').submit(function(e){
          var form = $(this),
              req_inputs = {
                text1: form.find('[name="UF_FIO"]'),
                phone: form.find('[name="REGISTER[PERSONAL_PHONE]"]'),
                email: form.find('[name="REGISTER[EMAIL]"]'),
                pass: form.find('[name="REGISTER[PASSWORD]"]'),
                confirm_pass: form.find('[name="REGISTER[CONFIRM_PASSWORD]"]')
              };
          if (!_self.checkForm(form, req_inputs)) return false;
      });
		},
    checkForm: function (form, inputs) {
      var checkResult = true;
      form.find('.invalid').removeClass('invalid');
      
      for (var input in inputs) {
        switch (input) {
          // case 'phone':
          //   var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
          //   if (!re.test(inputs[input].val())) {
          //     inputs[input].addClass('invalid');
          //     checkResult = false;
          //   }
          // break;
          case 'email':
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if (!re.test(inputs[input].val())) {
              inputs[input].addClass('invalid');
              checkResult = false;
            }
          break;
          case 'pass':
            var confirm = inputs['confirm_pass'].val();
            if ($.trim(inputs[input].val()) !== confirm || $.trim(inputs[input].val()) === '') {
              inputs[input].add(inputs['confirm_pass']).addClass('invalid');

              checkResult = false;
            }
          break;
          default:
            if ($.trim(inputs[input].val()) === '') {
              inputs[input].addClass('invalid');
              checkResult = false;
            }
          break;
        }
      }

      if (!checkResult)
        form.addClass('invalid');

      return checkResult;
    }
	}

  validating.init();
})();





//слайдер видеогалереи
$(".section__video-slider").each(function(i, wrap) {
  var main = $(wrap).find(".slider_videos"),
    thumbs = $(wrap).find(".slider_videos_thumb");
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
        breakpoint: breakpoints.medium,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: breakpoints.small,
        settings: {
          slidesToShow: 2,
          dots: true
        }
      }
    ]
  });
});

$('body').on('click','.js-open-friends-gallery', function(event) {
  event.preventDefault();
  var _self = $(this),
      gallery_name = _self.data('fancy-lightgroup');
  $.fancybox.open(
    $(
      'div.slider__slide:not(.slick-cloned) img[data-lightgroup="' +
        gallery_name +
        '"]'
    ),
    { type: "image", padding: 0,
       caption : function( instance, item ) {
        var caption = '';
        if ( $(item.opts.$orig[0]).next('.js-button-fancy-catalog').length) {
          var clone = $(item.opts.$orig[0]).next('.js-button-fancy-catalog').clone();
          caption = clone;
        } 
        return caption;
      }
    }
  );
});

//Поле телефона в попапах
function phone_country() {
  $(".js-mask-phone").intlTelInput();
  $(".js-mask-phone").intlTelInput("setCountry", "ru");
}
phone_country();
$(".js-mask-phone").on("countrychange", function(e, countryData) {
  var phonemask = get_phonemask(countryData["iso2"]);
  $.mask.definitions["9"] = "";
  $.mask.definitions["#"] = "[0-9]";
  $(this).unmask();
  $(this).attr("placeholder", phonemask.replace(new RegExp("#", "g"), "_"));
  $(this).mask(phonemask);
  $(this).blur();
  $(this).focus();
});

$(function() {
	$(".slider_advantages").slick(merge_options({
	  slidesToShow: 9,
	  slidesToScroll: 2,
	  //infinite:false,
	  autoplay: true,
	  autoplaySpeed: 5000,
	  dots: false,
	  arrows: true,
	  //mobileFirst: true,
	  respondTo: "window",
	  responsive: [
	    {
	      breakpoint: 1023,
	      settings: {
	        slidesToShow: 7
	      }
	    },
	    {
	      breakpoint: 767,
	      settings: {
	        slidesToShow: 4
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1,
	      }
	    }
	  ]
	}, window.advantages_options === undefined ? {} : window.advantages_options));
});

// большой слайдер
$(".slider_main").slick({
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
    }
  ]
});

// слайдер акций
$(".slider_promo").slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  //infinite:false,
  dots: false,
  arrows: true,
  respondTo: "window",
  responsive: [
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        adaptiveHeight: true
      }
    }
  ]
});

// слайдер youtube
$(".slider_video").slick({
  dots: false,
  arrows: true,
  respondTo: "window",
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
$(".slider_products").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: "window",
  // customPaging: pagingDigits,
  //respondTo: 'window',
  //infinite: false,
  responsive: [
    {
      breakpoint: breakpoints.medium,
      settings: {
        slidesToShow: 3
        // arrows: false,
        // dots: true,
        // customPaging: pagingDigits,
      }
    },
    {
      breakpoint: breakpoints.small + 1,
      settings: {
        arrows: false,
        slidesToShow: 2,
        dots: true,
        customPaging: pagingDots
      }
      // settings: 'unslick'
    }
  ]
});

// слайдер недавно просмотренные
$(".slider_recent").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: "window",
  responsive: [
    {
      breakpoint: breakpoints.medium,
      settings: {
        slidesToShow: 3,
        arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        slidesToShow: 2,
        // новое
        dots: true,
        customPaging: pagingDots
      }
    }
  ]
});

// слайдер новости
// $('.slider_news').slick({
//   slidesToScroll: 1,
//   dots: false,
//   arrows: true,
//   swipe: false,
//   respondTo: 'window',
//   responsive: [
//     {
//       breakpoint: breakpoints.medium,
//       settings: {
//         slidesToShow: 1,
//         arrows: true,
//         dots: true,
//         customPaging: pagingDigits,
//       }
//     }, {
//       breakpoint: breakpoints.small,
//       settings: {
//         slidesToShow: 1,
//         arrows: false,
//         dots: true,
//         customPaging: pagingDigits,
//       }
//     }
//   ]
// });

// слайдер в карточке друга
$(".slider_friend").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  infinite:false
});

$(".slider_friends").each(function() {
  if ($(this).hasClass('slider_friends_pagination')) {
    $(this).slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: true,
      arrows: true,
      customPaging: pagingDigits,
      //respondTo: 'window',
      responsive: [
        {
          breakpoint: breakpoints.medium,
          settings: {
            arrows: false,
            dots: true,
            customPaging: pagingDigits,
          }
        },
        {
          breakpoint: breakpoints.small,
          settings: {
            arrows: false,
            slidesToShow: 2,
            dots: true,
            customPaging: pagingDigits
          }
          // settings: 'unslick'
        }
      ]
    });
  } else {
    $(this).slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      // customPaging: pagingDigits,
      //respondTo: 'window',
      responsive: [
        {
          breakpoint: breakpoints.medium,
          settings: {
            arrows: false
            // dots: true,
            // customPaging: pagingDigits,
          }
        },
        {
          breakpoint: breakpoints.small,
          settings: {
            arrows: false,
            slidesToShow: 2,
            dots: true,
            customPaging: pagingDots
          }
          // settings: 'unslick'
        }
      ]
    });
  }
});


$(window).on("resize", function() {
  if ($(window).width() > breakpoints.small) {
    var sliders = $(".slider:not(.slick-initialized)");
    if (sliders.length) {
      sliders.each(function(index, el) {
        if (typeof el.slick != "undefined") $(el).slick("reinit");
      });
    }
  }
});

$(".slider_press").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  // customPaging: pagingDigits,
  respondTo: "window",
  responsive: [
    {
      breakpoint: breakpoints.medium,
      settings: {
        arrows: true
        // dots: true,
        // customPaging: pagingDigits,
      }
    },
    {
      breakpoint: breakpoints.small,
      settings: {
        arrows: false,
        slidesToShow: 2,
        dots: true,
        customPaging: pagingDots
      }
    }
  ]
});
/*
setInterval(function() {
  var windowWidth = $(window).width();


  // if(windowWidth <= breakpoints.small) {
    // слайдер друзья
    $('.slider_friends').not('.slick-initialized').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      respondTo: 'window',
      responsive: [
        {
          breakpoint: breakpoints.medium,
          settings: {
            arrows: false,
            dots: true,
            customPaging: pagingDigits,
          }
        }, {
          breakpoint: breakpoints.small,
          settings: 'unslick'
        }
      ]
    });
  // } else {
  //   $('.slider_friends.slick-initialized').slick('unslick');
  // }

  // слайдер пресса
  $('.slider_press').not('.slick-initialized').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    respondTo: 'window',
    responsive: [
      {
        breakpoint: breakpoints.medium,
        settings: {
          arrows: true,
          dots: true,
          customPaging: pagingDigits,
        }
      }, {
        breakpoint: breakpoints.small,
        settings: {
          slidesToShow: 2,
          arrows: false,
          dots: true,
          customPaging: pagingDots,
        }
      }
    ]
  });
}, 200);
*/

// слайдер галерея в новостях
$(".slider_gallery").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  respondTo: "window",
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
$(".slider_reviews").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  swipe: true,
  mobileFirst: true,
  respondTo: "window",
  responsive: [
    {
      breakpoint: 0,
      settings: {}
    },
    {
      breakpoint: 767,
      settings: "unslick"
    }
  ]
});


// слайдер в логотипе o_O


//Появляется после загрузки страницы
$(window).on('load', function () {
  
  $('.logo__slogan').fadeIn(400);
});
function merge_options(a, b){
    var merged = {};
    for (var attrname in a) { merged[attrname] = a[attrname]; }
    for (var attrname in b) { merged[attrname] = b[attrname]; }
    return merged;
}
$(function() {
	$(".slider_logo").slick(merge_options({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  dots: false,
	  arrows: false,
	  autoplay: true,
	  fade: true,
	  autoplaySpeed: 5000,
	  speed: 1000
	}, window.slogan_options === undefined ? {} : window.slogan_options));
});

// слайдеры в карточках
$(".product:not(.product_basket)").each(function(i, card) {
  var thumbs = $(card).find(".product__thumbs");
  var mainImg = $(card).find(".product__main-img");

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
  $(card).on("transitionend webkitTransitionEnd oTransitionEnd", function() {
    thumbs.slick("setPosition");
    mainImg.slick("setPosition");
  });
});

// поиск
$(".search__btn").click(function(e) {
  e.preventDefault();
  $(this)
    .parent()
    .toggleClass("is-open");
  $(this)
    .parent()
    .find(".search__input")
    .focus();
});

// разворачивание плавающих панелек справа
$(".floating__toggle").click(function() {
  $(this)
    .parent()
    .toggleClass("closed");
});

// попапы
$("[data-open-popup]").click(function(e) {
  e.preventDefault();
  var popupId = $(this).data("open-popup");
  if (popupId) {
    $(".modal-overlay").removeClass("closed");
    $('html').addClass('overflow-hidden');
    $(".modal#" + popupId).removeClass("closed");
    $(".modal#" + popupId)
      .find(".slick-slider")
      .each(function(i, sl) {
        $(sl).slick("setPosition");
      });
  }
});

$('body').on('change', '.js-form__field_more-file input', function(event) {
  var val = $(this).val();
  if (val != "") {
      $(this).closest('.js-form__field_more-file').next().addClass('opened');
  }
});

$(".modal__close").click(function() {
  $(".modal-overlay").addClass("closed");
  $(".modal").addClass("closed");
  $('html').removeClass('overflow-hidden');
});


$(window).keydown(function(e) {

  if ($('.modal#modal-feedback').hasClass('closed') == false && e.keyCode == 27) {
    $(".modal#modal-feedback").addClass("closed");
    $(".modal-overlay").addClass("closed");
    $('html').removeClass('overflow-hidden');
  }

});

$(window).keydown(function(e) {

  // console.log(e.keyCode);
  if ($('#modal-friends').hasClass('closed') == false && e.keyCode == 27) {
      $("#modal-friends").addClass("closed");
      $(".modal-overlay").addClass("closed");
      $('html').removeClass('overflow-hidden');
  }
});


$(".modal-overlay").click(function() {
  $(".modal-overlay").addClass("closed");
  $(".modal").addClass("closed");
  $('html').removeClass('overflow-hidden');
  mobile_menu_close();
});

// маски на формах
$.mask.definitions["9"] = "[0-9]";
$(".js-mask-phone").mask("+7 (999) 999-99-99");
$(".js-mask-date").mask("99.99.9999");
$(".phone-input input").mask("+7 (999) 999-99-99");
$(".phone-input input").attr("placeholder", "+7 (___) ___-__-__");

// мобильное меню
function mobile_menu_close() {
  $(".menu__burger").removeClass("is-opened");
  $(".menu_mobile .menu__container").removeClass("menu__container_opened");
  $(".modal-overlay").addClass("closed");
  $(".menu__submenu").removeClass("menu__submenu_opened");
}
function mobile_menu_open() {
  $(".menu__burger").addClass("is-opened");
  $(".menu_mobile .menu__container").addClass("menu__container_opened");
  $(".modal-overlay").removeClass("closed");
  $(".menu__submenu").removeClass("menu__submenu_opened");
}
$(".menu__burger").click(function(e) {
  if ($(this).hasClass("is-opened")) {
    mobile_menu_close();
  } else {
    mobile_menu_open();
  }
  e.stopPropagation();
});

$(".menu__link_parent").click(function(e) {
  e.preventDefault();
  $(this)
    .siblings(".menu__submenu")
    .toggleClass("menu__submenu_opened");
});

// выбор даты для личного калинета
$.datepicker.regional["ru"] = {
  closeText: "Закрыть",
  prevText: "&#x3c;Пред",
  nextText: "След&#x3e;",
  currentText: "Сегодня",
  monthNames: [
    "Январь",
    "Февраль",
    "Март",
    "Апрель",
    "Май",
    "Июнь",
    "Июль",
    "Август",
    "Сентябрь",
    "Октябрь",
    "Ноябрь",
    "Декабрь"
  ],
  monthNamesShort: [
    "Январь",
    "Февраль",
    "Март",
    "Апрель",
    "Май",
    "Июнь",
    "Июль",
    "Август",
    "Сентябрь",
    "Октябрь",
    "Ноябрь",
    "Декабрь"
  ],
  dayNames: [
    "воскресенье",
    "понедельник",
    "вторник",
    "среда",
    "четверг",
    "пятница",
    "суббота"
  ],
  dayNamesShort: ["вск", "пнд", "втр", "срд", "чтв", "птн", "сбт"],
  dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
  weekHeader: "Нед",
  dateFormat: "dd.mm.yy",
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ""
};

$(document).on("click", "#ajax_press", function() {
  var btn = $(this);
  var page = btn.attr("data-next-page");
  var id = btn.attr("data-show-more");
  var bx_ajax_id = btn.attr("data-ajax-id");
  var block_id = "#comp_" + bx_ajax_id;

  var data = {
    bxajaxid: bx_ajax_id
  };
  data["PAGEN_" + id] = page;

  $.ajax({
    type: "GET",
    url: window.location.href,
    data: data,
    timeout: 3000,
    success: function(data) {
      $("#btn_" + bx_ajax_id).remove();
      $(block_id).append(data);
      $(".friends__catalog-pagination a").removeClass(
        "pagination__link_current"
      );
      $(".friends__catalog-pagination a")
        .eq(page - 1)
        .addClass("pagination__link_current");
      setTimeout(function() {
        var item = $(".slider_friend");
        for (var i = 0; i < item.length; i++) {
          if (!item.eq(i).hasClass("slick-initialized")) {
            item.eq(i).slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: false,
              arrows: true
            });
          }
        }
      }, 500);
    }
  });
});

$(".js-datepicker").datepicker(
  $.extend(
    {
      inline: true,
      changeYear: true,
      changeMonth: true
    },
    $.datepicker.regional["ru"]
  )
);

// фиксированная шапка
$(window).scroll(function() {
  var fullHeaderHeight = $(".header").outerHeight();
  var topHeaderHight = $(".header__top").outerHeight();
  if ($(window).scrollTop() > topHeaderHight) {
    if (!$(".header").hasClass("header_fixed")) {
      $(".header").addClass("header_fixed");
      $(".page").css({ "padding-top": fullHeaderHeight + "px" });
    }
  } else {
    $(".header").removeClass("header_fixed");
    $(".page").removeClass("header_fixed");
    $(".slider_logo").slick("setPosition");
    $(".page").css({ "padding-top": 0 });
  }
});

// выбор стран в поле с телефоном
$(".js-phone-input").intlTelInput({
  autoHideDialCode: false,
  autoPlaceholder: "aggressive",
  initialCountry: "ru",
  preferredCountries: ["ru", "ua"]
});


function initJarallax(page, image, speed, position, imgSize) {

  $(page).css("background-image", "url(" + image + ")");

  $(page).jarallax({
    speed: speed,
    imgSize: imgSize,
    imgPosition: position,
    automaticResize: true
    // zIndex: 1000
  });
};



function addParallax (x) {

  if (x.matches) {
      
    //Главная
    initJarallax('.page.page__main', '/bitrix/templates/allacouture/i/parallax-bg.png', 0.8, 'cover', '100% auto');

    //Контакты
    initJarallax('.page.page__contacts', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.5, '99% top', '30% auto');

    //Друзья
    initJarallax('.page.page__friends', '/bitrix/templates/allacouture/i/promo-parallax.png', 1, '100% top', '30% auto');

    //Новости
    initJarallax('.page.page__news', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.6, '99% 22%', '30% auto');

    //Коллекции
    initJarallax('.page.page__collection', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.8, '99% 0%', '33% auto');

    //О нас 
    initJarallax('.page.page__about', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.8, '100% 30%', '25% auto');

    //Коллекции детальная
    initJarallax('.page.page__collection_detail', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.8, '100% 31%', '30% auto');

    //Новости детальная
    initJarallax('.page.page__news_detail', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.6, '100% 49%', '30% auto');


  }
};

var mobileWidth = window.matchMedia("(min-width: 768px)");

addParallax(mobileWidth);

mobileWidth.addListener(addParallax);

// $('.button-more--friends').click(function() {
//   initJarallax('.page.page__friends', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.5, '100% top', '30% auto');
  
// });



// $('.button-more--friends').on('click', function () {
//   initJarallax('.page.page__friends', '/bitrix/templates/allacouture/i/promo-parallax.png', 0.5, '100% top', '30% auto');
// })

// $('.page.page__friends').attr({ 'data-parallax': 'scroll', 'data-image': '/bitrix/templates/allacouture/i/promo-parallax.png' });

// $('.page.page__friends').parallax({imageSrc: '/bitrix/templates/allacouture/i/promo-parallax.png'});



$(".js-tipsy").tipsy({ fade: true, gravity: "s", html: true });

$(".footer__scroll-top-btn").on("click", function(event) {
  event.preventDefault();
  $("body,html").animate({ scrollTop: 0 }, 500);
});

var action_timer = {
  init: function() {
    var $timer = $(".js-action-timer");
    default_timer = 80768;
    if ($timer.length) {
      $timer.each(function() {
        var _self = $(this),
          time = _self.data("timer") ? _self.data("timer") : default_timer,
          id = _self.data("timer-id"),
          /*Удалить ниже строчку и убрать комменты для записи в localstorage*/
          remain_time = time;

        if (id) {
          /*if (localStorage.getItem("action-timer_"+ id)) {
            time = localStorage.getItem("action-timer_"+ id);
          }
          localStorage.setItem("action-timer_"+ id, time);*/

          var int = setInterval(function() {
            /* var remain_time= parseInt(localStorage.getItem("action-timer_"+ id))*/ remain_time =
              remain_time - 1;
            /*localStorage.setItem("action-timer_"+ id, remain_time);*/
            parseTime_bv(remain_time, _self);
            if (remain_time <= 0) {
              clearInterval(int);
            }
          }, 1000);
        }
      });
    }
    function parseTime_bv(timestamp, $obj) {
      if (timestamp < 0) timestamp = 0;

      var day = Math.floor(timestamp / 60 / 60 / 24);
      var hour = Math.floor(timestamp / 60 / 60);
      var mins = Math.floor((timestamp - hour * 60 * 60) / 60);
      var secs = Math.floor(timestamp - hour * 60 * 60 - mins * 60);
      var left_hour = Math.floor((timestamp - day * 24 * 60 * 60) / 60 / 60);

      $obj.find(".timer-hours").text(left_hour);

      if (String(mins).length > 1) $obj.find(".timer-mins").text(mins);
      else $obj.find(".timer-mins").text("0" + mins);
      if (String(secs).length > 1) $obj.find(".timer-secs").text(secs);
      else $obj.find(".timer-secs").text("0" + secs);
    }
  }
}.init();

var mCustomScrollbar = {
  init: function($obj) {
    var _self = this;

    var _this = $obj,
      axis = _this.data("axis") ? _this.data("axis") : "y";
    if (!_this.hasClass("mCustomScrollbar")) {
      var int = setInterval(function() {
        if (!_this.hasClass("slick-initialized")) {
          _this.mCustomScrollbar({
            axis: axis
          });
          clearInterval(int);
        }
      }, 500);
    }
  },
  destroy: function($obj) {
    var _self = this;
    if ($obj.hasClass("mCustomScrollbar")) {
      $obj.mCustomScrollbar("destroy");
    }
  },
  change: function($obj, visibility) {
    var _self = this,
      mediaQueryMatch = window.matchMedia("(max-width: 0px)"),
      handleMediaChange = function(mediaQueryList) {
        if (mediaQueryList.matches) {
          _self.destroy($obj);
        } else {
          _self.init($obj);
        }
      };

    // Крутой метод вместо window.width() < 768
    switch (visibility) {
      case "hidden-sm":
        mediaQueryMatch = window.matchMedia(
          "(max-width: " + breakpoints.medium + "px)"
        );
        mediaQueryMatch.addListener(handleMediaChange);
        break;
      case "visible-xs":
        mediaQueryMatch = window.matchMedia(
          "(min-width: " + breakpoints.small + "px)"
        );
        mediaQueryMatch.addListener(handleMediaChange);
        break;
      case "visible-sm":
        mediaQueryMatch = window.matchMedia(
          "(min-width: " + breakpoints.medium + "px)"
        );
        mediaQueryMatch.addListener(handleMediaChange);
        break;
      default:
        break;
    }

    handleMediaChange(mediaQueryMatch);
  },
  start: function() {
    var _self = this;

    var $block = $(".js-scroll");
    $block.each(function() {
      var _this = $(this);
      _self.init(_this);

      var my_visibility = _this.data("vis") ? _this.data("vis") : "all";
      // Запускаем проверку на изменение исходя из параметров
      $(window).on("resize", function() {
        _self.change(_this, my_visibility);
      });
    });
    // $(window).trigger('resize')
  }
}.start();

$(".text-block__expand").on("click", function() {
  $(this).fadeOut(300);
  $(".text-block__footer_mobile").fadeOut(300);
  $(".text-block__container").css("max-height", "none");
});

$(window).trigger("resize");

//Смена языка в хедере

$(document).ready(function() {
  $('.header__lang .lang-option.ru').hover(function() {
    $('.header__lang .lang-option.uk').css({

      // border: '2px #fff solid',
      overflow: 'visible',
      opacity: '1'


    });
  })

  $('.header__lang-wrapper').mouseleave(function() {
    $('.header__lang .lang-option.uk').css({

      // border: '2px #fff solid',
      overflow: 'hidden',
      opacity: '0'

    });
  });

  // var option = $(".header__lang .lang-option");
  // var hide = function() {
  //   $(".header__lang .lang-option.uk").css({
  //     display: "none"
  //   });
  // };

  // option.hover(function() {
  //   $(".header__lang .lang-option.uk").css({
  //     display: "flex"
  //   });
  // });

  // option.mouseleave(hide);
});


//Ограничение на колличество вводимых символов в текст друзей

// var friendTextBlock = $('.friend-card__hover p');

//     for(var i = 0; i <= friendTextBlock.length + 1; i++) {
//       console.log(friendTextBlock.eq(i));

//       var friendInner = friendTextBlock.eq(i).text();

//       var friendString = friendInner.slice(0,170); //Например, макс 170 символов
//       var a = friendString.split(' ');
//       a.splice(a.length - 1,1);
//       friendString = a.join(' ');
  
//       if(friendInner.length > 0) {
  
//         friendTextBlock.eq(i).text(friendString + ' ...');
//       }
//     }
  



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
    // inputs.focus(function (e) {
    //   $holder.hide();
    // })
    $('body').on('click change blur focus', _this, function() {
        if (_this.val() !== '' && !_this.is(':focus')) {
          $holder.hide();
        } else {
          if (_this.val() == '' && !_this.is(':focus')) {
            $holder.text(_this.data('placeholder')).show();
          }
          
        }
    })
  });
});
    
    
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}