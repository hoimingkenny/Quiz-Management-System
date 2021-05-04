<?php
if (isset($_POST['login_button'])) {
  
  $con = mysqli_connect("localhost", "root", "root", "quiz");

  $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
  $_SESSION['log_email'] = $email; //store email into session variable
  
  $password = md5($_POST['log_password']); //get password
 
  $check_database_query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

  $result = mysqli_query($con, $check_database_query); //an array

  $check_login_query = mysqli_num_rows($result);

  if ($check_login_query == 1) {
    while($row = mysqli_fetch_array($result)) { //print results
      $username = $row['username'];
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $user_id = $row['id'];
    }
    
    $_SESSION['username'] = $username;
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['userID'] = $user_id;
    

    //reopen account
    // $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
    // if(mysqli_num_rows($user_closed_query) == 1){
    //   $reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email'");
    // }

    //check the admin level
    $user_level_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND level='staff'");
    if(mysqli_num_rows($user_level_query) == 1){
      header("Location: staff.php");
    }else{
      header("Location: index.php");
    }
    exit();

  } else {
    echo ("Email or password was incorrect");
    array_push($error_array, "Email or password was incorrect<br>");
  }
}
