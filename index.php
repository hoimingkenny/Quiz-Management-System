<?php
include("includes/header.php");
//contain username
if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $user_id = $_SESSION['userID'];
} else {
  header("Location: register.php");
}

if (isset($_POST['take_quiz_button'])) {
  $quiz_id = $_POST['take_quiz_id'];

  $check_quiz_id = mysqli_query($con, "SELECT quiz_id FROM quizzes WHERE quiz_id='$quiz_id' AND availability='y'");
  if (mysqli_num_rows($check_quiz_id) == 1) {
    echo "Directing to the quiz page...";
    $_SESSION['take_quiz_id'] = $quiz_id;
    echo $_SESSION['take_quiz_id'];
    header("Location: quiz.php");
  } else {
    echo "Please enter a correct quiz id.";
  }
}

//session_destory();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Student</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="index.css">
</head>

<body>

  <h3>Hello <?php echo $fname . " " . $lname; ?></h3>
  <h3>Student ID: <?php echo $user_id ?></h3>
  <br>
  <h3>Available quizzes</h3>

  <?php

  $get_table = "SELECT *
                FROM quizzes
                WHERE quizzes.availability = 'y'";

  $result = mysqli_query($con, $get_table);

  echo "<table border='1'>
    <tr>
      <th>Quiz ID</th>
      <th>Quiz Name</th>
      <th>Author</th>
      <th>Availability</th>
    </tr>";

  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['quiz_id'] . "</td>";
    echo "<td>" . $row['quiz_name'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
    echo "<td>" . $row['availability'] . "</td>";
    echo "</tr>";
  };
  echo "</table>";
  ?>

  <h3>Take quiz</h3>
  <form action="index.php" method="POST">
    <input style="width: 20%;" type="text" name="take_quiz_id" placeholder="Type in the quiz you want to take"">
  <br>
  <br>
  <input style=" width: 10%;" type="submit" name="take_quiz_button" value="Take quiz"">
</form>
<h3>Check score</h3>

  <?php
    // echo $user_id;

    $get_score_q = "SELECT * FROM studentanswer JOIN quizzes 
                    ON studentanswer.quiz_id = quizzes.quiz_id 
                    WHERE student_id='$user_id'";

    $result_get_table = mysqli_query($con, $get_score_q);

    if($result_get_table){
      echo "<table border='1'>
      <tr>
        <th>Attempt ID</th>
        <th>Student ID</th>
        <th>Quiz ID</th>
        <th>Quiz Name</th>
        <th>Result</th>
        <th>Date attempt</th>
      </tr>";


      while ($row = mysqli_fetch_array($result_get_table)) {
        // echo $row['attempt_id'];
        echo "<tr>";
        echo "<td>" . $row['attempt_id'] . "</td>";
        echo "<td>" . $row['student_id'] . "</td>";
        echo "<td>" . $row['quiz_id'] . "</td>";
        echo "<td>" . $row['quiz_name'] . "</td>";
        echo "<td>" . $row['student_score'] . "</td>";
        echo "<td>" . $row['date_attempt'] . "</td>";
        echo "</tr>";
      };
      echo "</table>";

    }else{
      echo "Not ok";
    }
  ?>
<h3>logout</h3>
<a href="includes/logout.php"><button>Logout</button></a>
</body>

</html>