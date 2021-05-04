<?php
include("includes/header.php");
// session_destroy();

$quiz_name = $_POST['quiz_name'];
$availability = $_POST['availability'];
$duration = $_POST['duration'];


if (isset($_POST['create_quiz_button'])) {
  $quiz_name = ucfirst(strtolower($quiz_name)); //Uppercase first letter
  
  //check if quiz name already exists
  $quiz_name_check = mysqli_query($con, "SELECT quiz_name FROM quizzes WHERE quiz_name='$quiz_name'");

  //Count the number of rows returned
  $num_rows = mysqli_num_rows($quiz_name_check);

  if($num_rows > 0){
    echo "Quiz name already in use. Pleace use another name. <br>";
    // array_push($error_array, "Email already in use<br>");
  }else{
    //store quiz information
    $create_quiz_query = "INSERT INTO quizzes VALUES (NULL, '$quiz_name', '$fname $lname', '$availability', '$duration')";

    if (mysqli_query($con, $create_quiz_query)) {
      echo ("Quiz information created\n");

      // check quiz id for addQuestion.php after quiz information inserted to database
      $check_quizId_query = "SELECT * FROM quizzes WHERE quiz_name='$quiz_name'";
      $result = mysqli_query($con, $check_quizId_query);

      if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result)) { //print results
          $quiz_id = $row['quiz_id'];
        }
        $_SESSION['quiz_id'] = $quiz_id;
        echo $_SESSION['quiz_id'];
        $_SESSION['quiz_name'] = $quiz_name;//Stores quiz name into session variable
        header("Location: addQuestion.php");
      } else {
        echo ('Something went wrong - Cannot check quiz_id' . mysqli_errno($con));
      }
    }
  } 
}else {
  echo ('The page is loaded.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create quiz</title>
</head>

<body>
  <h1>Create Quiz</h1>
  <form action="createQuiz.php" method="POST">
    <input type="text" name="quiz_name" placeholder="Name of the quiz" required> <br>
    <input type="text" name="availability" placeholder="Availability (type: y/n)" required> <br>
    <input type="text" name="duration" placeholder="Duration" required><br>
    <input type="submit" name="create_quiz_button" value="Next">
  </form>

</body>

</html>