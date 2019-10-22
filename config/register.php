<?php 
	require 'dbconnect.php';
	require 'registertable.php';
	

	$input = json_decode(file_get_contents('php://input'));

	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO users (name, email, password,age,contact_number) VALUES (?, ?, ?,?,?)");
	$stmt->bind_param("sssii",$name, $email, $password,$age,$contact_number);

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
	    echo json_encode([ 'status' => true , 'message' => 'New record created successfully']);
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close();	
	$conn->close();
 ?>