<?php
	require 'dbconnect.php';
	$input = json_decode(file_get_contents('php://input'));
	
	$stmt = $conn->prepare("SELECT id,name FROM users WHERE email= ? AND password = ? LIMIT 1");
	$stmt->bind_param("ss",$email, $password);
	
	// set parameters and execute
	$email  		= $input->email;
	$password  		= $input->password;

	$stmt->execute();
	$stmt->bind_result($id,$name);
	$stmt->store_result();
	if($stmt->num_rows == 1)  //To check if the row exists
        {
            if($stmt->fetch()) //fetching the contents of the row
            {
				session_start();
				$_SESSION["id"] = $id;
				$_SESSION["name"] = $name;
				
				echo json_encode([ 'status' => true , 'message' => 'Login Successfull']);exit;
           }

    }
    else {
	    echo json_encode([ 'status' => false , 'message' => 'Invalid Username or Password!']);exit;
    }
    $stmt->close();	
	$conn->close();
?>