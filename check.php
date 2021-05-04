<?php
  include("includes/header.php");
  $quiz_id = $_SESSION['take_quiz_id'];
  $userID = $_SESSION['userID'];

  if(isset($_POST['quiz_submit'])){

    if(!empty($_POST['quizCheck'])){
      $count = count($_POST['quizCheck']);

      // echo "You have selected " . $count . "options."; 
    }

    $result = 0;
    $i = 0;

    $selected = $_POST['quizCheck'];
    // print_r($selected);

    $count_num_question_query = "SELECT COUNT(*) AS 'No_questions' FROM questionbank WHERE quiz_id='$quiz_id'";
    $query_count = mysqli_query($con, $count_num_question_query);
    $count_question = 0;

    if($row=mysqli_fetch_array($query_count)){
      $count_question = $row['No_questions'];
      // echo $count_question . "<br>";
    }else{
      echo "Can't get no_questions";
    }

    $check_answer_query = "SELECT * FROM questionbank WHERE quiz_id='$quiz_id'";
    $query = mysqli_query($con, $check_answer_query);

    if($query){
      while($rows=mysqli_fetch_array($query)){
        // print_r($rows['question_ans']);

        $checked = $rows['question_ans'] == $selected[$i];

        if($checked){
          $result++;
        }
        $i++;
      }
      // echo $quiz_id . "<br>";
      // echo $userID . "<br>";
      // echo $result . "<br>";
      $final_score = ($result/$count_question) * 100;
      // echo $final_score;

      $date = date('Y-m-d H:i:s');
      $store_result_query = "INSERT INTO studentanswer VALUES (NULL, '$quiz_id', '$userID', '$final_score', '$date')";
      $query = mysqli_query($con, $store_result_query);
      if($query){
        // echo "Stored record";
      }else{
        echo "MYSQL not ok" . mysqli_errno($con);
      }
      //insert the score 
      
    }else{
      echo "Not good";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h3>Student ID: <?php echo $userID ?> </h3>
  <h3>Number of questions in the quiz: <?php echo $count_question ?> </h3>
  <h3>Number of questions answered: <?php echo $count ?> </h3>
  <h3>Your score: <?php echo $final_score ?>%</h3>
  <form action="index.php">
    <input type="submit" value="Go to main page" />
  </form>
</body>
</html>