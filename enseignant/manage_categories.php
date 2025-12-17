<?php
    session_start();
    $empty_name = $_SESSION['empty_name'] ?? 'Category name';
    $empty_description = $_SESSION['empty_description'] ?? 'Description';
    $openModal = $_SESSION['open_modal'] ?? false;
    include "../enseignant/render_category.php";
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
    <?php foreach ($results as $category) { ?> 
            <div class="categories-container">
                <div class="categories-container-up">
                    <div class="categories-container-up-title">
                        <p class="title"><?= $category['category_name'] ?></p>
                        <p class="des"><?= $category['category_description'] ?></p>
                    </div>
                    <div class="categories-container-up-btn">
                        <img src="../img/edit-icon.png" alt="">
                        <img src="../img/delete-icon.png" alt="">
                    </div>
                </div>
                <div class="categories-container-down">
                    <div class="categories-container-down-left">
                        <img src="../img/num-quiz-icon.png" alt="">
                        <p><?= $category['quiz_count'] ?> Quiz</p>
                    </div>
                    <div class="categories-container-down-right">
                        <img src="../img/num-student-icon.png" alt="">
                        <p><?= $category['student_count'] ?> Students</p>
                    </div>
                </div>
            </div>
    <?php } ?>
    </section>
    <div id="categoriesModal" class="modal">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h3>New Category</h3>
                    <button id="closeBtn" class="close-btn">&times;</button>
                </div>
                <form action="./add_categories.php" method="POST">
                    <div class="form-group">
                        <label <?php if($empty_name === "the name is empty !" || $empty_name === "The name already exists !") echo "style='color : red;'"; ?> ><?= $empty_name; ?></label>
                        <input type="text" name="name" placeholder="Ex: HTML/CSS" value="<?= $_SESSION['category_name'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label <?php if($empty_description === "the description is empty !") echo "style='color : red;'"; ?> ><?= $empty_description ?></label>
                        <input type="text" name="description" placeholder="Describe this category..." value="<?= $_SESSION['category_description'] ?? ''; ?>"></input>
                    </div>

                    <div class="form-actions">
                        <button id="cancelBtn" type="button">Annuler</button>
                        <button id="submitBtn" name="addCategory" type="submit">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
    <?php
    unset($_SESSION['empty_name']);
    unset($_SESSION['empty_description']);
    unset($_SESSION['category_name']);
    unset($_SESSION['category_description']);
    ?>
    <script src="../js/show_categories_modal.js"></script>
    <?php if($openModal){ ?>
        <script>
            document.getElementById('categoriesModal').className = 'modal active';
            console.log("work")
        </script>
    <?php } 
    unset($_SESSION['open_modal'])?>
</body>
</html>