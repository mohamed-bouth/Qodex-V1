<?php
session_start();
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['email'];
$user_role = $_SESSION["user_role"];
?>
<head>
    <link rel="stylesheet" href="../css/global.css">
</head>
<header class="header">
        <div class="logo-container">
            <img src="../img/qodex-logo.png" alt="">
        </div>
        <div class="links-container">
            <div class="links-cont">
                <img src="../img/dashboard-logo.png" alt="">
                <a href="../enseignant/dashboard.php">Dashbord</a>
            </div>
            <div class="links-cont">
                <img src="../img/categories-logo.png" alt="">
                <a href="../enseignant/manage_categories.php">Categories</a>
            </div>
            <div class="links-cont">
                <img src="../img/myquiz-logo.png" alt="">
                <a href="../enseignant/manage_quizzes.php">My Quiz</a>
            </div>
            <div class="links-cont">
                <img src="../img/results-logo.png" alt="">
                <a href="../enseignant/view_results.php">Results</a>
            </div>
        </div>
        <div class="switch-container">
            <div class="switch-container-logo">
                <?php
                echo('<p>' . strtoupper($user_name[0]) . '<p>');
                ?>
            </div>
            <div>
                <?php
                echo('<p>' . $user_name .'</p>');
                echo('<p>' . $user_role .'</p>');
                ?>
            </div>
            <div class="switch-button-list">
                <img src="../img/switch-button-logo.png" alt="">
            </div>
        </div>
    </header>