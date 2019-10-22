<?php require 'config/session_validation.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
</head>
<body>
  <form id="login">
    <div class="container">
      <h2>Login Form</h2>
      <label for="uname"><b>Email</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required id="email">
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required id="password">
      <button type="submit">Login</button>
      <a href="views/register.php"> New User?</a>
    </div>
  </form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="js/login.js"></script>
