<?php 
	require 'dbconnect.php';
	require 'registertable.php';
	

	$input = json_decode(file_get_contents('php://input'));

	$sql = "INSERT INTO `users` (name, email, password,age,contact_number)
	        VALUES ('$input->name', '$input->email', '$input->password','$input->age','$input->contact_number')";

	if ($conn->query($sql) === TRUE) {
		$json      = 'jsons/'.$input->name.'.json';
		$json_data = $input;
		$fp = fopen($json, 'w');
		fwrite($fp, json_encode($json_data));
		fclose($fp);
	    echo json_encode([ 'status' => true , 'message' => 'New record created successfully']);
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

 ?>