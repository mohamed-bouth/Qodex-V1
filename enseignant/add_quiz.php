<?php
    session_start();
    require_once "../config/database.php";

    $user_id = $_SESSION['user_id'];
    $_SESSION['questions_data'] = $_POST['questions'];

    if(isset($_POST['addQuiz'])){
        $quizTitle = $_POST['quizTitre'];
        $_SESSION['quizTitre'] = $_POST['quizTitre'];

        $quizCategory = $_POST['categorie_id'];

        $quizDescription = $_POST['quizDescription'];
        $_SESSION['quizDescription'] = $_POST['quizDescription'];

        $count = 0;
        $flage = false;
        foreach ($_POST['questions'] as $q) {
            $count++;

            if (empty($q['question'])) {
                $flage = true;
            }

            for ($i = 1; $i < 5; $i++) {
                if (empty($q['option' . $i])) {
                    $flage = true;
                }
            }
        }
        if($flage === true){
            $_SESSION['num_question'] = $count;
            $_SESSION['qustion_error'] = true;
            header('location: ./manage_quizzes.php');
            exit();
        };
        if(empty($quizTitle)){
            $_SESSION['num_question'] = $count;
            $_SESSION['title_error'] = 'Title is empty!';
            header('location: ./manage_quizzes.php');
            exit();
        };
        if(empty($quizCategory)){
            $_SESSION['num_question'] = $count;
            $_SESSION['category_error'] = 'check the category!';
            header('location: ./manage_quizzes.php');
            exit();
        };
        if(empty($quizDescription)){
            $_SESSION['num_question'] = $count;
            $_SESSION['description_error'] = 'description is empty!';
            header('location: ./manage_quizzes.php');
            exit();
        };
        $stmt = $conn->prepare("SELECT * FROM quiz WHERE quiz.title = ? AND quiz.enseignant_id = ?");

        $stmt->bind_param("si" , $quizTitle , $user_id);

        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            header('location: ./manage_quizzes.php');
            $_SESSION['title_error'] = 'title aready exist !';
            exit();
        }

        $stmt = $conn->prepare("
            INSERT INTO quiz (title, description, category_id, enseignant_id, id_active)
            VALUES (?, ?, ?, ?, 1)
        ");
        $stmt->bind_param("ssii", $quizTitle, $quizDescription, $quizCategory, $user_id);
        $stmt->execute();

        $quiz_id = $conn->insert_id;
        $stmt->close();

        $stmt = $conn->prepare("
            INSERT INTO question 
            (quiz_id, question, option_1, option_2, option_3, option_4, correct_option)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        foreach ($_POST['questions'] as $q) {
            $questionOption = [];
            for ($i = 1; $i <= 4; $i++) {
                $questionOption[] = $q['option' . $i];
            }

            $stmt->bind_param(
                "isssssi",
                $quiz_id,
                $q['question'],
                $questionOption[0],
                $questionOption[1],
                $questionOption[2],
                $questionOption[3],
                $q['correct']
            );
            $stmt->execute();
        }

        $stmt->close();

        header('location: ./manage_quizzes.php');
        exit();


    };


