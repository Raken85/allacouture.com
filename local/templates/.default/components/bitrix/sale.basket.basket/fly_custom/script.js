var basketTimeout;
var totalSum;
var timerBasketUpdate = false;

function setQuantityFly(basketId, ratio, direction){
	var currentValue = BX("QUANTITY_INPUT_" + basketId).value, newVal;

	var isDblQuantity = $("#QUANTITY_INPUT_" + basketId).data('float_ratio'),
		ratio=( isDblQuantity ? parseFloat(ratio) : parseInt(ratio, 10));

	if(isDblQuantity)
		ratio = Math.round(ratio*arNextOptions.JS_ITEM_CLICK.precisionFactor)/arNextOptions.JS_ITEM_CLICK.precisionFactor;

	curValue = (isDblQuantity ? parseFloat(currentValue) : parseInt(currentValue, 10));

	curValue = (direction == 'up') ? curValue + ratio : curValue - ratio;

	if (isDblQuantity){
		curValue = Math.round(curValue*arNextOptions.JS_ITEM_CLICK.precisionFactor)/arNextOptions.JS_ITEM_CLICK.precisionFactor;
	}

	if (curValue < 0) curValue = 0;
	if (curValue > 0) {
		
		BX("QUANTITY_INPUT_" + basketId).value = curValue;
		BX("QUANTITY_INPUT_" + basketId).defaultValue = currentValue;

		totalSum=0;
		$('#basket_line .basket_fly tr[data-id='+basketId+']').closest('table').find("tbody tr[data-id]").each(function(i, element) {
			id=$(element).attr("data-id");
			count=BX("QUANTITY_INPUT_" + id).value;

			price = $(document).find("#basket_form input[name=item_price_"+id+"]").val();
			sum = count*price;
			totalSum += sum;
			$(document).find("#basket_form [data-id="+id+"] .summ-cell .price").html(jsPriceFormat(sum));
		});

		$("#basket_form .itog span.price").html(jsPriceFormat(totalSum));
		$("#basket_form .itog div.discount").fadeTo( "slow" , 0.2);


		if(timerBasketUpdate){
			clearTimeout(timerBasketUpdate);
			timerBasketUpdate = false;
		}

		timerBasketUpdate = setTimeout(function(){
			updateQuantityFly('QUANTITY_INPUT_' + basketId, basketId, ratio);
			timerBasketUpdate=false;
		}, 700);
	}
}

function updateQuantityFly(controlId, basketId, ratio, animate) {

	var oldVal = BX(controlId).defaultValue, newVal = parseFloat(BX(controlId).value) || 0; bValidChange = false; // if quantity is correct for this ratio

	if (!newVal) {
		bValidChange = false;
		BX(controlId).value = oldVal;
	}
	if($("#"+controlId).hasClass('focus'))
		newVal -= newVal % ratio;
	var is_int_ratio = (ratio % 1 == 0);
	newVal = is_int_ratio ? parseInt(newVal) : parseFloat(newVal).toFixed(1);

	if (isRealValue(BX("QUANTITY_SELECT_" + basketId))) { var option, options = BX("QUANTITY_SELECT_" + basketId).options, i = options.length; }
	while (i--) {
		option = options[i];
		if (parseFloat(option.value).toFixed(2) == parseFloat(newVal).toFixed(2)) option.selected = true;
	}

	BX("QUANTITY_" + basketId).value = newVal; // set hidden real quantity value (will be used in POST)
	BX("QUANTITY_INPUT_" + basketId).value = newVal; // set hidden real quantity value (will be used in POST)

	$('form[name^=basket_form]').prepend('<input type="hidden" name="BasketRefresh" value="Y" />');

	$.post( arNextOptions['SITE_DIR']+'ajax/basket_fly.php', $("form[name^=basket_form]").serialize(), $.proxy(function( data){
		if (timerBasketUpdate==false) {
			basketFly('open');
		}
		$('form[name^=basket_form] input[name=BasketRefresh]').remove();
	}));
}

function delete_all_items(type, item_section, correctSpeed){
	var index=(type=="delay" ? "2" : "1");
	if(type == "na")
		index = 4;
	$.post( arNextOptions['SITE_DIR']+'ajax/show_basket_fly.php', 'PARAMS='+$("#basket_form").find("input#fly_basket_params").val()+'&TYPE='+index+'&CLEAR_ALL=Y&CLEAR_FLY=Y', $.proxy(function( data ) {
		basketFly('open');
		$('.in-cart').hide();
		$('.in-cart').closest('.button_block').removeClass('wide');
		$('.to-cart').show();
		$('.to-cart').removeClass("clicked");
		$('.counter_block').show();
		$('.wish_item').removeClass("added");
		$('.wish_item').find('.value').show();
		$('.wish_item').find('.value.added').hide();
		getActualBasket();

		var eventdata = {action:'loadBasket'};
		BX.onCustomEvent('onCompleteAction', [eventdata]);
	}));
}

function deleteProduct(basketId, itemSection, item, th){
	function _deleteProduct(basketId, itemSection, product_id){
		arStatusBasketAspro = {};
		$.post( arNextOptions['SITE_DIR']+'ajax/item.php', 'delete_item=Y&item='+product_id, $.proxy(function( data ){
			basketFly('open');
			getActualBasket();
			$('.to-cart[data-item='+product_id+']').removeClass("clicked");
		}));
	}
	var product_id=th.attr("product-id");
	if(checkCounters()){
		delFromBasketCounter(item);
		setTimeout(function(){
			_deleteProduct(basketId, itemSection, product_id);
		}, 100);
	}
	else{
		_deleteProduct(basketId, itemSection, product_id);
	}
}

function delayProduct(basketId, itemSection, th){
	var product_id=th.attr("product-id");
	$.post( arNextOptions['SITE_DIR']+'ajax/item.php', 'wish_item=Y&item='+product_id+'&quantity='+th.find('#QUANTITY_'+basketId).val(), $.proxy(function( data ){
		basketFly('open');
		getActualBasket(th.attr('data-iblockid'));
		$('.to-cart[data-item='+product_id+']').removeClass("clicked");
		arStatusBasketAspro = {};
		var eventdata = {action:'loadBasket'};
		BX.onCustomEvent('onCompleteAction', [eventdata]);
	}));
}

function addProduct(basketId, itemSection, th){
	var product_id=th.attr("product-id");
	$.post( arNextOptions['SITE_DIR']+'ajax/item.php', 'add_item=Y&item='+product_id+'&quantity='+th.find('#QUANTITY_'+basketId).val(), $.proxy(function( data ) {
		basketFly('open');
		getActualBasket(th.attr('data-iblockid'));
		arStatusBasketAspro = {};
		var eventdata = {action:'loadBasket'};
		BX.onCustomEvent('onCompleteAction', [eventdata]);
	}));
}

function checkOutFly(event){
	event = event || window.event;
	var th=$(event.target).parent();
	if(checkCounters('google')){
		checkoutCounter(1, th.data('text'), th.data('href'));
	}
	setTimeout(function(){
		location.href=th.data('href');		
	}, 50);
	
	return true;
}

$(document).ready(function () {
    $('#basket_form .delay .wish_item').fancybox({
    	type: 'inline',
        maxWidth	: 300,
        maxHeight	: 200,
        fitToView	: true,
        width		: '70%',
        height		: '70%',
        autoSize	: false,
        closeClick	: false,
		content: '<div style="text-align: center"><br><p>Товар отложен</p><br><a href="javascript:$.fancybox.close();" class="btn btn-default white"><span>Ок</span></a></div>'
    });
});