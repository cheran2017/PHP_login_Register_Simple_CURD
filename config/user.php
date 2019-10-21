<?php 
	session_start();
	require 'dbconnect.php';
	$input = json_decode(file_get_contents('php://input'));
	
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
	    echo json_encode([ 'status' => true , 'data' => $data]);

	} else {
	    echo json_encode([ 'status' => false , 'message' => 'Invalid Username or Password!']);
	}
 ?>