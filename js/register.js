
	// Variable to hold request
	var request;

	// Bind to the submit event of our form
	$("#register").submit(function(event){

	    // Prevent default posting of form - put here to work in case of errors
	    event.preventDefault();
	    // Abort any pending request
	    if (request) {
	        request.abort();
	    }
	    // setup some local variables
	    var $form = $(this);
	    // Let's select and cache all the fields
	    var $inputs = $form.find("input, select, button, textarea");

	    // Serialize the data in the form
	    var data = {
	    	name     :  $('#name').val(),
	    	email    :  $('#email').val(),
	    	password : $('#password').val(),
	    	age      :  $('#age').val(),
	    	contact_number : $('#contact_number').val()
	    };
	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    $inputs.prop("disabled", true);
	    request = $.ajax({
	        url: "../config/register.php",
	        type: "post",
	        data: JSON.stringify(data),
	        dataType: 'json',
	        contentType: 'application/json',
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	        console.log(response);
	        if (response.status == true) {
	        	alert(response.message);
            	window.location.href ='../index.php';
	        } else {
	        	alert('User Registeration Failed');
	        }
	    });

	    // Callback handler that will be called on failure
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        // Log the error to the console
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });

	    // Callback handler that will be called regardless
	    // if the request failed or succeeded
	    request.always(function () {
	        // Reenable the inputs
	        $inputs.prop("disabled", false);
	    });

	});