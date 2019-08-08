/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/

onLoadjqm = function(name, hash, requestData, selector, requestTitle, isButton, thButton){

    $.each($(hash.t).get(0).attributes, function(index, attr){
      if(/^data\-autoload\-(.+)$/.test(attr.nodeName)){
        var key = attr.nodeName.match(/^data\-autoload\-(.+)$/)[1];
        var el = $('input[data-sid="'+key.toUpperCase()+'"]');
        // el.val( $(hash.t).data('autoload-'+key) ).attr('readonly', 'readonly');
        el.val(BX.util.htmlspecialcharsback($(hash.t).data('autoload-'+key))).attr('readonly', 'readonly');
        el.closest('.form-group').addClass('input-filed');
        el.attr('title', el.val());
      }
    });

    var $itemInfo = $(hash.t).parents('.footer_button').prev();
    var itemPriceEl = $itemInfo.find('.cost').html();

    //console.log($(hash.t));

    //show gift block
    if(hash.w.hasClass('send_gift_frame')||hash.w.hasClass('toorder_frame')||hash.w.hasClass('one_click_buy_frame'))
    {
      var imgHtml = priceHtml = propsHtml = '';
      if($('.offers_img a').length)
        imgHtml = $('.offers_img a').html();
      else if($('.item_main_info .item_slider:not(.flex) .slides li').length) {
        imgHtml = $('.item_main_info .item_slider .slides li:first a').html();
      } else {
        imgHtml = $(hash.t).parents('.footer_button').prev().prev().find('a').html();
      }

      if($('.item_main_info *[itemprop="offers"]').length) //show price
      {
        if($('.offers_img.wof').length || $('.prices_tab').length)
        {
          if($('.prices_block .price').length)
            priceHtml = $('.prices_block .cost.prices').html().replace('id', 'data-id');
        }
        else
        {
          if($('.prices_block .with_matrix').length)
            priceHtml = '<div class="with_matrix">'+$('.prices_block .with_matrix').html()+'</div>';
          else if($('.prices_block .price_group.min').length)
            priceHtml = $('.prices_block .price_group.min').html();
          else if($('.prices_block .price_matrix_wrapper').length)
            priceHtml = $('.prices_block .price_matrix_wrapper').html();
        }
      } else {
        priceHtml = 'Цена ' + $itemInfo.find('.cost').html();
      }

      // Item Title

      if ($(hash.t).hasClass('read_more1')) {
        itemTitle = $itemInfo.find('.item-title a').text()
      } else {
        itemTitle = $('h1').first().text();
      }

      if (one_click_buy_fast_view_params != 'undefined') {
        itemTitle = one_click_buy_fast_view_params.title;
        priceHtml = one_click_buy_fast_view_params.price;
        propsHtml = one_click_buy_fast_view_params.props;
      }
      if($('.buy_block .sku_props').length)
      {
        propsHtml = '<div class="props_item">';
        $('.buy_block .sku_props .bx_catalog_item_scu > div:not(".table_sizes")').each(function(){
          var title = $(this).find('.bx_item_section_name > span').html();
          propsHtml += '<div class="prop_item">'+
                  '<span>'+
                    title + (title.indexOf(':') > 0 ? '' : ': ')+
                    (title.indexOf(':') > 0 ? '' : '<span class="val">'+$(this).find('ul li.active > span').text()+'</span>')+
                  '</span>'+
                '</div>';

        })
        propsHtml += '</div>';
      }
      else if ($(hash.t).parents('.footer_button').find('.sku_props').length) {
        propsHtml = '<div class="props_item">';
        $(hash.t).parents('.footer_button').find('.sku_props .bx_catalog_item_scu > div:not(".table_sizes")').each(function(){
          var title = $(this).find('.bx_item_section_name > span').html();
          propsHtml += '<div class="prop_item">'+
                  '<span>'+
                    title + (title.indexOf(':') > 0 ? '' : ': ')+
                    (title.indexOf(':') > 0 ? '' : '<span class="val">'+$(this).find('ul li.active').html()+'</span>')+
                  '</span>'+
                '</div>';

        })
        propsHtml += '</div>';
      }

      if(hash.w.hasClass('send_gift_frame')){
        var subheader = '<div class="title">'+BX.message('POPUP_GIFT_TEXT')+'</div>';
      }else{
        var subheader = '';
      }
      $('<div class="custom_block">'+
        subheader+
        '<div class="item_block">'+
          '<table class="item_list"><tr>'+
            '<td class="image">'+
              '<div>'+imgHtml+'</div>'+
            '</td>'+
            '<td class="text">'+
              '<div class="name">'+itemTitle+'</div>'+
              priceHtml+
              propsHtml+
            '</td>'+
          '</tr></table>'+
        '</div>'+
        '</div>').prependTo(hash.w.find('.form_body'))
        if(hash.w.hasClass('one_click_buy_frame')){
      $('<div class="custom_block">'+
        subheader+
        '<div class="item_block">'+
          '<table class="item_list"><tr>'+
            '<td class="image">'+
              '<div>'+imgHtml+'</div>'+
            '</td>'+
            '<td class="text">'+
              '<div class="name">'+itemTitle+'</div>'+
              priceHtml+
              propsHtml+
            '</td>'+
          '</tr></table>'+
        '</div>'+
        '</div>').prependTo(hash.w.find('.form-wr'));
        }

    }

    if(arNextOptions['THEME']['REGIONALITY_SEARCH_ROW'] == 'Y' && (hash.w.hasClass('city_chooser_frame ') || hash.w.hasClass('city_chooser_small_frame')))
      hash.w.addClass('small_popup_regions')

    hash.w.addClass('show').css({
      'margin-left': ($(window).width() > hash.w.outerWidth() ? '-' + hash.w.outerWidth() / 2 + 'px' : '-' + $(window).width() / 2 + 'px'),
      // 'top': $(document).scrollTop() + (($(window).height() > hash.w.outerHeight() ? ($(window).height() - hash.w.outerHeight()) / 2 : 10))   + 'px',
      'top': (($(window).height() > hash.w.height()) ? Math.floor(($(window).height() - hash.w.height()) / 2) : 0) + 'px',
      'opacity': 1
    });

    var eventdata = {action:'loadForm'};
    BX.onCustomEvent('onCompleteAction', [eventdata, $(hash.t)[0]]);


    if(typeof(requestData) == 'undefined'){
      requestData = '';
    }
    if(typeof(selector) == 'undefined'){
      selector = false;
    }
    var width = $('.'+name+'_frame').width();
    $('.'+name+'_frame').css('margin-left', '-'+width/2+'px');

    if(name=='order-popup-call') {
    }
    else if(name=='order-button') {
      $(".order-button_frame").find("div[product_name]").find("input").val(hash.t.title).attr("readonly", "readonly").css({"overflow": "hidden", "text-overflow": "ellipsis"});
    }
    else if(name=='basket_error')
    {
      $(".basket_error_frame .pop-up-title").text(requestTitle);
      $(".basket_error_frame .ajax_text").html(requestData);

      if(window.matchMedia('(max-width: 991px)').matches)
      {
        $("body").addClass("all_viewed");
      }

      initSelects(document);
      if(isButton=="Y" && thButton)
        $("<div class='popup_button_basket_wr'><span class='popup_button_basket big_btn button' data-item="+thButton.data("item")+"><span class='btn btn-default'>"+BX.message("ERROR_BASKET_BUTTON")+"</span></span></div>").insertAfter($(".basket_error_frame .ajax_text"));
    }
    else if( name == 'one_click_buy') {
      $('#one_click_buy_form').submit( function() {
        if($('#one_click_buy_form').valid())
        {
          if($('.'+name+'_frame form input.error').length || $('.'+name+'_frame form textarea.error').length) {
            return false
          }
          else if(!$(this).find('#one_click_buy_form_button').hasClass('clicked')){

            if(!$(this).find('#one_click_buy_form_button').hasClass("clicked"))
              $(this).find('#one_click_buy_form_button').addClass("clicked");
            var form_url = $(this).attr('action');

            var bSend = true;
            if(window.renderRecaptchaById && window.asproRecaptcha && window.asproRecaptcha.key)
            {
              if(window.asproRecaptcha.params.recaptchaSize == 'invisible' && typeof grecaptcha != 'undefined')
              {
                if($('#one_click_buy_form').find('.g-recaptcha-response').val())
                {
                  // eventdata.form.submit();
                  bSend = true;
                }
                else
                {
                  grecaptcha.execute($('#one_click_buy_form').find('.g-recaptcha').data('widgetid'));
                  $(this).find('#one_click_buy_form_button').removeClass("clicked");
                  bSend = false;
                }
              }
            }
            if(bSend)
            {
              $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: 'POST',
                dataType: 'json',
                error: function(data) {
                  alert('Error connecting server');
                },
                success: function(data) {
                  if(data.result == 'Y'){
                    if(arNextOptions['COUNTERS']['USE_1CLICK_GOALS'] !== 'N'){
                      var eventdata = {goal: 'goal_1click_success'};
                      BX.onCustomEvent('onCounterGoals', [eventdata])
                    }

                    if(ocb_files.length)
                    {
                      var obData = new FormData(),
                        bHasFiles = false;
                      $.each( ocb_files, function( key, value ){
                        if(value)
                        {
                          bHasFiles = true;
                          obData.append( key+'_'+value.code , value[0] );
                        }
                      });
                      if(bHasFiles)
                      {
                        $.ajax({
                          url: form_url+'?uploadfiles&orderID='+data.message,
                          type: 'POST',
                          data: obData,
                          cache: false,
                          dataType: 'json',
                          processData: false, // Don't process the files
                          contentType: false, // this is string query
                          error: function(data, exception) {
                            if(data)
                            {
                              // if('statusText')
                              console.log(data);
                              console.log(exception);
                            }
                            alert('Error with files');
                          },
                          success: function( respond, textStatus, jqXHR ){
                            $('.one_click_buy_result').show();
                            $('.one_click_buy_result_success').show();
                            purchaseCounter(data.message, arNextOptions["COUNTERS"]["TYPE"]["ONE_CLICK"]);
                          }
                        })
                      }
                      else
                      {
                        $('.one_click_buy_result').show();
                        $('.one_click_buy_result_success').show();
                        purchaseCounter(data.message, arNextOptions["COUNTERS"]["TYPE"]["ONE_CLICK"]);
                      }
                    }
                    else
                    {
                      $('.one_click_buy_result').show();
                      $('.one_click_buy_result_success').show();
                      purchaseCounter(data.message, arNextOptions["COUNTERS"]["TYPE"]["ONE_CLICK"]);
                    }
                  }
                  else{
                    $('.one_click_buy_result').show();
                    $('.one_click_buy_result_fail').show();
                    if(('err' in data) && data.err)
                      data.message=data.message+' \n'+data.err;
                    $('.one_click_buy_result_text').html(data.message);
                  }
                  $('.one_click_buy_modules_button', self).removeClass('disabled');
                  $('#one_click_buy_form').hide();
                  $('#one_click_buy_form_result').show();
                }
              });
            }
          }
        }
        return false;
      });
    }
    else if( name == 'one_click_buy_basket') {
      $('#one_click_buy_form').on("submit", function(){
        if($('#one_click_buy_form').valid())
        {
          if($('.'+name+'_frame form input.error').length || $('.'+name+'_frame form textarea.error').length) {
            return false
          }
          else if(!$(this).find('#one_click_buy_form_button').hasClass('clicked')){

            if(!$(this).find('#one_click_buy_form_button').hasClass("clicked"))
              $(this).find('#one_click_buy_form_button').addClass("clicked");
            var form_url = $(this).attr('action');

            var bSend = true;
            if(window.renderRecaptchaById && window.asproRecaptcha && window.asproRecaptcha.key)
            {
              if(window.asproRecaptcha.params.recaptchaSize == 'invisible' && typeof grecaptcha != 'undefined')
              {
                if($('#one_click_buy_form').find('.g-recaptcha-response').val())
                {
                  // eventdata.form.submit();
                  bSend = true;
                }
                else
                {
                  grecaptcha.execute($('#one_click_buy_form').find('.g-recaptcha').data('widgetid'));
                  $(this).find('#one_click_buy_form_button').removeClass("clicked");
                  bSend = false;
                }
              }
            }
            if(bSend)
            {
              $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: 'POST',
                dataType: 'json',
                error: function(data) {
                  window.console&&console.log(data);
                },
                success: function(data) {
                  if(data.result == 'Y') {
                    if(arNextOptions['COUNTERS']['USE_FASTORDER_GOALS'] !== 'N'){
                      var eventdata = {goal: 'goal_fastorder_success'};
                      BX.onCustomEvent('onCounterGoals', [eventdata])
                    }

                    if(ocb_files.length)
                    {
                      var obData = new FormData(),
                        bHasFiles = false;
                      $.each( ocb_files, function( key, value ){
                        if(value)
                        {
                          bHasFiles = true;
                          obData.append( key+'_'+value.code , value[0] );
                        }
                      });
                      if(bHasFiles)
                      {
                        $.ajax({
                          url: form_url+'?uploadfiles&orderID='+data.message,
                          type: 'POST',
                          data: obData,
                          cache: false,
                          dataType: 'json',
                          processData: false, // Don't process the files
                          contentType: false, // this is string query
                          error: function(data) {
                            alert('Error with files');
                          },
                          success: function( respond, textStatus, jqXHR ){
                            $('.one_click_buy_result').show();
                            $('.one_click_buy_result_success').show();
                            purchaseCounter(data.message, arNextOptions["COUNTERS"]["TYPE"]["ONE_CLICK"]);
                          }
                        })
                      }
                      else
                      {
                        $('.one_click_buy_result').show();
                        $('.one_click_buy_result_success').show();
                        purchaseCounter(data.message, arNextOptions["COUNTERS"]["TYPE"]["ONE_CLICK"]);
                      }
                    }
                    else
                    {
                      $('.one_click_buy_result').show();
                      $('.one_click_buy_result_success').show();
                      purchaseCounter(data.message, arNextOptions["COUNTERS"]["TYPE"]["QUICK_ORDER"]);
                    }
                  }
                  else{
                    $('.one_click_buy_result').show();
                    $('.one_click_buy_result_fail').show();
                    if(('err' in data) && data.err)
                      data.message=data.message+' \n'+data.err;
                    $('.one_click_buy_result_text').text(data.message);
                  }
                  $('.one_click_buy_modules_button', self).removeClass('disabled');
                  $('#one_click_buy_form').hide();
                  $('#one_click_buy_form_result').show();
                }
              });
            }
          }
        }
        return false;
      });
    }

    //switchMasks();

    $('.'+name+'_frame').show();
  }

