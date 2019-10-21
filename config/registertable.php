<?php 

	require 'dbconnect.php';
	$table = 'users';
	$result = $conn->query("SHOW TABLES LIKE '".$table."'");
	
	if($result->num_rows == 1) {
	}
	else {
	    // sql to create table
		$sql = "CREATE TABLE users (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(30) NOT NULL,
		email VARCHAR(50) NOT NULL,
		password VARCHAR(50) NOT NULL,
		dob DATE NOT NULL,
		age VARCHAR(30) NOT NULL,
		contact_number VARCHAR(30) NOT NULL

		)";

		if ($conn->query($sql) === TRUE) {
		    // echo "Table MyGuests created successfully";
		} else {
		    echo "Error creating table: " . $conn->error;
		}
	}

 ?>