<?php
    require_once "../config/database.php";

    if(isset($_POST['deleteCategory'])){
        $category_id = $_POST['category_id'];
        $stmt = $conn->prepare("DELETE FROM category WHERE id = ? ");
        $stmt->execute([$category_id]);
        header('location: ./manage_categories.php');
        exit();
    } 
?>