DROP DATABASE quiz;
# DROP TABLE attempt, quiz, student, quizQuestion, question

CREATE DATABASE quiz;
USE quiz;

CREATE TABLE student(
    student_id INTEGER AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (student_id)
);

CREATE TABLE quizzes(
    quiz_id INTEGER AUTO_INCREMENT,
    quiz_name VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    availability VARCHAR(255) NOT NULL,
    duration INTEGER NOT NULL,
    PRIMARY KEY (quiz_id)
);

CREATE TABLE questionBank(
    question_id INTEGER,
    quiz_id INTEGER,

    FOREIGN KEY (quiz_id) REFERENCES quizzes(quiz_id)
    FOREIGN KEY (question_id) REFERENCES question(question_id)
);

CREATE TABLE question(
    question_id INTEGER AUTO_INCREMENT,
    question_name VARCHAR(255) NOT NULL,
    option1 VARCHAR (255) NOT NULL,
    option2 VARCHAR (255) NOT NULL,
    option3 VARCHAR (255) NOT NULL,
    option4 VARCHAR (255) NOT NULL,
    answer VARCHAR (255) NOT NULL,
)
CREATE TABLE studentAnswer(
    attempt_id INTEGER AUTO_INCREMENT,
    quiz_id INTEGER NOT NULL,
    student_id INTEGER NOT NULL,
    student_score INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    PRIMARY KEY (attempt_id),
    FOREIGN KEY (quiz_id) REFERENCES quizzes(quiz_id),
    FOREIGN KEY (student_id) REFERENCES users(user_id)
);