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
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php 
		$sql = "SELECT * FROM users WHERE id='" . $_SESSION["id"] ."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row  = mysqli_fetch_array($result);
			$data  = [
				'name'		=> $row['name'],
				'email'		=> $row['email'],
				'age'		=> $row['age'],
				'contact_number'		=> $row['contact_number'],
			];

		
	 ?>
	 <form id="update">
	 	<div class="container">
		  <a href="../config/logout.php" class="pull-right">Log Out</a>

	      <h2>Profile</h2>
		  <br>
	      <label for="name"><b>Name</b></label>
	      <input type="text" placeholder="Enter name" name="uname" required id="name" value="<?php echo $row['name']; ?>">
	      <label for="uname"><b>Email</b></label>
	      <input type="email" placeholder="Enter email" name="uname" required id="email" value="<?php echo $row['email']; ?>">

	      <label for="name"><b>AGE</b></label>
	      <input type="number" placeholder="Enter age" name="uname" required id="age" value="<?php echo $row['age']; ?>">
	      <label for="Contact Number"><b>Contact Number</b></label>
	      <input type="number" placeholder="Enter contact number" name="uname" required id="contact_number" value="<?php echo $row['contact_number']; ?>">
	      <button type="submit" id="submit">Update</button>
	     </div>
			<input type="hidden" name="password" id="password" value="<?php echo $row['password']; ?>">
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
	        url: "../config/update.php",
	        type: "post",
	        data: JSON.stringify(data),
	        dataType: 'json',
	        contentType: 'application/json',
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	        // console.log(response);
	        if (response.status == true) {
	        	alert(response.message);
	        } else {
	        	alert('User Update Failed');
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
