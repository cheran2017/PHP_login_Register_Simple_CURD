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
		$stmt = $conn->prepare("SELECT id,name,email,age,contact_number,password FROM users WHERE id= ? LIMIT 1");
		$stmt->bind_param("i",$id);
		
		// set parameters and execute
		$id  		= $_SESSION["id"];
		$stmt->execute();
		$stmt->bind_result($id,$name,$email,$age,$contact_number,$password);
		$stmt->store_result();
		if($stmt->num_rows == 1)  //To check if the row exists
			{
				if($stmt->fetch()) //fetching the contents of the row
				{
					$data  = [
						'name'		=> $name,
						'email'		=> $email,
						'password'	=> $password,
						'age'		=> $age,
						'contact_number'		=> $contact_number,
					];

				}
		}
	 ?>
	 <form id="update">
	 	<div class="container">
		  <a href="../config/logout.php" class="pull-right">Log Out</a>

	      <h2>Your Profile</h2>
		  <br>
	      <label for="name"><b>Name</b></label>
	      <input type="text" placeholder="Enter name" name="uname" required id="name" value="<?php echo $data['name']; ?>">
	      <label for="uname"><b>Email</b></label>
	      <input type="email" placeholder="Enter email" name="uname" required id="email" value="<?php echo $data['email']; ?>">

	      <label for="name"><b>AGE</b></label>
	      <input type="number" placeholder="Enter age" name="uname" required id="age" value="<?php echo $data['age']; ?>">
	      <label for="Contact Number"><b>Contact Number</b></label>
	      <input type="number" placeholder="Enter contact number" name="uname" required id="contact_number" value="<?php echo $data['contact_number']; ?>">
	      <button type="submit" id="submit">Update</button>
	    </div>
		<input type="hidden" name="password" id="password" value="<?php echo $data['password']; ?>">
	</form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="../js/profile.js"></script>
