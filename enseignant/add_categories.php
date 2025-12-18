<?php
    session_start();
    require_once "../config/database.php";

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['addCategory'])){

        $category_name = $_POST['name'];
        $_SESSION['category_name'] = $_POST['name'];

        $category_description = $_POST['description'];
        $_SESSION['category_description'] = $_POST['description'];

        if(empty($category_name)){
            $_SESSION['empty_name'] = "the name is empty !";
            $_SESSION['open_modal'] = true;
            header('location: ./manage_categories.php');
            exit();
        }

        if(empty($category_description)){
            $_SESSION['empty_description'] = "the description is empty !";
            $_SESSION['open_modal'] = true;
            header('location: ./manage_categories.php');
            exit();
        }
        $result = $conn->query("SELECT * FROM category WHERE category_name = '$category_name' AND created_by = '$user_id';");

        if($result->num_rows === 1){
            $_SESSION['empty_name'] = "The name already exists !";
            $_SESSION['open_modal'] = true;
            header('location: ./manage_categories.php');
            exit();
        }

        $sql = "INSERT INTO category (category_name , category_description , created_by)
        VALUE ('$category_name','$category_description','$user_id')";
        $conn->query($sql);
        header('location: ./manage_categories.php');
        $_SESSION['success_edit'] = true;
        exit();
    }
    
?>

