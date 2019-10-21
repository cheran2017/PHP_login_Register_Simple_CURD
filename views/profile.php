<?php 
	session_start();
	if(!isset($_SESSION["id"])) {
		header("Location:../index.php");
	}
	require '../config/dbconnect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
</head>
<body>
	<a href="../config/logout.php">Log Out</a>
	<?php 
		$sql = "SELECT * FROM users WHERE id='" . $_SESSION["id"] ."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row  = mysqli_fetch_array($result);
			$data  = [
				'name'		=> $row['name'],
				'email'		=> $row['email'],
				'age'		=> $row['age'],
				'dob'		=> $row['dob'],
				'contact_number'		=> $row['contact_number'],
			];

		
	 ?>
	 <form id="update">
	<input type="text" name="name" id="name" value="<?php echo $row['name']; ?>">
	<input type="email" name="email" id="email"  value="<?php echo $row['email']; ?>">
	<input type="date" data-date="" id="dob"  data-date-format="YYYY DD MMMM " name="dob" value="<?php echo $row['dob']; ?>">
	<input type="number" name="age" id="age" value="<?php echo $row['age']; ?>">
	<input type="hidden" name="password" id="password" value="<?php echo $row['password']; ?>">
	<input type="number" name="contact_number" id="contact_number" value="<?php echo $row['contact_number']; ?>">
		<input type="submit" name="submit" class="btn btn-primary form-control" id="submit" value="Update">
	</form>
	<?php } ?>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
	// Variable to hold request
	var request;

	// Bind to the submit event of our form
	$("#update").submit(function(event){

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
	    	dob      : '1993-08-08',
	    	age      : $('#age').val(),
	    	contact_number : $('#contact_number').val()
	    };
	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    $inputs.prop("disabled", true);
	    request = $.ajax({
	        url: "http://localhost/guvi/config/update.php",
	        type: "post",
	        data: JSON.stringify(data),
	        dataType: 'json',
	        contentType: 'application/json',
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	        // console.log(response);
	        // if (response.status == true) {
	        // 	alert(response.message);
	        // } else {
	        // 	alert('User Update Failed');
	        // }
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
