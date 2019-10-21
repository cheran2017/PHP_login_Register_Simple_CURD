<?php
	require 'dbconnect.php';
	$input = json_decode(file_get_contents('php://input'));
	
	$sql = "SELECT * FROM users WHERE email='" . $input->email . "' and password = '". $input->password."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row  = mysqli_fetch_array($result);
		session_start();
		$_SESSION["id"] = $row['id'];
		$_SESSION["name"] = $row['name'];
		
	    echo json_encode([ 'status' => true , 'message' => 'Login Successfull']);

	} else {
	    echo json_encode([ 'status' => false , 'message' => 'Invalid Username or Password!']);
	}
	
	// if(isset($_SESSION["id"])) {
	// 	header("Location:views/profile.php");
	// }
?>