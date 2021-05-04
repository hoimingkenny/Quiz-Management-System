<?php
require("includes/header.php");

$question_id = $_SESSION['question_id'];
$quiz_id = $_SESSION['quiz_id'];

$get_question_detail = "SELECT * FROM questionbank WHERE question_id = '$question_id'";
$result = mysqli_query($con, $get_question_detail);

if (mysqli_num_rows($result) == 1) {
  $rows = mysqli_fetch_array($result);

  $_SESSION['question_name'] = $rows['question'];
  $_SESSION['option1'] = $rows['option1'];
  $_SESSION['option2'] = $rows['option2'];
  $_SESSION['option3'] = $rows['option3'];
  $_SESSION['option4'] = $rows['option4'];
  $_SESSION['question_ans'] = $rows['question_ans'];
  // echo "Question details fetched.";
} else {
  echo "MySQL is not OK.";
}

if (isset($_POST['modify_question_button'])) {
  // echo "<br>Pressed modify button.";

  $question_name = $_POST['question_name'];
  $option1 = $_POST['option1'];
  $option2 = $_POST['option2'];
  $option3 = $_POST['option3'];
  $option4 = $_POST['option4'];
  $question_answer = $_POST['question_answer'];

  if ($question_answer == $option1 || $question_answer == $option2 || $question_answer == $option3 || $question_answer == $option4) {

    $update_question_query = "UPDATE questionbank SET question='$question_name',
                                                      option1='$option1',
                                                      option2='$option2',
                                                      option3='$option3',
                                                      option4='$option4',
                                                      question_ans='$question_answer'
                                                  WHERE question_id='$question_id'";

    if (mysqli_query($con, $update_question_query)) {
      echo "<br>Question edited.";
      $_SESSION['question_name'] = $question_name;
      $_SESSION['option1'] = $option1;
      $_SESSION['option2'] = $option2;
      $_SESSION['option3'] = $option3;
      $_SESSION['option4'] = $option4;
      $_SESSION['question_ans'] = $question_answer;
    } else {
      echo ('<br>MySQL went wrong. ' . mysqli_errno($con));
    }
  } else {
    echo "<br>Please input a correct question answer.";
  }
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
  <form action="modify_question.php" method="POST">
    <h3>Question ID: <?php echo $question_id ?></h3>
    <h3>Question Name: </h3>
    <input type="text" name="question_name" value="<?php
                                                    echo $_SESSION['question_name'];
                                                    ?>">
    <br>
    <h3>Option1: </h3>
    <input type="text" name="option1" value="<?php
                                              echo $_SESSION['option1'];
                                              ?>">
    <br>
    <h3>Option2: </h3>
    <input type="text" name="option2" value="<?php
                                              echo $_SESSION['option2'];
                                              ?>">
    <br>
    <h3>Option3: </h3>
    <input type="text" name="option3" value="<?php
                                              echo $_SESSION['option3'];
                                              ?>">
    <br>
    <h3>Option4: </h3>
    <input type="text" name="option4" value="<?php
                                              echo $_SESSION['option4'];
                                              ?>">
    <br>
    <h3>Question Answer: </h3>
    <input type="text" name="question_answer" value="<?php
                                                      echo $_SESSION['question_ans'];
                                                      ?>">
    <br>
    <br>
    <input type="submit" style="width: 15%;" name="modify_question_button" value="Modify Question">
  </form>

  <form action="modify.php" method="POST">
    <br>
    <input type="submit" style="width: 15%;" value="Back">
  </form>


</body>

</html>