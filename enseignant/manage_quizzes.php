<?php
    session_start();
    include "./render_quiz.php"
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
                        <img src="../img/edit-icon.png" alt="">
                        <img src="../img/delete-icon.png" alt="">
                    </div>
                </div>
                <div class="quiz-container-down">
                    <div class="quiz-container-down-right">
                        <img src="../img/num-student-icon.png" alt="">
                        <p><?= $quiz['student_count']; ?> Students</p>
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
            
            <div class="modal-header">
                <h3 class="modal-title">Créer un Quiz</h3>
                <button class="close-icon">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form class="quiz-form">
                    <input type="hidden" name="csrf_token" value="token_here"> 
                    
                    <div class="form-row two-columns">
                        <div class="form-group">
                            <label class="form-label">Quiz title *</label>
                            <input type="text" name="titre"  class="form-input" placeholder="Ex: the basic of HTML5">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Catégory *</label>
                            <select name="categorie_id"  class="form-input">
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-input" placeholder="write your quiz Description"></textarea>
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
                                    <input type="text" name="questions[0][question]" class="form-input" placeholder="Posez votre question...">
                                </div>

                                <div class="options-grid">
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 1 *</label>
                                        <input type="text" name="questions[0][option1]" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 2 *</label>
                                        <input type="text" name="questions[0][option2]" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 3 *</label>
                                        <input type="text" name="questions[0][option3]" class="form-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label-sm">Option 4 *</label>
                                        <input type="text" name="questions[0][option4]" class="form-input">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Réponse correcte *</label>
                                    <select name="questions[0][correct]" class="form-input">
                                        <option value="">Sélectionner la bonne réponse</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="CancelBtn" type="button"  class="btn btn-secondary">Cancel</button>
                        <button id="CreateBtn" type="submit" class="btn btn-primary"> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
    <script src="../js/show_quiz_modal.js">

    </script>
</body>
</html>