/*
 * International Telephone Input v12.1.0
 * https://github.com/jackocnr/intl-tel-input.git
 * Licensed under the MIT license
 */

!function(a){"function"==typeof define&&define.amd?define(["jquery"],function(b){a(b,window,document)}):"object"==typeof module&&module.exports?module.exports=a(require("jquery"),window,document):a(jQuery,window,document)}(function(a,b,c,d){"use strict";function e(b,c){this.a=a(b),this.b=a.extend({},h,c),this.ns="."+f+g++,this.d=Boolean(b.setSelectionRange),this.e=Boolean(a(b).attr("placeholder"))}var f="intlTelInput",g=1,h={allowDropdown:!0,autoHideDialCode:!0,autoPlaceholder:"polite",customPlaceholder:null,dropdownContainer:"",excludeCountries:[],formatOnDisplay:!0,geoIpLookup:null,hiddenInput:"",initialCountry:"",nationalMode:!0,onlyCountries:[],placeholderNumberType:"MOBILE",preferredCountries:["us","gb"],separateDialCode:!1,utilsScript:""},i={b:38,c:40,d:13,e:27,f:43,A:65,Z:90,j:32,k:9},j=["800","822","833","844","855","866","877","880","881","882","883","884","885","886","887","888","889"];a(b).on("load",function(){a.fn[f].windowLoaded=!0}),e.prototype={_a:function(){return this.b.nationalMode&&(this.b.autoHideDialCode=!1),this.b.separateDialCode&&(this.b.autoHideDialCode=this.b.nationalMode=!1),this.g=/Android.+Mobile|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),this.g&&(a("body").addClass("iti-mobile"),this.b.dropdownContainer||(this.b.dropdownContainer="body")),this.h=new a.Deferred,this.i=new a.Deferred,this.s={},this._b(),this._f(),this._h(),this._i(),this._i2(),[this.h,this.i]},_b:function(){this._d(),this._d2(),this._e()},_c:function(a,b,c){b in this.q||(this.q[b]=[]);var d=c||0;this.q[b][d]=a},_d:function(){if(this.b.onlyCountries.length){var a=this.b.onlyCountries.map(function(a){return a.toLowerCase()});this.p=k.filter(function(b){return a.indexOf(b.iso2)>-1})}else if(this.b.excludeCountries.length){var b=this.b.excludeCountries.map(function(a){return a.toLowerCase()});this.p=k.filter(function(a){return-1===b.indexOf(a.iso2)})}else this.p=k},_d2:function(){this.q={};for(var a=0;a<this.p.length;a++){var b=this.p[a];if(this._c(b.iso2,b.dialCode,b.priority),b.areaCodes)for(var c=0;c<b.areaCodes.length;c++)this._c(b.iso2,b.dialCode+b.areaCodes[c])}},_e:function(){this.preferredCountries=[];for(var a=0;a<this.b.preferredCountries.length;a++){var b=this.b.preferredCountries[a].toLowerCase(),c=this._y(b,!1,!0);c&&this.preferredCountries.push(c)}},_f:function(){this.a.attr("autocomplete","off");var b="intl-tel-input";this.b.allowDropdown&&(b+=" allow-dropdown"),this.b.separateDialCode&&(b+=" separate-dial-code"),this.a.wrap(a("<div>",{"class":b})),this.k=a("<div>",{"class":"flag-container"}).insertBefore(this.a);var c=a("<div>",{"class":"selected-flag"});c.appendTo(this.k),this.l=a("<div>",{"class":"iti-flag"}).appendTo(c),this.b.separateDialCode&&(this.t=a("<div>",{"class":"selected-dial-code"}).appendTo(c)),this.b.allowDropdown?(c.attr("tabindex","0"),a("<div>",{"class":"iti-arrow"}).appendTo(c),this.m=a("<ul>",{"class":"country-list hide"}),this.preferredCountries.length&&(this._g(this.preferredCountries,"preferred"),a("<li>",{"class":"divider"}).appendTo(this.m)),this._g(this.p,""),this.o=this.m.children(".country"),this.b.dropdownContainer?this.dropdown=a("<div>",{"class":"intl-tel-input iti-container"}).append(this.m):this.m.appendTo(this.k)):this.o=a(),this.b.hiddenInput&&(this.hiddenInput=a("<input>",{type:"hidden",name:this.b.hiddenInput}).insertBefore(this.a))},_g:function(a,b){for(var c="",d=0;d<a.length;d++){var e=a[d];c+="<li class='country "+b+"' data-dial-code='"+e.dialCode+"' data-country-code='"+e.iso2+"'>",c+="<div class='flag-box'><div class='iti-flag "+e.iso2+"'></div></div>",c+="<span class='country-name'>"+e.name+"</span>",c+="<span class='dial-code'>+"+e.dialCode+"</span>",c+="</li>"}this.m.append(c)},_h:function(){var a=this.a.val();this._af(a)&&(!this._isRegionlessNanp(a)||this.b.nationalMode&&!this.b.initialCountry)?this._v(a):"auto"!==this.b.initialCountry&&(this.b.initialCountry?this._z(this.b.initialCountry.toLowerCase()):(this.j=this.preferredCountries.length?this.preferredCountries[0].iso2:this.p[0].iso2,a||this._z(this.j)),a||this.b.nationalMode||this.b.autoHideDialCode||this.b.separateDialCode||this.a.val("+"+this.s.dialCode)),a&&this._u(a)},_i:function(){this._j(),this.b.autoHideDialCode&&this._l(),this.b.allowDropdown&&this._i1(),this.hiddenInput&&this._initHiddenInputListener()},_initHiddenInputListener:function(){var a=this,b=this.a.closest("form");b.length&&b.submit(function(){a.hiddenInput.val(a.getNumber())})},_i1:function(){var a=this,b=this.a.closest("label");b.length&&b.on("click"+this.ns,function(b){a.m.hasClass("hide")?a.a.focus():b.preventDefault()}),this.l.parent().on("click"+this.ns,function(b){!a.m.hasClass("hide")||a.a.prop("disabled")||a.a.prop("readonly")||a._n()}),this.k.on("keydown"+a.ns,function(b){!a.m.hasClass("hide")||b.which!=i.b&&b.which!=i.c&&b.which!=i.j&&b.which!=i.d||(b.preventDefault(),b.stopPropagation(),a._n()),b.which==i.k&&a._ac()})},_i2:function(){var c=this;this.b.utilsScript?a.fn[f].windowLoaded?a.fn[f].loadUtils(this.b.utilsScript,this.i):a(b).on("load",function(){a.fn[f].loadUtils(c.b.utilsScript,c.i)}):this.i.resolve(),"auto"===this.b.initialCountry?this._i3():this.h.resolve()},_i3:function(){a.fn[f].autoCountry?this.handleAutoCountry():a.fn[f].startedLoadingAutoCountry||(a.fn[f].startedLoadingAutoCountry=!0,"function"==typeof this.b.geoIpLookup&&this.b.geoIpLookup(function(b){a.fn[f].autoCountry=b.toLowerCase(),setTimeout(function(){a(".intl-tel-input input").intlTelInput("handleAutoCountry")})}))},_j:function(){var a=this;this.a.on("keyup"+this.ns,function(){a._v(a.a.val())&&a._triggerCountryChange()}),this.a.on("cut"+this.ns+" paste"+this.ns,function(){setTimeout(function(){a._v(a.a.val())&&a._triggerCountryChange()})})},_j2:function(a){var b=this.a.attr("maxlength");return b&&a.length>b?a.substr(0,b):a},_l:function(){var b=this;this.a.on("mousedown"+this.ns,function(a){b.a.is(":focus")||b.a.val()||(a.preventDefault(),b.a.focus())}),this.a.on("focus"+this.ns,function(a){b.a.val()||b.a.prop("readonly")||!b.s.dialCode||(b.a.val("+"+b.s.dialCode),b.a.one("keypress.plus"+b.ns,function(a){a.which==i.f&&b.a.val("")}),setTimeout(function(){var a=b.a[0];if(b.d){var c=b.a.val().length;a.setSelectionRange(c,c)}}))});var c=this.a.prop("form");c&&a(c).on("submit"+this.ns,function(){b._removeEmptyDialCode()}),this.a.on("blur"+this.ns,function(){b._removeEmptyDialCode()})},_removeEmptyDialCode:function(){var a=this.a.val();if("+"==a.charAt(0)){var b=this._m(a);b&&this.s.dialCode!=b||this.a.val("")}this.a.off("keypress.plus"+this.ns)},_m:function(a){return a.replace(/\D/g,"")},_n:function(){this._o();var a=this.m.children(".active");a.length&&(this._x(a),this._ad(a)),this._p(),this.l.children(".iti-arrow").addClass("up"),this.a.trigger("open:countrydropdown")},_o:function(){var c=this;if(this.b.dropdownContainer&&this.dropdown.appendTo(this.b.dropdownContainer),this.n=this.m.removeClass("hide").outerHeight(),!this.g){var d=this.a.offset(),e=d.top,f=a(b).scrollTop(),g=e+this.a.outerHeight()+this.n<f+a(b).height(),h=e-this.n>f;if(this.m.toggleClass("dropup",!g&&h),this.b.dropdownContainer){var i=!g&&h?0:this.a.innerHeight();this.dropdown.css({top:e+i,left:d.left}),a(b).on("scroll"+this.ns,function(){c._ac()})}}},_p:function(){var b=this;this.m.on("mouseover"+this.ns,".country",function(c){b._x(a(this))}),this.m.on("click"+this.ns,".country",function(c){b._ab(a(this))});var d=!0;a("html").on("click"+this.ns,function(a){d||b._ac(),d=!1});var e="",f=null;a(c).on("keydown"+this.ns,function(a){a.preventDefault(),a.which==i.b||a.which==i.c?b._q(a.which):a.which==i.d?b._r():a.which==i.e?b._ac():(a.which>=i.A&&a.which<=i.Z||a.which==i.j)&&(f&&clearTimeout(f),e+=String.fromCharCode(a.which),b._s(e),f=setTimeout(function(){e=""},1e3))})},_q:function(a){var b=this.m.children(".highlight").first(),c=a==i.b?b.prev():b.next();c.length&&(c.hasClass("divider")&&(c=a==i.b?c.prev():c.next()),this._x(c),this._ad(c))},_r:function(){var a=this.m.children(".highlight").first();a.length&&this._ab(a)},_s:function(a){for(var b=0;b<this.p.length;b++)if(this._t(this.p[b].name,a)){var c=this.m.children("[data-country-code="+this.p[b].iso2+"]").not(".preferred");this._x(c),this._ad(c,!0);break}},_t:function(a,b){return a.substr(0,b.length).toUpperCase()==b},_u:function(a){if(this.b.formatOnDisplay&&b.intlTelInputUtils&&this.s){var c=this.b.separateDialCode||!this.b.nationalMode&&"+"==a.charAt(0)?intlTelInputUtils.numberFormat.INTERNATIONAL:intlTelInputUtils.numberFormat.NATIONAL;a=intlTelInputUtils.formatNumber(a,this.s.iso2,c)}a=this._ah(a),this.a.val(a)},_v:function(b){b&&this.b.nationalMode&&"1"==this.s.dialCode&&"+"!=b.charAt(0)&&("1"!=b.charAt(0)&&(b="1"+b),b="+"+b);var c=this._af(b),d=null,e=this._m(b);if(c){var f=this.q[this._m(c)],g=a.inArray(this.s.iso2,f)>-1,h="+1"==c&&e.length>=4;if((!("1"==this.s.dialCode)||!this._isRegionlessNanp(e))&&(!g||h))for(var i=0;i<f.length;i++)if(f[i]){d=f[i];break}}else"+"==b.charAt(0)&&e.length?d="":b&&"+"!=b||(d=this.j);return null!==d&&this._z(d)},_isRegionlessNanp:function(b){var c=this._m(b);if("1"==c.charAt(0)){var d=c.substr(1,3);return a.inArray(d,j)>-1}return!1},_x:function(a){this.o.removeClass("highlight"),a.addClass("highlight")},_y:function(a,b,c){for(var d=b?k:this.p,e=0;e<d.length;e++)if(d[e].iso2==a)return d[e];if(c)return null;throw new Error("No country data for '"+a+"'")},_z:function(a){var b=this.s.iso2?this.s:{};this.s=a?this._y(a,!1,!1):{},this.s.iso2&&(this.j=this.s.iso2),this.l.attr("class","iti-flag "+a);var c=a?this.s.name+": +"+this.s.dialCode:"Unknown";if(this.l.parent().attr("title",c),this.b.separateDialCode){var d=this.s.dialCode?"+"+this.s.dialCode:"",e=this.a.parent();b.dialCode&&e.removeClass("iti-sdc-"+(b.dialCode.length+1)),d&&e.addClass("iti-sdc-"+d.length),this.t.text(d)}return this._aa(),this.o.removeClass("active"),a&&this.o.find(".iti-flag."+a).first().closest(".country").addClass("active"),b.iso2!==a},_aa:function(){var a="aggressive"===this.b.autoPlaceholder||!this.e&&(!0===this.b.autoPlaceholder||"polite"===this.b.autoPlaceholder);if(b.intlTelInputUtils&&a){var c=intlTelInputUtils.numberType[this.b.placeholderNumberType],d=this.s.iso2?intlTelInputUtils.getExampleNumber(this.s.iso2,this.b.nationalMode,c):"";d=this._ah(d),"function"==typeof this.b.customPlaceholder&&(d=this.b.customPlaceholder(d,this.s)),this.a.attr("placeholder",d)}},_ab:function(a){var b=this._z(a.attr("data-country-code"));if(this._ac(),this._ae(a.attr("data-dial-code"),!0),this.a.focus(),this.d){var c=this.a.val().length;this.a[0].setSelectionRange(c,c)}b&&this._triggerCountryChange()},_ac:function(){this.m.addClass("hide"),this.l.children(".iti-arrow").removeClass("up"),a(c).off(this.ns),a("html").off(this.ns),this.m.off(this.ns),this.b.dropdownContainer&&(this.g||a(b).off("scroll"+this.ns),this.dropdown.detach()),this.a.trigger("close:countrydropdown")},_ad:function(a,b){var c=this.m,d=c.height(),e=c.offset().top,f=e+d,g=a.outerHeight(),h=a.offset().top,i=h+g,j=h-e+c.scrollTop(),k=d/2-g/2;if(h<e)b&&(j-=k),c.scrollTop(j);else if(i>f){b&&(j+=k);var l=d-g;c.scrollTop(j-l)}},_ae:function(a,b){var c,d=this.a.val();if(a="+"+a,"+"==d.charAt(0)){var e=this._af(d);c=e?d.replace(e,a):a}else{if(this.b.nationalMode||this.b.separateDialCode)return;if(d)c=a+d;else{if(!b&&this.b.autoHideDialCode)return;c=a}}this.a.val(c)},_af:function(b){var c="";if("+"==b.charAt(0))for(var d="",e=0;e<b.length;e++){var f=b.charAt(e);if(a.isNumeric(f)&&(d+=f,this.q[d]&&(c=b.substr(0,e+1)),4==d.length))break}return c},_ag:function(){var b=a.trim(this.a.val()),c=this.s.dialCode,d=this._m(b),e="1"==d.charAt(0)?d:"1"+d;return(this.b.separateDialCode?"+"+c:"+"!=b.charAt(0)&&"1"!=b.charAt(0)&&c&&"1"==c.charAt(0)&&4==c.length&&c!=e.substr(0,4)?c.substr(1):"")+b},_ah:function(a){if(this.b.separateDialCode){var b=this._af(a);if(b){null!==this.s.areaCodes&&(b="+"+this.s.dialCode);var c=" "===a[b.length]||"-"===a[b.length]?b.length+1:b.length;a=a.substr(c)}}return this._j2(a)},_triggerCountryChange:function(){this.a.trigger("countrychange",this.s)},handleAutoCountry:function(){"auto"===this.b.initialCountry&&(this.j=a.fn[f].autoCountry,this.a.val()||this.setCountry(this.j),this.h.resolve())},handleUtils:function(){b.intlTelInputUtils&&(this.a.val()&&this._u(this.a.val()),this._aa()),this.i.resolve()},destroy:function(){if(this.allowDropdown&&(this._ac(),this.l.parent().off(this.ns),this.a.closest("label").off(this.ns)),this.b.autoHideDialCode){var b=this.a.prop("form");b&&a(b).off(this.ns)}this.a.off(this.ns),this.a.parent().before(this.a).remove()},getExtension:function(){return b.intlTelInputUtils?intlTelInputUtils.getExtension(this._ag(),this.s.iso2):""},getNumber:function(a){return b.intlTelInputUtils?intlTelInputUtils.formatNumber(this._ag(),this.s.iso2,a):""},getNumberType:function(){return b.intlTelInputUtils?intlTelInputUtils.getNumberType(this._ag(),this.s.iso2):-99},getSelectedCountryData:function(){return this.s},getValidationError:function(){return b.intlTelInputUtils?intlTelInputUtils.getValidationError(this._ag(),this.s.iso2):-99},isValidNumber:function(){var c=a.trim(this._ag()),d=this.b.nationalMode?this.s.iso2:"";return b.intlTelInputUtils?intlTelInputUtils.isValidNumber(c,d):null},setCountry:function(a){a=a.toLowerCase(),this.l.hasClass(a)||(this._z(a),this._ae(this.s.dialCode,!1),this._triggerCountryChange())},setNumber:function(a){var b=this._v(a);this._u(a),b&&this._triggerCountryChange()},setPlaceholderNumberType:function(a){this.b.placeholderNumberType=a,this._aa()}},a.fn[f]=function(b){var c=arguments;if(b===d||"object"==typeof b){var g=[];return this.each(function(){if(!a.data(this,"plugin_"+f)){var c=new e(this,b),d=c._a();g.push(d[0]),g.push(d[1]),a.data(this,"plugin_"+f,c)}}),a.when.apply(null,g)}if("string"==typeof b&&"_"!==b[0]){var h;return this.each(function(){var d=a.data(this,"plugin_"+f);d instanceof e&&"function"==typeof d[b]&&(h=d[b].apply(d,Array.prototype.slice.call(c,1))),"destroy"===b&&a.data(this,"plugin_"+f,null)}),h!==d?h:this}},a.fn[f].getCountryData=function(){return k},a.fn[f].loadUtils=function(b,c){a.fn[f].loadedUtilsScript?c&&c.resolve():(a.fn[f].loadedUtilsScript=!0,a.ajax({type:"GET",url:b,complete:function(){a(".intl-tel-input input").intlTelInput("handleUtils")},dataType:"script",cache:!0}))},a.fn[f].defaults=h,a.fn[f].version="12.1.0";for(var k=[["Afghanistan (‫افغانستان‬‎)","af","93"],["Albania (Shqipëri)","al","355"],["Algeria (‫الجزائر‬‎)","dz","213"],["American Samoa","as","1684"],["Andorra","ad","376"],["Angola","ao","244"],["Anguilla","ai","1264"],["Antigua and Barbuda","ag","1268"],["Argentina","ar","54"],["Armenia (Հայաստան)","am","374"],["Aruba","aw","297"],["Australia","au","61",0],["Austria (Österreich)","at","43"],["Azerbaijan (Azərbaycan)","az","994"],["Bahamas","bs","1242"],["Bahrain (‫البحرين‬‎)","bh","973"],["Bangladesh (বাংলাদেশ)","bd","880"],["Barbados","bb","1246"],["Belarus (Беларусь)","by","375"],["Belgium (België)","be","32"],["Belize","bz","501"],["Benin (Bénin)","bj","229"],["Bermuda","bm","1441"],["Bhutan (འབྲུག)","bt","975"],["Bolivia","bo","591"],["Bosnia and Herzegovina (Босна и Херцеговина)","ba","387"],["Botswana","bw","267"],["Brazil (Brasil)","br","55"],["British Indian Ocean Territory","io","246"],["British Virgin Islands","vg","1284"],["Brunei","bn","673"],["Bulgaria (България)","bg","359"],["Burkina Faso","bf","226"],["Burundi (Uburundi)","bi","257"],["Cambodia (កម្ពុជា)","kh","855"],["Cameroon (Cameroun)","cm","237"],["Canada","ca","1",1,["204","226","236","249","250","289","306","343","365","387","403","416","418","431","437","438","450","506","514","519","548","579","581","587","604","613","639","647","672","705","709","742","778","780","782","807","819","825","867","873","902","905"]],["Cape Verde (Kabu Verdi)","cv","238"],["Caribbean Netherlands","bq","599",1],["Cayman Islands","ky","1345"],["Central African Republic (République centrafricaine)","cf","236"],["Chad (Tchad)","td","235"],["Chile","cl","56"],["China (中国)","cn","86"],["Christmas Island","cx","61",2],["Cocos (Keeling) Islands","cc","61",1],["Colombia","co","57"],["Comoros (‫جزر القمر‬‎)","km","269"],["Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)","cd","243"],["Congo (Republic) (Congo-Brazzaville)","cg","242"],["Cook Islands","ck","682"],["Costa Rica","cr","506"],["Côte d’Ivoire","ci","225"],["Croatia (Hrvatska)","hr","385"],["Cuba","cu","53"],["Curaçao","cw","599",0],["Cyprus (Κύπρος)","cy","357"],["Czech Republic (Česká republika)","cz","420"],["Denmark (Danmark)","dk","45"],["Djibouti","dj","253"],["Dominica","dm","1767"],["Dominican Republic (República Dominicana)","do","1",2,["809","829","849"]],["Ecuador","ec","593"],["Egypt (‫مصر‬‎)","eg","20"],["El Salvador","sv","503"],["Equatorial Guinea (Guinea Ecuatorial)","gq","240"],["Eritrea","er","291"],["Estonia (Eesti)","ee","372"],["Ethiopia","et","251"],["Falkland Islands (Islas Malvinas)","fk","500"],["Faroe Islands (Føroyar)","fo","298"],["Fiji","fj","679"],["Finland (Suomi)","fi","358",0],["France","fr","33"],["French Guiana (Guyane française)","gf","594"],["French Polynesia (Polynésie française)","pf","689"],["Gabon","ga","241"],["Gambia","gm","220"],["Georgia (საქართველო)","ge","995"],["Germany (Deutschland)","de","49"],["Ghana (Gaana)","gh","233"],["Gibraltar","gi","350"],["Greece (Ελλάδα)","gr","30"],["Greenland (Kalaallit Nunaat)","gl","299"],["Grenada","gd","1473"],["Guadeloupe","gp","590",0],["Guam","gu","1671"],["Guatemala","gt","502"],["Guernsey","gg","44",1],["Guinea (Guinée)","gn","224"],["Guinea-Bissau (Guiné Bissau)","gw","245"],["Guyana","gy","592"],["Haiti","ht","509"],["Honduras","hn","504"],["Hong Kong (香港)","hk","852"],["Hungary (Magyarország)","hu","36"],["Iceland (Ísland)","is","354"],["India (भारत)","in","91"],["Indonesia","id","62"],["Iran (‫ایران‬‎)","ir","98"],["Iraq (‫العراق‬‎)","iq","964"],["Ireland","ie","353"],["Isle of Man","im","44",2],["Israel (‫ישראל‬‎)","il","972"],["Italy (Italia)","it","39",0],["Jamaica","jm","1876"],["Japan (日本)","jp","81"],["Jersey","je","44",3],["Jordan (‫الأردن‬‎)","jo","962"],["Kazakhstan (Казахстан)","kz","7",1],["Kenya","ke","254"],["Kiribati","ki","686"],["Kosovo","xk","383"],["Kuwait (‫الكويت‬‎)","kw","965"],["Kyrgyzstan (Кыргызстан)","kg","996"],["Laos (ລາວ)","la","856"],["Latvia (Latvija)","lv","371"],["Lebanon (‫لبنان‬‎)","lb","961"],["Lesotho","ls","266"],["Liberia","lr","231"],["Libya (‫ليبيا‬‎)","ly","218"],["Liechtenstein","li","423"],["Lithuania (Lietuva)","lt","370"],["Luxembourg","lu","352"],["Macau (澳門)","mo","853"],["Macedonia (FYROM) (Македонија)","mk","389"],["Madagascar (Madagasikara)","mg","261"],["Malawi","mw","265"],["Malaysia","my","60"],["Maldives","mv","960"],["Mali","ml","223"],["Malta","mt","356"],["Marshall Islands","mh","692"],["Martinique","mq","596"],["Mauritania (‫موريتانيا‬‎)","mr","222"],["Mauritius (Moris)","mu","230"],["Mayotte","yt","262",1],["Mexico (México)","mx","52"],["Micronesia","fm","691"],["Moldova (Republica Moldova)","md","373"],["Monaco","mc","377"],["Mongolia (Монгол)","mn","976"],["Montenegro (Crna Gora)","me","382"],["Montserrat","ms","1664"],["Morocco (‫المغرب‬‎)","ma","212",0],["Mozambique (Moçambique)","mz","258"],["Myanmar (Burma) (မြန်မာ)","mm","95"],["Namibia (Namibië)","na","264"],["Nauru","nr","674"],["Nepal (नेपाल)","np","977"],["Netherlands (Nederland)","nl","31"],["New Caledonia (Nouvelle-Calédonie)","nc","687"],["New Zealand","nz","64"],["Nicaragua","ni","505"],["Niger (Nijar)","ne","227"],["Nigeria","ng","234"],["Niue","nu","683"],["Norfolk Island","nf","672"],["North Korea (조선 민주주의 인민 공화국)","kp","850"],["Northern Mariana Islands","mp","1670"],["Norway (Norge)","no","47",0],["Oman (‫عُمان‬‎)","om","968"],["Pakistan (‫پاکستان‬‎)","pk","92"],["Palau","pw","680"],["Palestine (‫فلسطين‬‎)","ps","970"],["Panama (Panamá)","pa","507"],["Papua New Guinea","pg","675"],["Paraguay","py","595"],["Peru (Perú)","pe","51"],["Philippines","ph","63"],["Poland (Polska)","pl","48"],["Portugal","pt","351"],["Puerto Rico","pr","1",3,["787","939"]],["Qatar (‫قطر‬‎)","qa","974"],["Réunion (La Réunion)","re","262",0],["Romania (România)","ro","40"],["Russia (Россия)","ru","7",0],["Rwanda","rw","250"],["Saint Barthélemy","bl","590",1],["Saint Helena","sh","290"],["Saint Kitts and Nevis","kn","1869"],["Saint Lucia","lc","1758"],["Saint Martin (Saint-Martin (partie française))","mf","590",2],["Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)","pm","508"],["Saint Vincent and the Grenadines","vc","1784"],["Samoa","ws","685"],["San Marino","sm","378"],["São Tomé and Príncipe (São Tomé e Príncipe)","st","239"],["Saudi Arabia (‫المملكة العربية السعودية‬‎)","sa","966"],["Senegal (Sénégal)","sn","221"],["Serbia (Србија)","rs","381"],["Seychelles","sc","248"],["Sierra Leone","sl","232"],["Singapore","sg","65"],["Sint Maarten","sx","1721"],["Slovakia (Slovensko)","sk","421"],["Slovenia (Slovenija)","si","386"],["Solomon Islands","sb","677"],["Somalia (Soomaaliya)","so","252"],["South Africa","za","27"],["South Korea (대한민국)","kr","82"],["South Sudan (‫جنوب السودان‬‎)","ss","211"],["Spain (España)","es","34"],["Sri Lanka (ශ්‍රී ලංකාව)","lk","94"],["Sudan (‫السودان‬‎)","sd","249"],["Suriname","sr","597"],["Svalbard and Jan Mayen","sj","47",1],["Swaziland","sz","268"],["Sweden (Sverige)","se","46"],["Switzerland (Schweiz)","ch","41"],["Syria (‫سوريا‬‎)","sy","963"],["Taiwan (台灣)","tw","886"],["Tajikistan","tj","992"],["Tanzania","tz","255"],["Thailand (ไทย)","th","66"],["Timor-Leste","tl","670"],["Togo","tg","228"],["Tokelau","tk","690"],["Tonga","to","676"],["Trinidad and Tobago","tt","1868"],["Tunisia (‫تونس‬‎)","tn","216"],["Turkey (Türkiye)","tr","90"],["Turkmenistan","tm","993"],["Turks and Caicos Islands","tc","1649"],["Tuvalu","tv","688"],["U.S. Virgin Islands","vi","1340"],["Uganda","ug","256"],["Ukraine (Україна)","ua","380"],["United Arab Emirates (‫الإمارات العربية المتحدة‬‎)","ae","971"],["United Kingdom","gb","44",0],["United States","us","1",0],["Uruguay","uy","598"],["Uzbekistan (Oʻzbekiston)","uz","998"],["Vanuatu","vu","678"],["Vatican City (Città del Vaticano)","va","39",1],["Venezuela","ve","58"],["Vietnam (Việt Nam)","vn","84"],["Wallis and Futuna (Wallis-et-Futuna)","wf","681"],["Western Sahara (‫الصحراء الغربية‬‎)","eh","212",1],["Yemen (‫اليمن‬‎)","ye","967"],["Zambia","zm","260"],["Zimbabwe","zw","263"],["Åland Islands","ax","358",1]],l=0;l<k.length;l++){var m=k[l];k[l]={name:m[0],iso2:m[1],dialCode:m[2],priority:m[3]||0,areaCodes:m[4]||null}}});

