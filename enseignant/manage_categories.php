<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My quiz</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/categories.css">
</head>
<body>
    <?php include "../includes/header.php"; ?>
    <section class="hero-section">
            <div class="left-hero-section">
                <h1>Category Management</h1>
                <h3>Organize your quizzes by category</h3>
                <div class="btn-container">
                    <button id="openBtn" class="left-btn">
                        <img src="../img/files-logo-btn.png" alt="">
                        <p>New Categories</p>
                    </button>
                </div>
            </div>
            <div class="right-hero-section">
                <img src="../img/generated-image-categories.png" alt="">
            </div>
    </section>
        <section class="categories-container-section">
        <div class="categories-container">
            <div class="categories-container-up">
                <div class="categories-container-up-title">
                    <p class="title">HTML/CSS</p>
                    <p class="des">Bases du développement web</p>
                </div>
                <div class="categories-container-up-btn">
                    <img src="../img/edit-icon.png" alt="">
                    <img src="../img/delete-icon.png" alt="">
                </div>
            </div>
            <div class="categories-container-down">
                <div class="categories-container-down-left">
                    <img src="../img/num-quiz-icon.png" alt="">
                    <p>12 Quiz</p>
                </div>
                <div class="categories-container-down-right">
                    <img src="../img/num-student-icon.png" alt="">
                    <p>45 Students</p>
                </div>
            </div>
        </div>
    </section>
    <?php include "../enseignant/add_categories.php"; ?>
    <?php include "../includes/footer.php"; ?>
    <script src="../js/show_categories_modal.js"></script>
</body>
</html>