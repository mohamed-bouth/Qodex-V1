<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit();
    }
require_once "../config/database.php";

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addQuiz'])) {

    $quiz_id = $_POST['quiz_id_form']; 
    $_SESSION['old_quiz_id'] = $_POST['quiz_id_form'];

    $quizTitle = trim($_POST['quizTitre']);
    $quizCategory = $_POST['categorie_id'];
    $quizDescription = trim($_POST['quizDescription']);
    $questions = $_POST['questions'] ?? [];


    $_SESSION['old_data'] = $_POST;
    $_SESSION['quizTitre'] = $quizTitle;
    $_SESSION['quizDescription'] = $quizDescription;


    if (empty($quiz_id)) {

        $_SESSION['error_message'] = "Quiz ID is missing!";
        header('location: ./manage_quizzes.php');
        exit();
    }

    $count = 0;
    $flag = false;
    foreach ($questions as $q) {
        $count++;
        if (empty(trim($q['question']))) $flag = true;
        for ($i = 1; $i <= 4; $i++) {
            if (empty(trim($q['option' . $i]))) $flag = true;
        }
        if (empty($q['correct'])) $flag = true;
    }

    if ($flag === true) {
        $_SESSION['num_question'] = $count;
        $_SESSION['qustion_error'] = true;
        $_SESSION['open_edit_modal'] = true;
        header('location: ./manage_quizzes.php');
        exit();
    }

    if (empty($quizTitle)) {
        $_SESSION['title_error'] = 'Title is empty!';
        $_SESSION['open_edit_modal'] = true;
        header('location: ./manage_quizzes.php');
        exit();
    }
    
    if (empty($quizCategory)) {
        $_SESSION['category_error'] = 'Check the category!';
        $_SESSION['open_edit_modal'] = true;
        header('location: ./manage_quizzes.php');
        exit();
    }
    
    if (empty($quizDescription)) {
        $_SESSION['description_error'] = 'Description is empty!';
        $_SESSION['open_edit_modal'] = true;
        header('location: ./manage_quizzes.php');
        exit();
    }


    $stmt = $conn->prepare("SELECT id FROM quiz WHERE title = ? AND enseignant_id = ? AND id != ?");
    $stmt->bind_param("sii", $quizTitle, $user_id, $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['title_error'] = 'Title already exists in another quiz!';
        $_SESSION['open_edit_modal'] = true;
        header('location: ./manage_quizzes.php');
        exit();
    }
    $stmt->close();

    $conn->begin_transaction();

    try {

        $stmt = $conn->prepare("UPDATE quiz SET title = ?, description = ?, category_id = ?, updated_at = NOW() WHERE id = ? AND enseignant_id = ?");
        $stmt->bind_param("ssiii", $quizTitle, $quizDescription, $quizCategory, $quiz_id, $user_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Error updating quiz info.");
        }
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM question WHERE quiz_id = ?");
        $stmt->bind_param("i", $quiz_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Error deleting old questions.");
        }
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO question (quiz_id, question, option_1, option_2, option_3, option_4, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($questions as $q) {
            $qText = $q['question'];
            $opt1 = $q['option1'];
            $opt2 = $q['option2'];
            $opt3 = $q['option3'];
            $opt4 = $q['option4'];
            $correct = $q['correct'];

            $stmt->bind_param("isssssi", $quiz_id, $qText, $opt1, $opt2, $opt3, $opt4, $correct);
            
            if (!$stmt->execute()) {
                throw new Exception("Error inserting new questions.");
            }
        }
        $stmt->close();

        $conn->commit();
        
        unset($_SESSION['old_data']);
        unset($_SESSION['quizTitre']);
        unset($_SESSION['quizDescription']);
        unset($_SESSION['open_edit_modal']);
        
        $_SESSION['success_message'] = "Quiz updated successfully!";
        header("Location: ./manage_quizzes.php");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error_message'] = "Failed to update: " . $e->getMessage();
        $_SESSION['open_edit_modal'] = true;
        header("Location: ./manage_quizzes.php");
        exit();
    }

} else {
    header("Location: ./manage_quizzes.php");
    exit();
}
?>

    