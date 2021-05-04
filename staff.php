<?php
include("includes/header.php");
$user_id = $_SESSION['userID'];

if (isset($_POST['modify_quiz_button'])) {
  $quiz_id = $_POST['mod_quizID'];

  //Check whether you have that quiz question
  $modify_query = "SELECT quiz_id FROM quizzes WHERE quiz_id='$quiz_id'";
  $result_modify = mysqli_query($con, $modify_query);

  if (mysqli_num_rows($result_modify) == 1) {
    $row = mysqli_fetch_array($result_modify);

    // remember the quiz_id that want to modify
    $_SESSION['quiz_id'] = $row['quiz_id'];

    header("Location: modify.php");
  } else {
    echo "Please enter correct quiz id.";
  }
} else if (isset($_POST['modify_quiz_info_button'])){
  
  $quiz_id = $_POST['mod_quiz_informationID'];
  
  //Check whether you have that quiz question
  $modify_query = "SELECT quiz_id FROM quizzes WHERE quiz_id='$quiz_id'";
  $result_modify = mysqli_query($con, $modify_query);
  
  if (mysqli_num_rows($result_modify) == 1) {
    $row = mysqli_fetch_array($result_modify);
    
    // remember the quiz_id that want to modify
    $_SESSION['quiz_id'] = $row['quiz_id'];
    
    header("Location: modify_quiz_info.php");
  } else {
    echo "Please enter correct quiz id.";
  }
  
} else if (isset($_POST['del_quest_button'])) {
  $question_id = $_POST['del_questID'];
  $delete_question_query = "DELETE FROM questionbank WHERE question_id='$question_id'";

  if (mysqli_query($con, $delete_question_query)) {
    echo "Question" . $question_id . "has been deleted.";
  } else {
    echo "Not deleted.";
  }
}else if (isset($_POST['del_quiz_button'])){
  //Create trigger

    //Create trigger
    $date = date('Y-m-d H:i:s');
    $create_trigger = "CREATE TRIGGER del_quiz_log
                        AFTER DELETE ON quizzes
                        FOR EACH ROW
                        BEGIN
                          INSERT INTO staff_del_quiz 
                            (NULL, staff_id, quiz_id, time)
                          VALUES
                            ('$user_id', '$quiz_id', $date)
                        END//";

    $result_trigger = mysqli_query($con, $create_trigger);

    if($result_trigger){
      echo "SSQLL ok";
    }else{
      echo "sQL not ok";
    }


  $quiz_id = $_POST['del_quizID'];
  $delete_question_first = "DELETE FROM questionbank WHERE quiz_id='$quiz_id'";

  if(mysqli_query($con, $delete_question_first)){
    $delete_quiz_query = "DELETE FROM quizzes WHERE quiz_id='$quiz_id'";

    if (mysqli_query($con, $delete_quiz_query)){
     echo "Quiz" . $quiz_id . "has been deleted.";
    } else{
      echo "Can't delete quiz." . mysqli_errno($con);
    }
  }else{
    echo "Can't delete quiz." . mysqli_errno($con);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create quiz</title>
  <link rel="stylesheet" href="staff.css">
</head>

<body>
  <h1>Hello <?php echo $fname . " " . $lname ?></h1>

  <br>
  <a href="includes/logout.php"><button>Logout</button></a>
  <br>
  <h3>Quiz Bank</h3>
  <?php
  $get_table = "SELECT *
                FROM quizzes";

  $result = mysqli_query($con, $get_table);

  $get_number_question_query = "SELECT quizzes.quiz_id, 
                                       quizzes.quiz_name,
                                       COUNT(quizzes.quiz_id) AS 'No. of question in quiz'
                                       FROM quizzes 
                                       JOIN questionBank 
                                       ON quizzes.quiz_id = questionBank.quiz_id
                                       GROUP BY quizzes.quiz_id";

  $get_number_question_result = mysqli_query($con, $get_number_question_query);

  $number_array = array();
  $my_array[] = "";
  $j = 1;

  while($rows = mysqli_fetch_array($get_number_question_result)){
    // echo $rows['No. of question in quiz'] . "<br>";
    $my_array[] = $rows['No. of question in quiz'];
  }

  echo "<table border='1'>
    <tr>
      <th>Quiz ID</th>
      <th>Quiz Name</th>
      <th>Author</th>
      <th>Availability</th>
      <th>Duration</th>
      <th>No. Question</th>
      <th>Details</th>
    </tr>";

  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['quiz_id'] . "</td>";
    echo "<td>" . $row['quiz_name'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
    echo "<td>" . $row['availability'] . "</td>";
    echo "<td>" . $row['duration'] . "</td>";
    if ($my_array[$j] < 1){
      echo "<td>0</td>";
    }else{
      echo "<td>" . $my_array[$j] . "</td>";
    }
    $j ++;
  ?>
    <td><a href="quiz_detail.php">View details</a></td>
  <?php
    echo "</tr>";
  };
  echo "</table>";
  ?>
  <br>

  <h3>Student Attempts</h3>
  <?php
    // echo $user_id;
    $get_score_q = "SELECT * FROM studentanswer
                      JOIN users 
                      ON studentanswer.student_id = users.id";

    $result_get_table = mysqli_query($con, $get_score_q);

    if($result_get_table){
      echo "<table border='1'>
      <tr>
        <th>Attempt ID</th>
        <th>Quiz ID</th>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Result</th>
        <th>Date attempt</th>
      </tr>";


      while ($row = mysqli_fetch_array($result_get_table)) {
        // echo $row['attempt_id'];
        echo "<tr>";
        echo "<td>" . $row['attempt_id'] . "</td>";
        echo "<td>" . $row['quiz_id'] . "</td>";
        echo "<td>" . $row['student_id'] . "</td>";
        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
        echo "<td>" . $row['student_score'] . "</td>";
        echo "<td>" . $row['date_attempt'] . "</td>";
        echo "</tr>";
      };
      echo "</table>";

    }else{
      echo "Not ok";
    }
  ?>
  <br>

  <div class="create_quiz">
    <h3>Create Quiz</h3>
    <form action="createQuiz.php">
      <input type="submit" value="Create Quiz" />
    </form>
  </div>
  <br>

  <div class="modify_quiz">
    <h3>Modify Quiz Information</h3>
    <form action="staff.php" method="POST">
      <input type="text" name="mod_quiz_informationID" placeholder="Type the quiz id of the test you want to modify" required>
      <br>
      <input type="submit" style="width: 15%;" name="modify_quiz_info_button" value="Modify Quiz">
    </form>
  </div>
  <br>

  <div class="modify_quiz">
    <h3>Modify question/ Add more questions in quiz</h3>
    <form action="staff.php" method="POST">
      <input type="text" name="mod_quizID" placeholder="Type the quiz id of the test you want to modify" required>
      <br>
      <input type="submit" style="width: 15%;" name="modify_quiz_button" value="Modify Question">
    </form>
  </div>

  <div class="delete_quiz">
    <h3>Delete Quiz</h3>
    <form action="staff.php" method="POST">
      <input type="text" style="width:30%" name="del_quizID" placeholder="Type the quiz id you want to delete" required>
      <br>
      <input type="submit" style="width:15%" name="del_quiz_button" value="Delete Quiz">
    </form>
  </div>
</body>

</html>