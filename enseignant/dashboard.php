<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
    }
    include "../enseignant/dashboard_satatistique.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <section class="hero-section">
            <div class="left-hero-section">
                <h1>Teacher Dashboard</h1>
                <h3>Manage your quizzes and track your students performance</h3>
                <div class="btn-container">
                    <a href="../enseignant/manage_categories.php" class="left-btn">
                        <img src="../img/files-logo-btn.png" alt="">
                        <p>New Categories</p>
                    </a>
                    <a href="../enseignant/manage_quizzes.php" class="right-btn">
                        <img src="../img/list-logo-btn.png" alt="">
                        <p>Create a Quiz</p>
                    </a>
                </div>
            </div>
            <div class="right-hero-section">
                <img src="../img/generated-image-dashboard.png" alt="">
            </div>
        </section>
        <section class="statistique-section">
            <div class="statistique-container">
                <div class="statistique-container-paragraf-cont">
                    <p class="statistique-title">Total Quiz</p>
                    <p class='statistique-num'><?= $num_quiz ?></p>
                </div>
                <div>
                    <img src="../img/dashboard-statistique-quiz.png" alt="">
                </div>
            </div>
            <div class="statistique-container">
                <div class="statistique-container-paragraf-cont">
                    <p class="statistique-title">Categories</p>
                    <p class="statistique-num"><?= $num_category ?></p>
                </div>
                <div>
                    <img src="../img/dashboard-statistique-categories.png" alt="">
                </div>
            </div>
            <div class="statistique-container">
                <div class="statistique-container-paragraf-cont">
                    <p class="statistique-title">Active Student</p>
                    <p class="statistique-num"><?= $num_students ?></p>
                </div>
                <div>
                    <img src="../img/dashboard-statistique-student.png" alt="">
                </div>
            </div>
            <div class="statistique-container">
                <div class="statistique-container-paragraf-cont">
                    <p class="statistique-title">Average Note</p>
                    <p class="statistique-num"><?= $avg_score ?></p>
                </div>
                <div>
                    <img src="../img/dashboard-statistique-note.png" alt="">
                </div>
            </div>
        </section>
    </main>
    <?php include "../includes/footer.php"; ?>
</body>
</html>