/* Part E: Stored Procedure */
DELIMITER $$
CREATE PROCEDURE getStudentBelowFourty()
BEGIN

  SELECT CONCAT(users.first_name, " ", users.last_name), 
              studentanswer.student_score 
  FROM studentanswer 
  JOIN users
  ON student_id = users.id
  WHERE studentanswer.student_score <= 40;
END$$
DELIMITER;

/* Part E: Trigger */
DELIMITER$$
CREATE TRIGGER del_quiz_log
AFTER DELETE ON quizzes
	INSERT INTO staff_del_quiz 
    staff.id = staff.id,
    quiz_id = OLD.quiz_id,
    time = NOW();
END$$
DELIMITER; 



/* Online Editor Version */
DELIMITER $$
CREATE PROCEDURE getStudentBelowFourty()
BEGIN

  SELECT CONCAT(users.first_name, " ", users.last_name), studentAnswer.student_score 
  FROM studentAnswer 
  JOIN users
  ON student_id = users.user_id
  WHERE studentAnswer.student_score <= 40;
END;  

CALL getStudentBelowFourty();

https://paiza.io/projects/WOEbtPau-bSvPlkS0YDs-g?language=mysql