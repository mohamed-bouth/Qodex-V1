<?php
    session_start();
    $empty_name = $_SESSION['empty_name'] ?? 'Category name';
    $empty_description = $_SESSION['empty_description'] ?? 'Description';
    $openModal = $_SESSION['open_modal'] ?? false;
    $openEditModal = $_SESSION['open_edit_modal'] ?? false;
    include "../enseignant/render_category.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
                            <button class="categroryBtns" id="editbtn" data-name="<?= $category['category_name'] ?>" data-description="<?= $category['category_description'] ?>" data-id="<?= $category['id'] ?>"><img src="../img/edit-icon.png" alt=""></button>
                        <form action="./delete_categories.php" method="POST">
                            <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                            <button class="categroryBtns" name="deleteCategory" type="submit"><img src="../img/delete-icon.png" alt=""></button>
                        </form>
                    </div>
                </div>
                <div class="categories-container-down">
                    <div class="categories-container-down-left">
                        <img src="../img/num-quiz-icon.png" alt="">
                        <p><?= $category['quiz_count'] ?> Quiz</p>
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
                <form id="categoryForm" action="./add_categories.php" method="POST">
                    <div class="form-group">
                        <label id="nameLabel" <?php if($empty_name === "the name is empty !" || $empty_name === "The name already exists !" || $empty_name === "the name aready existe !") echo "style='color : red;'"; ?> ><?= $empty_name; ?></label>
                        <input id="nameInput" type="text" name="name" placeholder="Ex: HTML/CSS" value="<?= $_SESSION['category_name'] ?? $_SESSION['name'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label id="descriptionLabel" <?php if($empty_description === "the description is empty !") echo "style='color : red;'"; ?> ><?= $empty_description ?></label>
                        <input id="descriptionInput" type="text" name="description" placeholder="Describe this category..." value="<?= $_SESSION['category_description'] ?? $_SESSION['description'] ?? ''; ?>"></input>
                    </div>

                    <div class="form-actions">
                        <button id="cancelBtn" type="button">Cancel</button>
                        <button id="submitBtn" name="addCategory" type="submit">Create</button>
                    </div>
                    <input id="catg-id" type="hidden" name="category_id" value="<?=$_SESSION['category_id'] ?? '' ?>">
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
    <?php if($openEditModal){ ?>
        <script>
            document.getElementById('categoriesModal').className = 'modal active';
            console.log("work")
            categoryForm.action = './edit_categories.php'
            submitBtn.textContent = "Edit"
        </script>
    
    <?php }
    unset($_SESSION['open_edit_modal']);
    unset($_SESSION['category_id']);
    unset($_SESSION['name']);
    unset($_SESSION['description']);
    if($_SESSION['success_edit']){ ?>
        <script>
            nameInput.value = ""
            descriptionInput.value = ""
        </script>
    <?php }
    unset($_SESSION['success_edit'])
    ?>
</body>
</html>