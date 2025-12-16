<?php
require_once "../config/database.php";
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT count(quiz.title) AS total_quiz FROM quiz JOIN users WHERE quiz.enseignant_id = $user_id AND users.id = $user_id;");

$row = $result->fetch_assoc();

$num_quiz = $row['total_quiz'];

$result = $conn->query("SELECT count(category.category_name) AS total_category FROM category JOIN users WHERE category.created_by = $user_id AND users.id = $user_id;;");

$row = $result->fetch_assoc();

$num_category = $row['total_category'];

$result = $conn->query("SELECT COUNT(*) AS total_students FROM users WHERE ROLE = 'student';");

$row = $result->fetch_assoc();

$num_students = $row['total_students'];

$result = $conn->query("SELECT AVG(score) AS average_score FROM result");

$row = $result->fetch_assoc();

$avg_score = round($row['average_score'] , 2);
?>



