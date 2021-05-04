<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Details</title>
  <link rel="stylesheet" href="quiz_detail.css">
</head>

<body>
  <h1>Quiz Bank</h1>
  <?php
  require("includes/header.php");

  $get_table = "SELECT quizzes.quiz_id, 
                  quizzes.quiz_name,
                  quizzes.author,
                  quizzes.availability,
                  quizzes.duration,
                  questionBank.question,
                  questionBank.question_id,
                  questionBank.option1,
                  questionBank.option2,
                  questionBank.option3,
                  questionBank.option4,
                  questionBank.question_ans
                  FROM quizzes 
                  JOIN questionBank 
                  ON quizzes.quiz_id = questionBank.quiz_id";

  $result = mysqli_query($con, $get_table);

  echo "<table border='1'>
    <tr>
      <th>Quiz ID</th>
      <th>Quiz Name</th>
      <th>Author</th>
      <th>Availability</th>
      <th>Duration</th>
      <th>Question ID</th>
      <th>Option 1</th>
      <th>Option 2</th>
      <th>Option 3</th>
      <th>Option 4</th>
      <th>Question Answer</th>
    </tr>";

  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['quiz_id'] . "</td>";
    echo "<td>" . $row['quiz_name'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
    echo "<td>" . $row['availability'] . "</td>";
    echo "<td>" . $row['duration'] . "</td>";
    echo "<td>" . $row['question_id'] . "</td>";
    echo "<td>" . $row['option1'] . "</td>";
    echo "<td>" . $row['option2'] . "</td>";
    echo "<td>" . $row['option3'] . "</td>";
    echo "<td>" . $row['option4'] . "</td>";
    echo "<td>" . $row['question_ans'] . "</td>";
    echo "</tr>";
  };
  echo "</table>";
  ?>
  <h3>If you want to modify the quiz or question, Please go back to main page.</h3>
  <form action="staff.php">
    <input type="submit" value="Go to main page" />
  </form>
</body>

</html>