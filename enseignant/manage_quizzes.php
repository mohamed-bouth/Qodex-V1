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
                    <a href="" class="right-btn">
                        <img src="../img/list-logo-btn.png" alt="">
                        <p>Create a Quiz</p>
                    </a>
                </div>
            </div>
            <div class="right-hero-section">
                <img src="../img/generated-image-quiz.png" alt="">
            </div>
    </section>
    <section class="quiz-container-section">
            <div class="quiz-container">
                <div class="quiz-container-up">
                    <div class="quiz-container-up-title">
                        <div>
                            <p class="type">HTML/CSS</p>
                        </div>
                        <p class="title">the basic of HTML5</p>
                        <p class="des">Test your knowledge of HTML5 elements</p>
                    </div>
                    <div class="quiz-container-up-btn">
                        <img src="../img/edit-icon.png" alt="">
                        <img src="../img/delete-icon.png" alt="">
                    </div>
                </div>
                <div class="quiz-container-down">
                    <div class="quiz-container-down-left">
                        <img src="../img/num-quiz-icon.png" alt="">
                        <p>12 Quiz</p>
                    </div>
                    <div class="quiz-container-down-right">
                        <img src="../img/num-student-icon.png" alt="">
                        <p>45 Students</p>
                    </div>
                </div>
                <button class="see-btn">
                    <img src="../img/see-results-icon.png" alt="">
                    <p>See the results</p>
                </button>
            </div>
    </section>
    <?php include "../includes/footer.php"; ?>
</body>
</html>