<?php 
	require 'dbconnect.php';
	

	$input = json_decode(file_get_contents('php://input'));

	$sql = "INSERT INTO `users` (name, email, password,dob,age,contact_number)
	        VALUES ('$input->name', '$input->email', '$input->password','$input->dob','$input->age','$input->contact_number')";

	if ($conn->query($sql) === TRUE) {
	    echo json_encode([ 'status' => true , 'message' => 'New record created successfully']);
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

 ?>