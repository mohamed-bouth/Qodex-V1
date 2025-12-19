<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit();
    }
    require_once "../config/database.php";

    if(isset($_POST['deleteQuiz'])){

        $quiz_id = $_POST['quiz_id'];
        $stmt1 = $conn->prepare("DELETE FROM question WHERE quiz_id = ?");
        $stmt1->execute([$quiz_id]);

        $stmt = $conn->prepare("DELETE FROM quiz WHERE id = ? ");
        $stmt->execute([$quiz_id]);
        header('location: ./manage_quizzes.php');
        exit();
    } 
?>