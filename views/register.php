<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	

</head>

<body>
	<form id="register">
	<input type="text" name="name" >
	<input type="email" name="email" >
	<input type="password" name="password" >
	<input type="date" data-date="" data-date-format="YYYY DD MMMM " name="dob" >
	<input type="number" name="age" >
	<input type="number" name="contact_number" >
		<input type="submit" name="submit" class="btn btn-primary form-control" id="submit" value="Register">
	</form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
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
	    	name     :  'cheran',
	    	email    :  'cheran@gmail.com',
	    	password : 'sdfsd',
	    	dob      : '1992-12-12',
	    	age      :  '23',
	    	contact_number : '12121'
	    };
	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    $inputs.prop("disabled", true);
	    request = $.ajax({
	        url: "http://localhost/guvi/config/register.php",
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
</script>