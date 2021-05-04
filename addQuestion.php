<?php
  include("includes/header.php");
  // session_destroy();

  $quiz_name = $_SESSION['quiz_name'];
  $quiz_id = $_SESSION['quiz_id'];

  echo "<h3>" . "Quiz Name: " . $quiz_name . "</h3>";
  echo "<h3>" . "Quiz Id: " . $quiz_id . "</h3>";

if (isset($_POST['add_question_button'])) {
  //store quiz information

  $question = $_POST['question_name'];
  $option1 = $_POST['option1'];
  $option2 = $_POST['option2'];
  $option3 = $_POST['option3'];
  $option4 = $_POST['option4'];
  $question_ans = $_POST['question_answer'];


  //if question_ans = one of the value of option
  if ($question_ans == $option1 || $question_ans == $option2 || $question_ans == $option3 || $question_ans == $option4) {
    $add_question_query = "INSERT INTO questionbank VALUES (NULL, '$quiz_id', '$question', '$option1', '$option2', '$option3', '$option4', '$question_ans')";

    $result = mysqli_query($con, $add_question_query);

    if ($result) {
      echo "Question added.";
    } else {
      echo ('MySQL went wrong. ' . mysqli_errno($con));
    }
  } else {
    echo "Please input a correct question answer.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add question</title>
</head>

<body>
  <!-- <h1>Hello <?php echo $fname . " " . $lname ?></h1> -->
  <form action="addQuestion.php" method="POST">
    <input type="text" name="question_name" placeholder="Question" required><br>
    <input type="text" name="option1" placeholder="option1" required><br>
    <input type="text" name="option2" placeholder="option2" required><br>
    <input type="text" name="option3" placeholder="option3" required><br>
    <input type="text" name="option4" placeholder="option4" required><br>
    <input type="text" name="question_answer" placeholder="Type the correct answer" required><br>
    <input type="submit" name="add_question_button" value="Add Question">
  </form>
  <form action="modify.php">
    <input type="submit" value="Go back quiz page" />
  </form>
  <form action="staff.php">
    <input type="submit" value="Go to main page" />
  </form>

</body>

</html>