<?php require '../config/session_validation.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
</head>
<body>
  <form id="register">
    <div class="container">
      <h2>Register Form</h2>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter name" name="uname" required id="name">
      <label for="uname"><b>Email</b></label>
      <input type="email" placeholder="Enter email" name="uname" required id="email">
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter password" name="psw" required id="password">
      <label for="name"><b>AGE</b></label>
      <input type="number" placeholder="Enter age" name="uname" required id="age">
      <label for="Contact Number"><b>Contact Number</b></label>
      <input type="number" placeholder="Enter contact number" name="uname" required id="contact_number">
      <button type="submit">Register</button>
      <a href="../index.php"> Already User?</a>
    </div>
  </form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="../js/register.js"></script>
