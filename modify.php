<?php
include("includes/header.php");
$quiz_id = $_SESSION['quiz_id'];

$get_table = "SELECT * FROM quizzes WHERE quiz_id ='$quiz_id'";


$result = mysqli_query($con, $get_table);

echo "<h1>Editing Quiz</h1>";
echo "<table border='1'>
    <tr>
      <th>Quiz ID</th>
      <th>Quiz Name</th>
      <th>Author</th>
      <th>Availability</th>
      <th>Duration</th>
    </tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['quiz_id'] . "</td>";
  echo "<td>" . $row['quiz_name'] . "</td>";
  echo "<td>" . $row['author'] . "</td>";
  echo "<td>" . $row['availability'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "</tr>";

  // $quiz_id = $row['quiz_id'];
  $_SESSION['quiz_name'] = $row['quiz_name'];
};
echo "</table>";

if (isset($_POST['edit_button'])) {
  $question_id = $_POST['question_id'];
  $check_query = "SELECT question_id FROM questionbank WHERE question_id='$question_id'";

  $query = mysqli_query($con, $check_query);

  if (mysqli_num_rows($query) == 1) {
    $_SESSION['question_id'] = $question_id;
    // echo $_SESSION['question_id'];
    header("Location: modify_question.php");
  } else {
    echo "Please input a correct question id.";
  }
  
} else if (isset($_POST['del_quest_button'])) {
  $del_questID = $_POST['del_questID'];

  $check_query = "SELECT question_id FROM questionbank WHERE question_id='$del_questID'";

  $query = mysqli_query($con, $check_query);
  if (mysqli_num_rows($query) == 1) {
    $delete_question_query = "DELETE FROM questionbank WHERE question_id='$del_questID'";

    if (mysqli_query($con, $delete_question_query)) {
      echo "Question " . $del_questID . " has been deleted.";
    } else {
      echo "Not deleted.";
    }
  }else{
    echo "Please Input correct question ID.";
  }

} else if(isset($_POST['add_quest_button'])){
  echo $_SESSION['quiz_id'];
  echo $_SESSION['quiz_name'];
  header("Location: addQuestion.php");
} else{

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modify Quiz</title>
  <link rel="stylesheet" href="assets/css/modify.css">
</head>

<body>


  <h3>Questions in quiz ID <?php echo $quiz_id; ?></h3>
  <?php
  $get_table = "SELECT * FROM questionbank WHERE quiz_id = '$quiz_id'";

  $result = mysqli_query($con, $get_table);

  echo "<table border='1'>
    <tr>
      <th>Question ID</th>
      <th>Question Name</th>
      <th>Option 1</th>
      <th>Option 2</th>
      <th>Option 3</th>
      <th>Option 4</th>
      <th>Question Answer</th>
    </tr>";

  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['question_id'] . "</td>";
    echo "<td>" . $row['question'] . "</td>";
    echo "<td>" . $row['option1'] . "</td>";
    echo "<td>" . $row['option2'] . "</td>";
    echo "<td>" . $row['option3'] . "</td>";
    echo "<td>" . $row['option4'] . "</td>";
    echo "<td>" . $row['question_ans'] . "</td>";
    echo "</tr>";

    $quiz_id = $row['quiz_id'];
    $quiz_name = $row['quiz_name'];
  };
  echo "</table>";
  $_SESSION['quiz_id'] = $quiz_id;
  ?>

  <form action="modify.php" method="POST">
    <h3>Add Question</h3>
    <input type="submit" name="add_quest_button" value="Add Question">
    <br>
  </form>

  <form action="modify.php" method="POST">
    <h3>Which question you want to edit?</h3>
    <input type="text" style="width:20%" name="question_id" placeholder="Enter the question ID">
    <input type="submit" style="margin-top: 10px" name="edit_button" value="Edit Question">
    <br>
  </form>


  <form action="modify.php" method="POST">
    <h3>Delete Question</h3>
    <input type="text" style="width:20%" name="del_questID" placeholder="Type the question id you want to delete" required>
    <input type="submit" name="del_quest_button" value="Delete Question">
    <br>
  </form>

  <form action="staff.php">
    <input type="submit" style="margin-top: 20px" value="Go to main page" />
  </form>

</body>

</html>