function get_phonemask(cc) {
var phone = {"ac":"+247-####","ad":"+376-###-###","ae":"+971-5#-###-####","ae":"+971-#-###-####","af":"+93-##-###-####","ag":"+1(268)###-####","ai":"+1(264)###-####","al":"+355(###)###-###","am":"+374-##-###-###","an":"+599-###-####","an":"+599-###-####","an":"+599-9###-####","ao":"+244(###)###-###","aq":"+672-1##-###","ar":"+54(###)###-####","as":"+1(684)###-####","at":"+43(###)###-####","au":"+61-#-####-####","aw":"+297-###-####","az":"+994-##-###-##-##","ba":"+387-##-#####","ba":"+387-##-####","bb":"+1(246)###-####","bd":"+880-##-###-###","be":"+32(###)###-###","bf":"+226-##-##-####","bg":"+359(###)###-###","bh":"+973-####-####","bi":"+257-##-##-####","bj":"+229-##-##-####","bm":"+1(441)###-####","bn":"+673-###-####","bo":"+591-#-###-####","br":"+55-##-####-####","br":"+55-##-#####-####","bs":"+1(242)###-####","bt":"+975-17-###-###","bt":"+975-#-###-###","bw":"+267-##-###-###","by":"+375(##)###-##-##","bz":"+501-###-####","cd":"+243(###)###-###","cf":"+236-##-##-####","cg":"+242-##-###-####","ch":"+41-##-###-####","ci":"+225-##-###-###","ck":"+682-##-###","cl":"+56-#-####-####","cm":"+237-####-####","cn":"+86(###)####-####","cn":"+86(###)####-###","cn":"+86-##-#####-#####","co":"+57(###)###-####","cr":"+506-####-####","cu":"+53-#-###-####","cv":"+238(###)##-##","cw":"+599-###-####","cy":"+357-##-###-###","cz":"+420(###)###-###","de":"+49(####)###-####","de":"+49(###)###-####","de":"+49(###)##-####","de":"+49(###)##-###","de":"+49(###)##-##","de":"+49-###-###","dj":"+253-##-##-##-##","dk":"+45-##-##-##-##","dm":"+1(767)###-####","do":"+1(809)###-####","do":"+1(829)###-####","do":"+1(849)###-####","dz":"+213-##-###-####","ec":"+593-##-###-####","ec":"+593-#-###-####","ee":"+372-####-####","ee":"+372-###-####","eg":"+20(###)###-####","er":"+291-#-###-###","es":"+34(###)###-###","et":"+251-##-###-####","fi":"+358(###)###-##-##","fj":"+679-##-#####","fk":"+500-#####","fm":"+691-###-####","fo":"+298-###-###","fr":"+262-#####-####","fr":"+33(###)###-###","fr":"+508-##-####","fr":"+590(###)###-###","ga":"+241-#-##-##-##","gd":"+1(473)###-####","ge":"+995(###)###-###","gf":"+594-#####-####","gh":"+233(###)###-###","gi":"+350-###-#####","gl":"+299-##-##-##","gm":"+220(###)##-##","gn":"+224-##-###-###","gq":"+240-##-###-####","gr":"+30(###)###-####","gt":"+502-#-###-####","gu":"+1(671)###-####","gw":"+245-#-######","gy":"+592-###-####","hk":"+852-####-####","hn":"+504-####-####","hr":"+385-(##)-###-###","hr":"+385-(##)-###-####","hr":"+385-1-####-###","ht":"+509-##-##-####","hu":"+36(###)###-###","id":"+62(8##)###-####","id":"+62-##-###-##","id":"+62-##-###-###","id":"+62-##-###-####","id":"+62(8##)###-###","id":"+62(8##)###-##-###","ie":"+353(###)###-###","il":"+972-5#-###-####","il":"+972-#-###-####","in":"+91(####)###-###","io":"+246-###-####","iq":"+964(###)###-####","ir":"+98(###)###-####","is":"+354-###-####","it":"+39(###)####-###","jm":"+1(876)###-####","jo":"+962-#-####-####","jp":"+81-##-####-####","jp":"+81(###)###-###","ke":"+254-###-######","kg":"+996(###)###-###","kh":"+855-##-###-###","ki":"+686-##-###","km":"+269-##-#####","kn":"+1(869)###-####","kp":"+850-191-###-####","kp":"+850-##-###-###","kp":"+850-###-####-###","kp":"+850-###-###","kp":"+850-####-####","kp":"+850-####-#############","kr":"+82-##-###-####","kw":"+965-####-####","ky":"+1(345)###-####","kz":"+7(6##)###-##-##","kz":"+7(7##)###-##-##","la":"+856(20##)###-###","la":"+856-##-###-###","lb":"+961-##-###-###","lb":"+961-#-###-###","lc":"+1(758)###-####","li":"+423(###)###-####","lk":"+94-##-###-####","lr":"+231-##-###-###","ls":"+266-#-###-####","lt":"+370(###)##-###","lu":"+352-###-###","lu":"+352-####-###","lu":"+352-#####-###","lu":"+352-######-###","lv":"+371-##-###-###","ly":"+218-##-###-###","ly":"+218-21-###-####","ma":"+212-##-####-###","mc":"+377(###)###-###","mc":"+377-##-###-###","md":"+373-####-####","me":"+382-##-###-###","mg":"+261-##-##-#####","mh":"+692-###-####","mk":"+389-##-###-###","ml":"+223-##-##-####","mm":"+95-##-###-###","mm":"+95-#-###-###","mm":"+95-###-###","mn":"+976-##-##-####","mo":"+853-####-####","mp":"+1(670)###-####","mq":"+596(###)##-##-##","mr":"+222-##-##-####","ms":"+1(664)###-####","mt":"+356-####-####","mu":"+230-###-####","mv":"+960-###-####","mw":"+265-1-###-###","mw":"+265-#-####-####","mx":"+52(###)###-####","mx":"+52-##-##-####","my":"+60-##-###-####","my":"+60-11-####-####","my":"+60(###)###-###","my":"+60-##-###-###","my":"+60-#-###-###","mz":"+258-##-###-###","na":"+264-##-###-####","nc":"+687-##-####","ne":"+227-##-##-####","nf":"+672-3##-###","ng":"+234(###)###-####","ng":"+234-##-###-###","ng":"+234-##-###-##","ng":"+234(###)###-####","ni":"+505-####-####","nl":"+31-##-###-####","no":"+47(###)##-###","np":"+977-##-###-###","nr":"+674-###-####","nu":"+683-####","nz":"+64(###)###-###","nz":"+64-##-###-###","nz":"+64(###)###-####","om":"+968-##-###-###","pa":"+507-###-####","pe":"+51(###)###-###","pf":"+689-##-##-##","pg":"+675(###)##-###","ph":"+63(###)###-####","pk":"+92(###)###-####","pl":"+48(###)###-###","ps":"+970-##-###-####","pt":"+351-##-###-####","pw":"+680-###-####","py":"+595(###)###-###","qa":"+974-####-####","re":"+262-#####-####","ro":"+40-##-###-####","rs":"+381-##-###-####","ru":"+7(###)###-##-##","rw":"+250(###)###-###","sa":"+966-5-####-####","sa":"+966-#-###-####","sb":"+677-###-####","sb":"+677-#####","sc":"+248-#-###-###","sd":"+249-##-###-####","se":"+46-##-###-####","sg":"+65-####-####","sh":"+290-####","sh":"+290-####","si":"+386-##-###-###","sk":"+421(###)###-###","sl":"+232-##-######","sm":"+378-####-######","sn":"+221-##-###-####","so":"+252-##-###-###","so":"+252-#-###-###","so":"+252-#-###-###","sr":"+597-###-####","sr":"+597-###-###","ss":"+211-##-###-####","st":"+239-##-#####","sv":"+503-##-##-####","sx":"+1(721)###-####","sy":"+963-##-####-###","sz":"+268-##-##-####","tc":"+1(649)###-####","td":"+235-##-##-##-##","tg":"+228-##-###-###","th":"+66-##-###-####","th":"+66-##-###-###","tj":"+992-##-###-####","tk":"+690-####","tl":"+670-###-####","tl":"+670-77#-#####","tl":"+670-78#-#####","tm":"+993-#-###-####","tn":"+216-##-###-###","to":"+676-#####","tr":"+90(###)###-####","tt":"+1(868)###-####","tv":"+688-90####","tv":"+688-2####","tw":"+886-#-####-####","tw":"+886-####-####","tz":"+255-##-###-####","ua":"+380(##)###-##-##","ug":"+256(###)###-###","uk":"+44-##-####-####","uy":"+598-#-###-##-##","uz":"+998-##-###-####","va":"+39-6-698-#####","vc":"+1(784)###-####","ve":"+58(###)###-####","vg":"+1(284)###-####","vi":"+1(340)###-####","vn":"+84-##-####-###","vn":"+84(###)####-###","vu":"+678-##-#####","vu":"+678-#####","wf":"+681-##-####","ws":"+685-##-####","ye":"+967-###-###-###","ye":"+967-#-###-###","ye":"+967-##-###-###","za":"+27-##-###-####","zm":"+260-##-###-####","zw":"+263-#-######","us":"+1(###)###-####"};
  return phone[cc] ? phone[cc] : phone['ru'];
}

