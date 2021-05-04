<?php
  require("includes/header.php");

  $quiz_id = $_SESSION['quiz_id'];

  $get_quiz_detail = "SELECT * FROM quizzes WHERE quiz_id = '$quiz_id'";
  $result = mysqli_query($con, $get_quiz_detail);

  if (mysqli_num_rows($result) == 1) {
    $rows = mysqli_fetch_array($result);

    $_SESSION['quiz_name'] = $rows['quiz_name'];
    $_SESSION['author'] = $rows['author'];
    $_SESSION['availability'] = $rows['availability'];
    $_SESSION['duration'] = $rows['duration'];

    // echo "Quiz details fetched.";
  } else {
    echo "MySQL is not OK.";
  }

  //check if the MODIFY button pressed
  if (isset($_POST['modify_quiz_button'])) {
    // echo "<br>Pressed modify button.";

    $quiz_name = $_POST['quiz_name'];
    $author = $_POST['author'];
    $availability = $_POST['availability'];
    $duration = $_POST['duration'];

    $update_quiz_query = "UPDATE quizzes SET quiz_name='$quiz_name',
                                              author='$author',
                                              availability='$availability',
                                              duration='$duration'
                                              WHERE quiz_id='$quiz_id'";

    if (mysqli_query($con, $update_quiz_query)) {
      echo "<br>Quiz Information edited.";
      $_SESSION['quiz_name'] = $_POST['quiz_name'];
      $_SESSION['author'] = $_POST['author'];
      $_SESSION['availability'] = $_POST['availability'];
      $_SESSION['duration'] = $_POST['duration'];
    } else {
      echo ('<br>MySQL went wrong. ' . mysqli_errno($con));
    }

  } else {
    // echo "<br>Please input a correct question answer.";
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit question</title>
  <link rel="stylesheet" href="assets/css/modify_question.css">
</head>

<body>
  <form action="modify_quiz_info.php" method="POST">
    <!-- <h3>Question ID: <?php echo $question_id ?></h3> -->
    <h3>Quiz Name: </h3>
    <input type="text" name="quiz_name" value="<?php
                                                    echo $_SESSION['quiz_name'];
                                                    ?>" required>
    <br>
    <h3>Author: </h3>
    <input type="text" name="author" value="<?php
                                              echo $_SESSION['author'];
                                              ?>" required>
    <br>
    <h3>Availability: </h3>
    <input type="text" name="availability" value="<?php
                                              echo $_SESSION['availability'];
                                              ?>" required >
    <br>
    <h3>Duration: </h3>
    <input type="text" name="duration" value="<?php
                                              echo $_SESSION['duration'];
                                              ?>" required>
    <br>
    
    <br>
    <input type="submit" style="width: 15%;" name="modify_quiz_button" value="Modify Quiz">
  </form>

  <form action="staff.php" method="POST">
    <br>
    <input type="submit" style="width: 15%;" value="Back">
  </form>


</body>

</html>