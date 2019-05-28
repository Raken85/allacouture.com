$(document).ready(function(){
	if(typeof obDataSubscribe !== "undefined")
	{
		$(".s_"+obDataSubscribe+" form.sform").validate({
			rules:{ "sf_EMAIL": {email: true}},
			submitHandler: function(form) {
				if($("#licenses_subscribe_footer").prop("checked")!=true){
					console.log("5555");
					$("#licenses_subscribe-error-footer").show();
					return false;
				}else{
					//$(form).submit();
					//console.log("Jjj");
					//console.log($("#licenses_subscribe_footer").prop("checked"));
					return true
				}
    // some other code
    // maybe disabling submit button
    // then:
			//$(form).submit();
			//console.log("Ddd");
		}
		});
	}
})