function switchMasks() {
  // $("input.phone").inputmask('remove');

  $("input.phone").intlTelInput({
    autoHideDialCode: false,
    autoPlaceholder: "aggressive",
    initialCountry: "ru",
    preferredCountries: ["ru", "ua"],
    utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/13.0.3/js/utils.js',
    // autoFormat: true,
    formatOnDisplay: true,
    // placeholderNumberType: "FIXED_LINE",
    nationalMode: false
  });

  $("input.phone").on("countrychange", function(e, countryData) {
    $(this).val('');
    var phonemask = get_phonemask(countryData["iso2"]);
    Inputmask.extendDefinitions({
      '9': {
        "validator": ""
      },
      '#': {
        "validator": "[0-9]"
      },
    });
    $("input.phone").inputmask('remove');
    $(this).inputmask(phonemask);
    $(this).blur();
    $(this).focus();
  });
}

$('body').on('input', 'textarea', textareaResize);

function textareaResize() {
  var el = $(this);
  $(this).outerHeight('4em');
  $(this).outerHeight($(this)[0].scrollHeight + 'px');
}

$(document).ready(function() {

  switchMasks();
  $.datepicker.regional['ru'] = {
      closeText: 'Закрыть',
      prevText: '<Пред',
      nextText: 'След>',
      currentText: 'Сегодня',
      monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
      'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
      monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
      'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
      dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
      dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
      dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
      weekHeader: 'Нед',
      dateFormat: 'yy-mm-dd',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: '',
      showButtonPanel: true,
      changeYear: true
  };


});
/*$(function () {
            $('.birfday').datepicker($.extend({
                inline: true,
                changeYear: true,
                changeMonth: true,
            },
             $.datepicker.regional['ru']
           ));
        });
preg_match("#^/online/([\.\-0-9a-zA-Z]+)(/?)([^/]*)#", $GLOBALS['APPLICATION']->GetCurPage(0))
*/



