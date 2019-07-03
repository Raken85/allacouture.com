$(document).ready(function(){
	$(document).on('submit', '#modal-friends form', function(){
		var $form = $(this);
		var data = new FormData($form[0]);
		var conf = false;
		$form.find('.mess').empty();
		if(!$form.find('input:checkbox').is(':checked')) {
			conf = true;
			$form.find('.mess').html('<p class="err">Вы не подтвердили Политику конфиденциальности!</p>');
		}
		if(!conf) {
			$.ajax({
    		    url: '/.ajax/message.php',
    		    data: data,
    		    processData: false,
    		    contentType: false,
    		    type: 'POST',
    		    success: function (data) {
    		    	$form.find('inpit:text, textarea').val('');
    		    	$form.find('.mess').empty();
    		        if(data != '') {
    		        	$form.find('.mess').html(data);
    		        } else {
    		        	$form.empty().append('<p class="success">Ваше сообщение успешно отправлено!</p>');
    		        }
    		    }
    		});
		}
    	return false;
	});
});