<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="assets/css/register_style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Handlee&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="assets/js/register.js"></script>
</head>

<body>
  <?php

  if (isset($_POST['register_button'])) {
    echo '
        <script>
          $(document).ready(function(){
            $("#first").hide();
            $("#second").show();
          });
        </script>
      ';
  }

  ?>



  <div class="wrapper">
    <div class="login_box">
      <div class="login_header">
        <h1>Whiteboard</h1>
        Login and sign up below!
      </div>
      <div id="first">
        <form action="register.php" method="POST">
          <input type="email" name="log_email" placeholder="Email address" value="<?php
                                                                                  if (isset($_SESSION['log_email'])) {
                                                                                    echo $_SESSION['log_email'];
                                                                                  }
                                                                                  ?>" required>
          <br>
          <input type="password" name="log_password" placeholder="Password">
          <br>
          <?php if (in_array("Email or password was incorrect<br>", $error_array)) echo "Email or password was incorrect<br>"; ?>
          
          <input type="submit" name="login_button" value="Login">
          <br>
          <a href="#" id="signup" class="signup">Need and account? Register here!</a>
        </form>
      </div>

      <div id="second">
        <form action="register.php" method="POST">
          <input type="text" name="reg_fname" placeholder="First Name" value="<?php //save fname when refresh the page
                                                                              if (isset($_SESSION['reg_fname'])) {
                                                                                echo $_SESSION['reg_fname'];
                                                                              }
                                                                              ?>" required>
          <br>
          <?php if (in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>" ?>

          <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
                                                                              if (isset($_SESSION['reg_lname'])) {
                                                                                echo $_SESSION['reg_lname'];
                                                                              }
                                                                              ?>" required>
          <br>
          <?php if (in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>" ?>

          <input type="email" name="reg_email" placeholder="Email" value="<?php
                                                                          if (isset($_SESSION['reg_email'])) {
                                                                            echo $_SESSION['reg_email'];
                                                                          }
                                                                          ?>" required>
          <br>
          <?php if (in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>" ?>

          <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                                                                                    if (isset($_SESSION['reg_email2'])) {
                                                                                      echo $_SESSION['reg_email2'];
                                                                                    }
                                                                                    ?>" required>
          <br>
          <?php if (in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
          else if (in_array("Invalid format<br>", $error_array)) echo "Invalid format<br>";
          else if (in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>" ?>

          <input type="password" name="reg_password" placeholder="Password" required>
          <br>
          <input type="password" name="reg_password2" placeholder="Confirm Password" required>
          <br>
          <?php if (in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
          else if (in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
          else if (in_array("Your password must be bwt 5 and 30 characters<br>", $error_array)) echo "Your password must be bwt 5 and 30 characters<br>" ?>

          <select name="level" id="position">
            <option value="staff">Staff</option>
            <option value="student">Student</option>
          </select>

          <br>

          <input type="submit" name="register_button" value="Register">
          <?php if (in_array("<span style='color: #14C800'> You're all set! Goahead and login! </span><br>", $error_array)) echo "<span style='color: #14C800'> You're all set! Goahead and login! </span><br>"; ?>
          <br>
          <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>

        </form>

      </div>
    </div>
  </div>
</body>

</html>