<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>results</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/results.css">
</head>
<body>
    <?php include "../includes/header.php"; ?>
    <section class="hero-section">
            <div class="left-hero-section">
                <h1>Students results</h1>
                <h3>Check the results of your students</h3>
            </div>
            <div class="right-hero-section">
                <img src="../img/generated-image-results.png" alt="">
            </div>
    </section>
    <section class="student-results-section">
        <div class="student-results-container">
            <div class="student-results-head">
                <p class="head">Students</p>
                <p class="head">Quiz</p>
                <p>Score</p>
                <p>Date</p>
                <p>Staut</p>
            </div>
            <div class="student-results">
                <div class="student-results-name head">
                <p>MB</p>
                <p>Mohamed Bouth</p>
            </div>
            <div class="head">
                <p>the basic of JavaScipt</p>
            </div>
            <div>
                <p>18/20</p>
            </div>
            <div>
                <p>04 Dec 2025</p>
            </div>
            <div>
                <p class="staut">Successful</p> 
            </div>
        </div>
        
    </section>
    <?php include "../includes/footer.php"; ?>
</body>
</html>