<?php
    include "../config/database.php";
    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT 
                                quiz.id,
                                category.category_name,
                                quiz.title,
                                quiz.description,
                                COUNT(DISTINCT users.id) AS user_count
                            FROM quiz
                            JOIN category 
                                ON category.id = quiz.category_id
                            LEFT JOIN result 
                                ON result.quiz_id = quiz.id
                            LEFT JOIN users 
                                ON users.id = result.student_id
                            WHERE quiz.enseignant_id = 4
                            GROUP BY quiz.id;
                            ");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $option = $conn->query("SELECT * FROM category WHERE created_by = $user_id");
    $options = $option->fetch_all(MYSQLI_ASSOC);