BX.ajax.UpdatePageNavChain = function(nav_chain)
{
  var obNavChain = BX('navigation');
  if (obNavChain)
  {
    obNavChain.innerHTML = nav_chain;
  }
  $('.breadcrumbs > [itemprop="itemListElement"]:last-child > span > span').html($('h1#pagetitle').html().trim());
};

if(!funcDefined('initSelects')){
  function initSelects(target){
    var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
    if ( iOS ) return;
    if($("#bx-soa-order").length)
      return;
    // SELECT STYLING
    var clicked = [];
    $(target).find('.wrapper1 .iblock:not(.select-multiple) select:visible').ikSelect({
      syntax: '<div class="ik_select_link"> \
            <span class="ik_select_link_text"></span> \
            <div class="trigger"></div> \
          </div> \
          <div class="ik_select_dropdown"> \
            <div class="ik_select_list"> \
            </div> \
          </div>',
      dynamicWidth: true,
      ddMaxHeight: 112,
      customClass: 'common_select',
      //equalWidths: true,
      onShow: function(inst){
        inst.$dropdown.css('top', (parseFloat(inst.$dropdown.css('top'))-5)+'px');
        if ( inst.$dropdown.outerWidth() < inst.$link.outerWidth() ){
          inst.$dropdown.css('width', inst.$link.outerWidth());
        }
        if ( inst.$dropdown.outerWidth() > inst.$link.outerWidth() ){
          inst.$dropdown.css('width', inst.$link.outerWidth());
        }
        console.log(inst);
        var count=0,
          client_height=0;
        inst.$dropdown.css('left', inst.$link.offset().left);
        $(inst.$listInnerUl).find('li').each(function(){
          if(!$(this).hasClass('ik_select_option_disabled')){
            ++count;
            client_height+=$(this).outerHeight();
          }
        })
        if(client_height<112){
          inst.$listInner.css('height', 'auto');
        }else{
          inst.$listInner.css('height', '112px');
        }
        inst.$link.addClass('opened');
        inst.$listInner.addClass('scroller');
        if($('.confirm_region').length)
          $('.confirm_region').remove();
      },
      onHide: function(inst){
        inst.$link.removeClass('opened');
      }
    });
    // END OF SELECT STYLING

    var timeout;
    $(window).on('resize', function(){
      ignoreResize.push(true);
        clearTimeout(timeout);
        timeout = setTimeout(function(){
          //$('select:visible').ikSelect('redraw');
          var inst='';
          if(inst=$('.common_select-link.opened + select').ikSelect().data('plugin_ikSelect')){
            inst.$dropdown.css('left', inst.$link.offset().left+'px');
          }
        }, 20);
      ignoreResize.pop();
    });
  }
}

