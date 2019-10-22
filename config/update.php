<?php 
	require 'dbconnect.php';
	session_start();
	$input = json_decode(file_get_contents('php://input'));

	// prepare and bind
	$sql  = "UPDATE users SET  	name    	   = ?, 
								email    	   = ?,
								password 	   = ?,
								age            = ?,
								contact_number = ?
							WHERE   id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssiii",$name, $email, $password,$age,$contact_number,$id);

	// set parameters and execute
	$name 			= $input->name;
	$email  		= $input->email;
	$password  		= $input->password;
	$age    		= $input->age;
	$contact_number = $input->contact_number;

	if ($stmt->execute() === TRUE) {
		$json      = 'jsons/'.$email.'.json';
		$json_data = $input;
		$fp = fopen($json, 'w');
		fwrite($fp, json_encode($json_data));
		fclose($fp);
	    echo json_encode([ 'status' => true , 'message' => 'user record updated successfully']);exit;
	} else {
		
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close();	
	$conn->close();

 ?>