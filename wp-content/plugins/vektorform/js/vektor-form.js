var vektor_form = {
	
	init: function(){

		// Divs
		var $body = $('body'),
			$form = $('.vektor-form'),
			$status = $('.status');
		
		// Hide status message
		$status.hide();
		
		$form.each(function(index, Element){
			
			// Validate form
			$(Element).validate({
				rules: {
					name: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
					message: {
						required: true,
						minlength: 3
					}
				},
				submitHandler: function(){
					
					// Serialize form data
					var formData = $(Element).serialize();
					
					// Show loading message
					$status.show().text(vektor.loadingmessage);
					
					// Disable inputs and textareas
					$(Element).find('input, textarea').attr('disabled', 'disabled');
					
					// Google Analytics tracking on submit
					if(!$body.hasClass('logged-in')){
						ga && ga('send', 'event', 'vektor-form', 'submit');
					}
					
					$.ajax({
						 type: 'POST',
						 dataType: 'json',
						 url: vektor.ajaxurl,
						 data: formData,
						 success: function(data){
							 
						 	// Show status message
							$status.text(data.message);
							
							if(data.status == true){
								
								// Sweet Alert success
								swal({
									title: data.title,
									text: data.message,
									type: "success",
									allowOutsideClick: true
								});
								
								// GA success
								if(!$body.hasClass('logged-in')){
									ga && ga('send', 'event', 'vektor-form', 'success');
								}
								
								// Add success class
								$status.addClass('success');
								
								// Remove disabled and clear inputs and textareas
								$(Element).find('input, textarea').attr('disabled', false).not('[type="submit"], input[type="hidden"]').val('');
								
							} else {
								
								// Sweet Alert success error
								swal({
									title: data.title,
									text: data.message,
									type: "error",
									allowOutsideClick: true
								});
								
								// GA error
								if(!$body.hasClass('logged-in')){
									ga && ga('send', 'event', 'vektor-form', 'error');
								}
								
								// Add error class
								$status.addClass('error');
								
							} // end if(data.status !== true)
							
						 } // end success: function()
						 
					 }); // end $.ajax();
					 
				 } // end submitHandler();
				 
			}); // end $(Element).validate();
			
		}); // end $form.each();

	} // end init: function();
	
}

$(document).ready(function(){
	
	vektor_form.init();
	
});
