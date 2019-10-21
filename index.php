<?php
  session_start();
  if(isset($_SESSION["id"])) {
    header("Location:views/profile.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
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

<script type="text/javascript">
  // Variable to hold request
  var request;
  // Bind to the submit event of our form
  $("#login").submit(function(event){
      // Prevent default posting of form - put here to work in case of errors
      event.preventDefault();
      // Abort any pending request
      if (request) {
          request.abort();
      }
      // setup some local variables
      var $form = $(this);
      // Let's select and cache all the fields
      var $inputs = $form.find("input, select, button, textarea");

      // Serialize the data in the form
      var data = {
        email    :  $('#email').val(),
        password : $('#password').val(),
      };
      // Let's disable the inputs for the duration of the Ajax request.
      // Note: we disable elements AFTER the form data has been serialized.
      // Disabled form elements will not be serialized.
      $inputs.prop("disabled", true);
      request = $.ajax({
          url: "config/login.php",
          type: "post",
          data: JSON.stringify(data),
          dataType: 'json',
          contentType: 'application/json',
      });

      // Callback handler that will be called on success
      request.done(function (response, textStatus, jqXHR){
          // Log a message to the console
          console.log(response);
          if (response.status == true) {
            alert(response.message);
            window.location.href ='views/profile.php';
          } else {
            alert('User Login Failed');
          }
      });

      // Callback handler that will be called on failure
      request.fail(function (jqXHR, textStatus, errorThrown){
          // Log the error to the console
          console.error(
              "The following error occurred: "+
              textStatus, errorThrown
          );
      });

      // Callback handler that will be called regardless
      // if the request failed or succeeded
      request.always(function () {
          // Reenable the inputs
          $inputs.prop("disabled", false);
      });

  });
</script>
