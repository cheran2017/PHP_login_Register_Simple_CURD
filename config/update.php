<?php 
	require 'dbconnect.php';
	session_start();
	$id = $_SESSION["id"];
	$input = json_decode(file_get_contents('php://input'));

	$sql = "UPDATE `users` SET  name  = '$input->name' , 
								email = '$input->email',
								password = '$input->password',
								dob     = '$input->dob',
								age      = '$input->age',
								contact_number = '$input->contact_number'
			WHERE id = $id ";

	if ($conn->query($sql) === TRUE) {
	    echo json_encode([ 'status' => true , 'message' => 'user record updated successfully']);
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

 ?>