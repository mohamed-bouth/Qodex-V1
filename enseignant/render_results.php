<?php
    include "../config/database.php";
    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT users.user_name , quiz.title , result.score , result.completed_at FROM result JOIN users on result.student_id = users.id JOIN quiz on quiz.id = result.quiz_id AND quiz.enseignant_id = $user_id;");
    $results = $result->fetch_all(MYSQLI_ASSOC);