<?php
require 'config/config.php';
if (isset($_SESSION['take_quiz_id'])) {
  $quiz_id = $_SESSION['take_quiz_id'];
} else {
  echo "Nothing here.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Take Quiz</title>
</head>

<body>
  <h3>You are taking quiz ID: <?php echo $quiz_id; ?></h3>
  <form action="check.php" method="POST">
    <?php
    $get_question_query = "SELECT * FROM questionbank WHERE quiz_id='$quiz_id'";
    $query = mysqli_query($con, $get_question_query);

    $i = 0;
    while ($rows = mysqli_fetch_array($query)) {
      // echo sizeof($rows['question_ans']);
    ?>
      <h3> <?php echo $rows['question'] ?> </h3>
      <input type="radio" name='quizCheck[<?php echo $i ?>]' value="<?php echo $rows['option1']; ?>">
      <?php echo $rows['option1'] ?><br>
      <input type="radio" name='quizCheck[<?php echo $i ?>]' value="<?php echo $rows['option2']; ?>">
      <?php echo $rows['option2'] ?><br>
      <input type="radio" name='quizCheck[<?php echo $i ?>]' value="<?php echo $rows['option3']; ?>">
      <?php echo $rows['option3'] ?><br>
      <input type="radio" name='quizCheck[<?php echo $i ?>]' value="<?php echo $rows['option4']; ?>">
      <?php echo $rows['option4'] ?><br>

    <?php
      $i = $i + 1;
      // echo $i;
    }
    ?>
    <br>
    <input type="submit" name="quiz_submit" value="Submit">
  </form>

</body>

</html>