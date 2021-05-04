<?php
require 'config/config.php';


//contain username
if(isset($_SESSION['username'])){
  $userLoggedIn = $_SESSION['username'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $user_id = $_SESSION['userID'];
}else{
  header("Location: register.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to whiteboard</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>

<body>