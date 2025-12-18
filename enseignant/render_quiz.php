<?php
    include "../config/database.php";
    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT category.category_name , quiz.title , quiz.description , COUNT(DISTINCT result.student_id) AS student_count FROM quiz JOIN result ON quiz.id = result.quiz_id JOIN category ON category.id = quiz.category_id WHERE quiz.enseignant_id = $user_id GROUP BY quiz.id;");
    $results = $result->fetch_all(MYSQLI_ASSOC);