// $(document).ready(function() {
//   // Multiple

//   $('.select-multiple select:visible').on('change', function() {
//     var $options = $(this).find('option');

//     $($(this).val()).each(function(index, item) {
//       $('select option[value="'+ item +'"]').css('background-color', '#000000');
//     });
//   });
// });

$(document).ready(function () {
  if ($('.wrap_basket .compare span.count').text() == '0') $('.wrap_basket .compare span.count').addClass('empted');
  $('.wrap_icon.wrap_basket').children('style').remove();
  $('#mobileheader').on('click', '.svg-inline-compare', function (e) {
    e.preventDefault();
    e.stopPropagation();
    window.open(window.location.protocol + '//' + window.location.hostname + '/catalog/compare.php',"_self")
  });
  function changeGoogleStyles() {
    if(($goog = $('.goog-te-menu-frame').contents().find('head')).length) {
      var stylesHtml = '<style>'+
          'body{' +
          'overflow: auto !important;' +
          '}' +
          '.goog-te-menu2 {'+
          'max-width:100% !important;'+
          'width:100% !important;'+
          'overflow:scroll !important;'+
          'box-sizing:border-box !important;'+
          'height:' + window.innerHeight + 'px !important;'+
          '}'+
          '.goog-te-menu2-colpad {' +
          'display: none;' +
          '}' +
          '</style>';
      $goog.prepend(stylesHtml);
    } else {
      setTimeout(changeGoogleStyles, 50);
    }
  }
  if (!(window.matchMedia('screen and (min-width: 768px)').matches)) {
    $('<style>.goog-te-menu-frame.skiptranslate{height: ' + window.innerHeight + 'px !important;}</style>').appendTo('head');
    changeGoogleStyles();
  }
  $('body').on('click', '#google_translate_element', function(){
    $('.goog-te-menu-frame').each(function() {
      var googContents = $(this).contents();
      if (googContents.find('td').length > 2) {
        googContents.find('.goog-te-menu2-colpad').each(function(){$(this).remove()});
        var googTd = googContents.find('td');
        for (i = 1; i < 5; ++i){
          $(googTd[i]).find('a').appendTo($(googTd[0]));
          $(googTd[i]).remove();
        }
        for (i = 6; i < 10; ++i){
          $(googTd[i]).find('a').appendTo($(googTd[5]));
          $(googTd[i]).remove();
        }
      }
    });
  });
  function fixAlterGoogleTranslate() {
    var font = $('.wrap_icon.wrap_basket').children('font');
    if (font.length) {
      font.children('a').each(function(){
        var notTranslatedA = $(this);
        var className = $(this).attr('class');
        font.siblings('a').each(function () {
          if ($(this).hasClass(className)) {
            $(this).find('span.count').html(notTranslatedA.find('span.count').html());
          }
        });
      });
      font.remove();
    }
  }
  var mo = new MutationObserver(fixAlterGoogleTranslate),
      options = {
        // обязательный параметр: наблюдаем за добавлением и удалением дочерних элементов.
        'childList': true
      };
  mo.observe(document.querySelector('.wrap_icon.wrap_basket'), options);
});