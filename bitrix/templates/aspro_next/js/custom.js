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
  $('.breadcrumbs > [itemprop="itemListElement"]:last-child > span > span').html($('h1#pagetitle').html());
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


/**
 * bxSlider v4.2.1d
 * Copyright 2013-2017 Steven Wanderski
 * Written while drinking Belgian ales and listening to jazz
 * Licensed under MIT (http://opensource.org/licenses/MIT)
 */
!function(t){var e={mode:"horizontal",slideSelector:"",infiniteLoop:!0,hideControlOnEnd:!1,speed:500,easing:null,slideMargin:0,startSlide:0,randomStart:!1,captions:!1,ticker:!1,tickerHover:!1,adaptiveHeight:!1,adaptiveHeightSpeed:500,video:!1,useCSS:!0,preloadImages:"visible",responsive:!0,slideZIndex:50,wrapperClass:"bx-wrapper",touchEnabled:!0,swipeThreshold:50,oneToOneTouch:!0,preventDefaultSwipeX:!0,preventDefaultSwipeY:!1,ariaLive:!0,ariaHidden:!0,keyboardEnabled:!1,pager:!0,pagerType:"full",pagerShortSeparator:" / ",pagerSelector:null,buildPager:null,pagerCustom:null,controls:!0,nextText:"Next",prevText:"Prev",nextSelector:null,prevSelector:null,autoControls:!1,startText:"Start",stopText:"Stop",autoControlsCombine:!1,autoControlsSelector:null,auto:!1,pause:4e3,autoStart:!0,autoDirection:"next",stopAutoOnClick:!1,autoHover:!1,autoDelay:0,autoSlideForOnePage:!1,minSlides:1,maxSlides:1,moveSlides:0,slideWidth:0,shrinkItems:!1,onSliderLoad:function(){return!0},onSlideBefore:function(){return!0},onSlideAfter:function(){return!0},onSlideNext:function(){return!0},onSlidePrev:function(){return!0},onSliderResize:function(){return!0},onAutoChange:function(){return!0}};t.fn.bxSlider=function(n){if(0===this.length)return this;if(this.length>1)return this.each(function(){t(this).bxSlider(n)}),this;var s={},o=this,r=t(window).width(),a=t(window).height();if(!t(o).data("bxSlider")){var l=function(){t(o).data("bxSlider")||(s.settings=t.extend({},e,n),s.settings.slideWidth=parseInt(s.settings.slideWidth),s.children=o.children(s.settings.slideSelector),s.children.length<s.settings.minSlides&&(s.settings.minSlides=s.children.length),s.children.length<s.settings.maxSlides&&(s.settings.maxSlides=s.children.length),s.settings.randomStart&&(s.settings.startSlide=Math.floor(Math.random()*s.children.length)),s.active={index:s.settings.startSlide},s.carousel=s.settings.minSlides>1||s.settings.maxSlides>1,s.carousel&&(s.settings.preloadImages="all"),s.minThreshold=s.settings.minSlides*s.settings.slideWidth+(s.settings.minSlides-1)*s.settings.slideMargin,s.maxThreshold=s.settings.maxSlides*s.settings.slideWidth+(s.settings.maxSlides-1)*s.settings.slideMargin,s.working=!1,s.controls={},s.interval=null,s.animProp="vertical"===s.settings.mode?"top":"left",s.usingCSS=s.settings.useCSS&&"fade"!==s.settings.mode&&function(){for(var t=document.createElement("div"),e=["WebkitPerspective","MozPerspective","OPerspective","msPerspective"],i=0;i<e.length;i++)if(void 0!==t.style[e[i]])return s.cssPrefix=e[i].replace("Perspective","").toLowerCase(),s.animProp="-"+s.cssPrefix+"-transform",!0;return!1}(),"vertical"===s.settings.mode&&(s.settings.maxSlides=s.settings.minSlides),o.data("origStyle",o.attr("style")),o.children(s.settings.slideSelector).each(function(){t(this).data("origStyle",t(this).attr("style"))}),d())},d=function(){var e=s.children.eq(s.settings.startSlide);o.wrap('<div class="'+s.settings.wrapperClass+'"><div class="bx-viewport"></div></div>'),s.viewport=o.parent(),s.settings.ariaLive&&!s.settings.ticker&&s.viewport.attr("aria-live","polite"),s.loader=t('<div class="bx-loading" />'),s.viewport.prepend(s.loader),o.css({width:"horizontal"===s.settings.mode?1e3*s.children.length+215+"%":"auto",position:"relative"}),s.usingCSS&&s.settings.easing?o.css("-"+s.cssPrefix+"-transition-timing-function",s.settings.easing):s.settings.easing||(s.settings.easing="swing"),s.viewport.css({width:"100%",overflow:"hidden",position:"relative"}),s.viewport.parent().css({maxWidth:u()}),s.children.css({float:"horizontal"===s.settings.mode?"left":"none",listStyle:"none",position:"relative"}),s.children.css("width",h()),"horizontal"===s.settings.mode&&s.settings.slideMargin>0&&s.children.css("marginRight",s.settings.slideMargin),"vertical"===s.settings.mode&&s.settings.slideMargin>0&&s.children.css("marginBottom",s.settings.slideMargin),"fade"===s.settings.mode&&(s.children.css({position:"absolute",zIndex:0,display:"none"}),s.children.eq(s.settings.startSlide).css({zIndex:s.settings.slideZIndex,display:"block"})),s.controls.el=t('<div class="bx-controls" />'),s.settings.captions&&k(),s.active.last=s.settings.startSlide===f()-1,s.settings.video&&o.fitVids(),"none"===s.settings.preloadImages?e=null:("all"===s.settings.preloadImages||s.settings.ticker)&&(e=s.children),s.settings.ticker?s.settings.pager=!1:(s.settings.controls&&C(),s.settings.auto&&s.settings.autoControls&&T(),s.settings.pager&&b(),(s.settings.controls||s.settings.autoControls||s.settings.pager)&&s.viewport.after(s.controls.el)),null===e?g():c(e,g)},c=function(e,i){var n=e.find('img:not([src=""]), iframe').length,s=0;if(0===n)return void i();e.find('img:not([src=""]), iframe').each(function(){t(this).one("load error",function(){++s===n&&i()}).each(function(){(this.complete||""==this.src)&&t(this).trigger("load")})})},g=function(){if(s.settings.infiniteLoop&&"fade"!==s.settings.mode&&!s.settings.ticker){var e="vertical"===s.settings.mode?s.settings.minSlides:s.settings.maxSlides,i=s.children.slice(0,e).clone(!0).addClass("bx-clone"),n=s.children.slice(-e).clone(!0).addClass("bx-clone");s.settings.ariaHidden&&(i.attr("aria-hidden",!0),n.attr("aria-hidden",!0)),o.append(i).prepend(n)}s.loader.remove(),m(),"vertical"===s.settings.mode&&(s.settings.adaptiveHeight=!0),s.viewport.height(p()),o.redrawSlider(),s.settings.onSliderLoad.call(o,s.active.index),s.initialized=!0,s.settings.responsive&&t(window).on("resize",U),s.settings.auto&&s.settings.autoStart&&(f()>1||s.settings.autoSlideForOnePage)&&L(),s.settings.ticker&&O(),s.settings.pager&&z(s.settings.startSlide),s.settings.controls&&q(),s.settings.touchEnabled&&!s.settings.ticker&&X(),s.settings.keyboardEnabled&&!s.settings.ticker&&t(document).keydown(B)},p=function(){var e=0,n=t();if("vertical"===s.settings.mode||s.settings.adaptiveHeight)if(s.carousel){var o=1===s.settings.moveSlides?s.active.index:s.active.index*x();for(n=s.children.eq(o),i=1;i<=s.settings.maxSlides-1;i++)n=o+i>=s.children.length?n.add(s.children.eq(i-1)):n.add(s.children.eq(o+i))}else n=s.children.eq(s.active.index);else n=s.children;return"vertical"===s.settings.mode?(n.each(function(i){e+=t(this).outerHeight()}),s.settings.slideMargin>0&&(e+=s.settings.slideMargin*(s.settings.minSlides-1))):e=Math.max.apply(Math,n.map(function(){return t(this).outerHeight(!1)}).get()),"border-box"===s.viewport.css("box-sizing")?e+=parseFloat(s.viewport.css("padding-top"))+parseFloat(s.viewport.css("padding-bottom"))+parseFloat(s.viewport.css("border-top-width"))+parseFloat(s.viewport.css("border-bottom-width")):"padding-box"===s.viewport.css("box-sizing")&&(e+=parseFloat(s.viewport.css("padding-top"))+parseFloat(s.viewport.css("padding-bottom"))),e},u=function(){var t="100%";return s.settings.slideWidth>0&&(t="horizontal"===s.settings.mode?s.settings.maxSlides*s.settings.slideWidth+(s.settings.maxSlides-1)*s.settings.slideMargin:s.settings.slideWidth),t},h=function(){var t=s.settings.slideWidth,e=s.viewport.width();if(0===s.settings.slideWidth||s.settings.slideWidth>e&&!s.carousel||"vertical"===s.settings.mode)t=e;else if(s.settings.maxSlides>1&&"horizontal"===s.settings.mode){if(e>s.maxThreshold)return t;e<s.minThreshold?t=(e-s.settings.slideMargin*(s.settings.minSlides-1))/s.settings.minSlides:s.settings.shrinkItems&&(t=Math.floor((e+s.settings.slideMargin)/Math.ceil((e+s.settings.slideMargin)/(t+s.settings.slideMargin))-s.settings.slideMargin))}return t},v=function(){var t=1,e=null;return"horizontal"===s.settings.mode&&s.settings.slideWidth>0?s.viewport.width()<s.minThreshold?t=s.settings.minSlides:s.viewport.width()>s.maxThreshold?t=s.settings.maxSlides:(e=s.children.first().width()+s.settings.slideMargin,t=Math.floor((s.viewport.width()+s.settings.slideMargin)/e)||1):"vertical"===s.settings.mode&&(t=s.settings.minSlides),t},f=function(){var t=0,e=0,i=0;if(s.settings.moveSlides>0){if(!s.settings.infiniteLoop){for(;e<s.children.length;)++t,e=i+v(),i+=s.settings.moveSlides<=v()?s.settings.moveSlides:v();return i}t=Math.ceil(s.children.length/x())}else t=Math.ceil(s.children.length/v());return t},x=function(){return s.settings.moveSlides>0&&s.settings.moveSlides<=v()?s.settings.moveSlides:v()},m=function(){var t,e,i;s.children.length>s.settings.maxSlides&&s.active.last&&!s.settings.infiniteLoop?"horizontal"===s.settings.mode?(e=s.children.last(),t=e.position(),S(-(t.left-(s.viewport.width()-e.outerWidth())),"reset",0)):"vertical"===s.settings.mode&&(i=s.children.length-s.settings.minSlides,t=s.children.eq(i).position(),S(-t.top,"reset",0)):(t=s.children.eq(s.active.index*x()).position(),s.active.index===f()-1&&(s.active.last=!0),void 0!==t&&("horizontal"===s.settings.mode?S(-t.left,"reset",0):"vertical"===s.settings.mode&&S(-t.top,"reset",0)))},S=function(e,i,n,r){var a,l;s.usingCSS?(l="vertical"===s.settings.mode?"translate3d(0, "+e+"px, 0)":"translate3d("+e+"px, 0, 0)",o.css("-"+s.cssPrefix+"-transition-duration",n/1e3+"s"),"slide"===i?(o.css(s.animProp,l),0!==n?o.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(e){t(e.target).is(o)&&(o.off("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),A())}):A()):"reset"===i?o.css(s.animProp,l):"ticker"===i&&(o.css("-"+s.cssPrefix+"-transition-timing-function","linear"),o.css(s.animProp,l),0!==n?o.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(e){t(e.target).is(o)&&(o.off("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),S(r.resetValue,"reset",0),F())}):(S(r.resetValue,"reset",0),F()))):(a={},a[s.animProp]=e,"slide"===i?o.animate(a,n,s.settings.easing,function(){A()}):"reset"===i?o.css(s.animProp,e):"ticker"===i&&o.animate(a,n,"linear",function(){S(r.resetValue,"reset",0),F()}))},w=function(){for(var e="",i="",n=f(),o=0;o<n;o++)i="",s.settings.buildPager&&t.isFunction(s.settings.buildPager)||s.settings.pagerCustom?(i=s.settings.buildPager(o),s.pagerEl.addClass("bx-custom-pager")):(i=o+1,s.pagerEl.addClass("bx-default-pager")),e+='<div class="bx-pager-item"><a href="" data-slide-index="'+o+'" class="bx-pager-link">'+i+"</a></div>";s.pagerEl.html(e)},b=function(){s.settings.pagerCustom?s.pagerEl=t(s.settings.pagerCustom):(s.pagerEl=t('<div class="bx-pager" />'),s.settings.pagerSelector?t(s.settings.pagerSelector).html(s.pagerEl):s.controls.el.addClass("bx-has-pager").append(s.pagerEl),w()),s.pagerEl.on("click touchend","a",I)},C=function(){s.controls.next=t('<a class="bx-next" href="">'+s.settings.nextText+"</a>"),s.controls.prev=t('<a class="bx-prev" href="">'+s.settings.prevText+"</a>"),s.controls.next.on("click touchend",P),s.controls.prev.on("click touchend",E),s.settings.nextSelector&&t(s.settings.nextSelector).append(s.controls.next),s.settings.prevSelector&&t(s.settings.prevSelector).append(s.controls.prev),s.settings.nextSelector||s.settings.prevSelector||(s.controls.directionEl=t('<div class="bx-controls-direction" />'),s.controls.directionEl.append(s.controls.prev).append(s.controls.next),s.controls.el.addClass("bx-has-controls-direction").append(s.controls.directionEl))},T=function(){s.controls.start=t('<div class="bx-controls-auto-item"><a class="bx-start" href="">'+s.settings.startText+"</a></div>"),s.controls.stop=t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">'+s.settings.stopText+"</a></div>"),s.controls.autoEl=t('<div class="bx-controls-auto" />'),s.controls.autoEl.on("click",".bx-start",M),s.controls.autoEl.on("click",".bx-stop",y),s.settings.autoControlsCombine?s.controls.autoEl.append(s.controls.start):s.controls.autoEl.append(s.controls.start).append(s.controls.stop),s.settings.autoControlsSelector?t(s.settings.autoControlsSelector).html(s.controls.autoEl):s.controls.el.addClass("bx-has-controls-auto").append(s.controls.autoEl),D(s.settings.autoStart?"stop":"start")},k=function(){s.children.each(function(e){var i=t(this).find("img:first").attr("title");void 0!==i&&(""+i).length&&t(this).append('<div class="bx-caption"><span>'+i+"</span></div>")})},P=function(t){t.preventDefault(),s.controls.el.hasClass("disabled")||(s.settings.auto&&s.settings.stopAutoOnClick&&o.stopAuto(),o.goToNextSlide())},E=function(t){t.preventDefault(),s.controls.el.hasClass("disabled")||(s.settings.auto&&s.settings.stopAutoOnClick&&o.stopAuto(),o.goToPrevSlide())},M=function(t){o.startAuto(),t.preventDefault()},y=function(t){o.stopAuto(),t.preventDefault()},I=function(e){var i,n;e.preventDefault(),s.controls.el.hasClass("disabled")||(s.settings.auto&&s.settings.stopAutoOnClick&&o.stopAuto(),i=t(e.currentTarget),void 0!==i.attr("data-slide-index")&&(n=parseInt(i.attr("data-slide-index")))!==s.active.index&&o.goToSlide(n))},z=function(e){var i=s.children.length;if("short"===s.settings.pagerType)return s.settings.maxSlides>1&&(i=Math.ceil(s.children.length/s.settings.maxSlides)),void s.pagerEl.html(e+1+s.settings.pagerShortSeparator+i);s.pagerEl.find("a").removeClass("active"),s.pagerEl.each(function(i,n){t(n).find("a").eq(e).addClass("active")})},A=function(){if(s.settings.infiniteLoop){var t="";0===s.active.index?t=s.children.eq(0).position():s.active.index===f()-1&&s.carousel?t=s.children.eq((f()-1)*x()).position():s.active.index===s.children.length-1&&(t=s.children.eq(s.children.length-1).position()),t&&("horizontal"===s.settings.mode?S(-t.left,"reset",0):"vertical"===s.settings.mode&&S(-t.top,"reset",0))}s.working=!1,s.settings.onSlideAfter.call(o,s.children.eq(s.active.index),s.oldIndex,s.active.index)},D=function(t){s.settings.autoControlsCombine?s.controls.autoEl.html(s.controls[t]):(s.controls.autoEl.find("a").removeClass("active"),s.controls.autoEl.find("a:not(.bx-"+t+")").addClass("active"))},q=function(){1===f()?(s.controls.prev.addClass("disabled"),s.controls.next.addClass("disabled")):!s.settings.infiniteLoop&&s.settings.hideControlOnEnd&&(0===s.active.index?(s.controls.prev.addClass("disabled"),s.controls.next.removeClass("disabled")):s.active.index===f()-1?(s.controls.next.addClass("disabled"),s.controls.prev.removeClass("disabled")):(s.controls.prev.removeClass("disabled"),s.controls.next.removeClass("disabled")))},H=function(){o.startAuto()},W=function(){o.stopAuto()},L=function(){s.settings.autoDelay>0?setTimeout(o.startAuto,s.settings.autoDelay):(o.startAuto(),t(window).focus(H).blur(W)),s.settings.autoHover&&o.hover(function(){s.interval&&(o.stopAuto(!0),s.autoPaused=!0)},function(){s.autoPaused&&(o.startAuto(!0),s.autoPaused=null)})},O=function(){var e,i,n,r,a,l,d,c,g=0;"next"===s.settings.autoDirection?o.append(s.children.clone().addClass("bx-clone")):(o.prepend(s.children.clone().addClass("bx-clone")),e=s.children.first().position(),g="horizontal"===s.settings.mode?-e.left:-e.top),S(g,"reset",0),s.settings.pager=!1,s.settings.controls=!1,s.settings.autoControls=!1,s.settings.tickerHover&&(s.usingCSS?(r="horizontal"===s.settings.mode?4:5,s.viewport.hover(function(){i=o.css("-"+s.cssPrefix+"-transform"),n=parseFloat(i.split(",")[r]),S(n,"reset",0)},function(){c=0,s.children.each(function(e){c+="horizontal"===s.settings.mode?t(this).outerWidth(!0):t(this).outerHeight(!0)}),a=s.settings.speed/c,l="horizontal"===s.settings.mode?"left":"top",d=a*(c-Math.abs(parseInt(n))),F(d)})):s.viewport.hover(function(){o.stop()},function(){c=0,s.children.each(function(e){c+="horizontal"===s.settings.mode?t(this).outerWidth(!0):t(this).outerHeight(!0)}),a=s.settings.speed/c,l="horizontal"===s.settings.mode?"left":"top",d=a*(c-Math.abs(parseInt(o.css(l)))),F(d)})),F()},F=function(t){var e,i,n,r=t||s.settings.speed,a={left:0,top:0},l={left:0,top:0};"next"===s.settings.autoDirection?a=o.find(".bx-clone").first().position():l=s.children.first().position(),e="horizontal"===s.settings.mode?-a.left:-a.top,i="horizontal"===s.settings.mode?-l.left:-l.top,n={resetValue:i},S(e,"ticker",r,n)},N=function(e){var i=t(window),n={top:i.scrollTop(),left:i.scrollLeft()},s=e.offset();return n.right=n.left+i.width(),n.bottom=n.top+i.height(),s.right=s.left+e.outerWidth(),s.bottom=s.top+e.outerHeight(),!(n.right<s.left||n.left>s.right||n.bottom<s.top||n.top>s.bottom)},B=function(t){var e=document.activeElement.tagName.toLowerCase();if(null==new RegExp(e,["i"]).exec("input|textarea")&&N(o)){if(39===t.keyCode)return P(t),!1;if(37===t.keyCode)return E(t),!1}},X=function(){s.touch={start:{x:0,y:0},end:{x:0,y:0}},s.viewport.on("touchstart MSPointerDown pointerdown",Y),s.viewport.on("click",".bxslider a",function(t){s.viewport.hasClass("click-disabled")&&(t.preventDefault(),s.viewport.removeClass("click-disabled"))})},Y=function(t){if("touchstart"===t.type||0===t.button)if(t.preventDefault(),s.controls.el.addClass("disabled"),s.working)s.controls.el.removeClass("disabled");else{s.touch.originalPos=o.position();var e=t.originalEvent,i=void 0!==e.changedTouches?e.changedTouches:[e],n="function"==typeof PointerEvent;if(n&&void 0===e.pointerId)return;s.touch.start.x=i[0].pageX,s.touch.start.y=i[0].pageY,s.viewport.get(0).setPointerCapture&&(s.pointerId=e.pointerId,s.viewport.get(0).setPointerCapture(s.pointerId)),s.originalClickTarget=e.originalTarget||e.target,s.originalClickButton=e.button,s.originalClickButtons=e.buttons,s.originalEventType=e.type,s.hasMove=!1,s.viewport.on("touchmove MSPointerMove pointermove",R),s.viewport.on("touchend MSPointerUp pointerup",Z),s.viewport.on("MSPointerCancel pointercancel",V)}},V=function(t){t.preventDefault(),S(s.touch.originalPos.left,"reset",0),s.controls.el.removeClass("disabled"),s.viewport.off("MSPointerCancel pointercancel",V),s.viewport.off("touchmove MSPointerMove pointermove",R),s.viewport.off("touchend MSPointerUp pointerup",Z),s.viewport.get(0).releasePointerCapture&&s.viewport.get(0).releasePointerCapture(s.pointerId)},R=function(t){var e=t.originalEvent,i=void 0!==e.changedTouches?e.changedTouches:[e],n=Math.abs(i[0].pageX-s.touch.start.x),o=Math.abs(i[0].pageY-s.touch.start.y),r=0,a=0;s.hasMove=!0,3*n>o&&s.settings.preventDefaultSwipeX?t.preventDefault():3*o>n&&s.settings.preventDefaultSwipeY&&t.preventDefault(),"touchmove"!==t.type&&t.preventDefault(),"fade"!==s.settings.mode&&s.settings.oneToOneTouch&&("horizontal"===s.settings.mode?(a=i[0].pageX-s.touch.start.x,r=s.touch.originalPos.left+a):(a=i[0].pageY-s.touch.start.y,r=s.touch.originalPos.top+a),S(r,"reset",0))},Z=function(e){e.preventDefault(),s.viewport.off("touchmove MSPointerMove pointermove",R),s.controls.el.removeClass("disabled");var i=e.originalEvent,n=void 0!==i.changedTouches?i.changedTouches:[i],r=0,a=0;s.touch.end.x=n[0].pageX,s.touch.end.y=n[0].pageY,"fade"===s.settings.mode?(a=Math.abs(s.touch.start.x-s.touch.end.x))>=s.settings.swipeThreshold&&(s.touch.start.x>s.touch.end.x?o.goToNextSlide():o.goToPrevSlide(),o.stopAuto()):("horizontal"===s.settings.mode?(a=s.touch.end.x-s.touch.start.x,r=s.touch.originalPos.left):(a=s.touch.end.y-s.touch.start.y,r=s.touch.originalPos.top),!s.settings.infiniteLoop&&(0===s.active.index&&a>0||s.active.last&&a<0)?S(r,"reset",200):Math.abs(a)>=s.settings.swipeThreshold?(a<0?o.goToNextSlide():o.goToPrevSlide(),o.stopAuto()):S(r,"reset",200)),s.viewport.off("touchend MSPointerUp pointerup",Z),s.viewport.get(0).releasePointerCapture&&s.viewport.get(0).releasePointerCapture(s.pointerId),!1!==s.hasMove||0!==s.originalClickButton&&"touchstart"!==s.originalEventType||t(s.originalClickTarget).trigger({type:"click",button:s.originalClickButton,buttons:s.originalClickButtons})},U=function(e){if(s.initialized)if(s.working)window.setTimeout(U,10);else{var i=t(window).width(),n=t(window).height();r===i&&a===n||(r=i,a=n,o.redrawSlider(),s.settings.onSliderResize.call(o,s.active.index))}},j=function(t){var e=v();s.settings.ariaHidden&&!s.settings.ticker&&(s.children.attr("aria-hidden","true"),s.children.slice(t,t+e).attr("aria-hidden","false"))},Q=function(t){return t<0?s.settings.infiniteLoop?f()-1:s.active.index:t>=f()?s.settings.infiniteLoop?0:s.active.index:t};return o.goToSlide=function(e,i){var n,r,a,l,d=!0,c=0,g={left:0,top:0},u=null;if(s.oldIndex=s.active.index,s.active.index=Q(e),!s.working&&s.active.index!==s.oldIndex){if(s.working=!0,void 0!==(d=s.settings.onSlideBefore.call(o,s.children.eq(s.active.index),s.oldIndex,s.active.index))&&!d)return s.active.index=s.oldIndex,void(s.working=!1);"next"===i?s.settings.onSlideNext.call(o,s.children.eq(s.active.index),s.oldIndex,s.active.index)||(d=!1):"prev"===i&&(s.settings.onSlidePrev.call(o,s.children.eq(s.active.index),s.oldIndex,s.active.index)||(d=!1)),s.active.last=s.active.index>=f()-1,(s.settings.pager||s.settings.pagerCustom)&&z(s.active.index),s.settings.controls&&q(),"fade"===s.settings.mode?(s.settings.adaptiveHeight&&s.viewport.height()!==p()&&s.viewport.animate({height:p()},s.settings.adaptiveHeightSpeed),s.children.filter(":visible").fadeOut(s.settings.speed).css({zIndex:0}),s.children.eq(s.active.index).css("zIndex",s.settings.slideZIndex+1).fadeIn(s.settings.speed,function(){t(this).css("zIndex",s.settings.slideZIndex),A()})):(s.settings.adaptiveHeight&&s.viewport.height()!==p()&&s.viewport.animate({height:p()},s.settings.adaptiveHeightSpeed),!s.settings.infiniteLoop&&s.carousel&&s.active.last?"horizontal"===s.settings.mode?(u=s.children.eq(s.children.length-1),g=u.position(),c=s.viewport.width()-u.outerWidth()):(n=s.children.length-s.settings.minSlides,g=s.children.eq(n).position()):s.carousel&&s.active.last&&"prev"===i?(r=1===s.settings.moveSlides?s.settings.maxSlides-x():(f()-1)*x()-(s.children.length-s.settings.maxSlides),u=o.children(".bx-clone").eq(r),g=u.position()):"next"===i&&0===s.active.index?(g=o.find("> .bx-clone").eq(s.settings.maxSlides).position(),s.active.last=!1):e>=0&&(l=e*parseInt(x()),g=s.children.eq(l).position()),void 0!==g&&(a="horizontal"===s.settings.mode?-(g.left-c):-g.top,S(a,"slide",s.settings.speed)),s.working=!1),s.settings.ariaHidden&&j(s.active.index*x())}},o.goToNextSlide=function(){if((s.settings.infiniteLoop||!s.active.last)&&!0!==s.working){var t=parseInt(s.active.index)+1;o.goToSlide(t,"next")}},o.goToPrevSlide=function(){if((s.settings.infiniteLoop||0!==s.active.index)&&!0!==s.working){var t=parseInt(s.active.index)-1;o.goToSlide(t,"prev")}},o.startAuto=function(t){s.interval||(s.interval=setInterval(function(){"next"===s.settings.autoDirection?o.goToNextSlide():o.goToPrevSlide()},s.settings.pause),s.settings.onAutoChange.call(o,!0),s.settings.autoControls&&!0!==t&&D("stop"))},o.stopAuto=function(t){s.autoPaused&&(s.autoPaused=!1),s.interval&&(clearInterval(s.interval),s.interval=null,s.settings.onAutoChange.call(o,!1),s.settings.autoControls&&!0!==t&&D("start"))},o.getCurrentSlide=function(){return s.active.index},o.getCurrentSlideElement=function(){return s.children.eq(s.active.index)},o.getSlideElement=function(t){return s.children.eq(t)},o.getSlideCount=function(){return s.children.length},o.isWorking=function(){return s.working},o.redrawSlider=function(){s.children.add(o.find(".bx-clone")).outerWidth(h()),s.viewport.css("height",p()),s.settings.ticker||m(),s.active.last&&(s.active.index=f()-1),s.active.index>=f()&&(s.active.last=!0),s.settings.pager&&!s.settings.pagerCustom&&(w(),z(s.active.index)),s.settings.ariaHidden&&j(s.active.index*x())},o.destroySlider=function(){s.initialized&&(s.initialized=!1,t(".bx-clone",this).remove(),s.children.each(function(){void 0!==t(this).data("origStyle")?t(this).attr("style",t(this).data("origStyle")):t(this).removeAttr("style")}),void 0!==t(this).data("origStyle")?this.attr("style",t(this).data("origStyle")):t(this).removeAttr("style"),t(this).unwrap().unwrap(),s.controls.el&&s.controls.el.remove(),s.controls.next&&s.controls.next.remove(),s.controls.prev&&s.controls.prev.remove(),s.pagerEl&&s.settings.controls&&!s.settings.pagerCustom&&s.pagerEl.remove(),t(".bx-caption",this).remove(),s.controls.autoEl&&s.controls.autoEl.remove(),clearInterval(s.interval),s.settings.responsive&&t(window).off("resize",U),s.settings.keyboardEnabled&&t(document).off("keydown",B),t(this).removeData("bxSlider"),t(window).off("blur",W).off("focus",H))},o.reloadSlider=function(e){void 0!==e&&(n=e),o.destroySlider(),l(),t(o).data("bxSlider",this)},l(),t(o).data("bxSlider",this),this}}}(jQuery);