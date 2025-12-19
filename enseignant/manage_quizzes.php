<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
    }
    include "./render_quiz.php";
    $num_quesion = $_SESSION['num_question'] ?? 0;
    $qustion_error = $_SESSION['qustion_error'] ?? false;
    $openEditModal = $_SESSION['open_edit_modal'] ?? false;
    $oldData = $_SESSION['old_data'] ?? '';
    echo $_SESSION['error_message'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My quiz</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/quiz.css">
</head>
<body>
    <?php include "../includes/header.php"; ?>
    <section class="hero-section">
            <div class="left-hero-section">
                <h1>My Quiz</h1>
                <h3>Create and manage your quiz</h3>
                <div class="btn-container">
                    <button class="right-btn">
                        <img src="../img/list-logo-btn.png" alt="">
                        <p>Create a Quiz</p>
                    </button>
                </div>
            </div>
            <div class="right-hero-section">
                <img src="../img/generated-image-quiz.png" alt="">
            </div>
    </section>
    <section class="quiz-container-section">
        <?php foreach ($results as $quiz) { ?>
            <div class="quiz-container">
                <div class="quiz-container-up">
                    <div class="quiz-container-up-title">
                        <div>
                            <p class="type"><?= $quiz['category_name']; ?></p>
                        </div>
                        <p class="title"><?= $quiz['title']; ?></p>
                        <p class="des"><?= $quiz['description']; ?></p>
                    </div>
                    <div class="quiz-container-up-btn">
                        <button id="editBtn" data-id="<?= $quiz['id'] ?>"><img src="../img/edit-icon.png" alt=""></button>
                        <form action="./delete_quiz.php" method="POST">
                            <input type="hidden" name="quiz_id" value="<?= $quiz['id'] ?>">
                            <button class="quizBtns" name="deleteQuiz" type="submit"><img src="../img/delete-icon.png" alt=""></button>
                        </form>
                    </div>
                </div>
                <div class="quiz-container-down">
                    <div class="quiz-container-down-right">
                        <img src="../img/num-student-icon.png" alt="">
                        <p><?= $quiz['user_count']; ?> Students</p>
                    </div>
                </div>
                <a href="./view_results.php" class="see-btn">
                    <img src="../img/see-results-icon.png" alt="">
                    <p>See the results</p>
                </a>
            </div>
        <?php } ?>
    </section>
    <div id="createQuizModal" class="modal-overlay">
        <div class="modal-container">
            <input  type="hidden" id="num_question"  value="<?= $num_quesion ?>">
            <div class="modal-header">
                <h3 class="modal-title">Create a Quiz</h3>
                <button class="close-icon">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form id="quizForm" class="quiz-form" action="./add_quiz.php" method="POST">
                    <div class="form-row two-columns">
                        <div class="form-group">
                            <label id="titreLabel" class="form-label" <?php if($_SESSION['title_error'] ?? false) echo "style='color: red;'"; ?> > <?= $_SESSION['title_error'] ?? 'Quiz title *' ?></label>
                            <input id="titreInput" type="text" name="quizTitre"  class="form-input" value="<?= $_SESSION['quizTitre'] ?? $oldData['quizTitre'] ?? '' ?>" placeholder="Ex: the basic of HTML5">
                        </div>

                        <div class="form-group">
                            <label class="form-label" ><?= $_SESSION['category_error'] ?? 'Catégory *' ?></label>
                            <select name="categorie_id"  class="form-input" required>
                                <option value="" hidden selected>Category</option>
                                <?php foreach ($options as $opt) { ?>
                                    <option value="<?= $opt['id'] ?>"><?= $opt['category_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label id="descriptionLabel" class="form-label" <?php if($_SESSION['description_error'] ?? false) echo "style='color: red;'"; ?> ><?= $_SESSION['description_error'] ?? 'Description' ?></label>
                        <input id="descriptionInput" name="quizDescription" rows="3" class="form-input" value="<?= $_SESSION['quizDescription'] ??  $oldData['quizDescription'] ?? '' ?>" placeholder="write your quiz Description"></input>
                    </div>

                    <hr class="divider">

                    <div class="questions-section">
                        <div class="section-header">
                            <h4 class="section-title">Questions</h4>
                            <button id="AddQuestion" type="button"  class="btn btn-success btn-sm">
                                 ADD a question
                            </button>

                        </div>

                        <div id="questionsContainer">
                            <div class="question-card">
                                <div class="card-header">
                                    <h5 class="question-number">Question 1</h5>
                                    <button type="button" class="btn-icon-danger delete-btn">
                                        Delete
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Question *</label>
                                    <input id="question" type="text" name="questions[0][question]" value="<?= $oldData['questions'][0]['question'] ?? '' ?>" class="form-input" placeholder="Posez votre question...">
                                </div>

                                <div class="options-grid">
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 1 *</label>
                                        <input type="text" name="questions[0][option1]" value="<?= $oldData['questions'][0]['option1'] ?? '' ?>" class="form-input option">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 2 *</label>
                                        <input type="text" name="questions[0][option2]" value="<?= $oldData['questions'][0]['option2'] ?? '' ?>" class="form-input option">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 3 *</label>
                                        <input type="text" name="questions[0][option3]" value="<?= $oldData['questions'][0]['option3'] ?? '' ?>" class="form-input option">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 4 *</label>
                                        <input type="text" name="questions[0][option4]" value="<?= $oldData['questions'][0]['option4'] ?? '' ?>" class="form-input option">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Réponse correcte *</label>
                                    <select name="questions[0][correct]" class="form-input" required>
                                        <option hidden selected value="">Sélectionner la bonne réponse</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="CancelBtn" type="button"  class="btn btn-secondary">Cancel</button>
                        <button name="addQuiz" id="CreateBtn" type="submit" class="btn btn-primary"> Create</button>
                    </div>
                    <input type="hidden" name="quiz_id_form" value="<?= $_SESSION['old_quiz_id'] ?? '' ?>">
                </form>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
    <script src="../js/show_quiz_modal.js"></script>
    <?php if($num_quesion > 0) { ?>
        <script>
            openModal()
        </script>
    <?php }
    unset($_SESSION['num_question']);
    unset($_SESSION['qustion_error']);
    unset($_SESSION['quizTitre']);
    unset($_SESSION['quizDescription']);
    unset($_SESSION['questions_data']);
    unset($_SESSION['title_error']);
    unset($_SESSION['category_error']);
    unset($_SESSION['description_error']);
    unset($_SESSION['old_quiz_id']);
    ?>
    <?php if($openEditModal){ ?>
        <script>
            openModal()
            form.action = './edit_quiz.php'
        </script>

    <?php } 
    unset($_SESSION['open_edit_modal']);
    unset($_SESSION['old_data']);
    unset($_SESSION['error_message']);
    ?>
</body>
</html>