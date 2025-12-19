<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit();
    }
    require_once "../config/database.php";
    $user_id = $_SESSION['user_id'];
    if(isset($_POST['addCategory'])){
        $category_id = $_POST['category_id'];
        $_SESSION['category_id'] = $_POST['category_id'];

        $category_name = $_POST['name'];
        $_SESSION['name'] = $_POST['name'];

        $category_description = $_POST['description'];
        $_SESSION['description'] = $_POST['description'];

        if(empty($category_name)){
            $_SESSION['empty_name'] = "the name is empty !";
            $_SESSION['open_edit_modal'] = true;
            header('location: ./manage_categories.php');
            exit();
        }

        if(empty($category_description)){
            $_SESSION['empty_description'] = "the description is empty !";
            $_SESSION['open_edit_modal'] = true;
            header('location: ./manage_categories.php');
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM category WHERE created_by  = ? AND category_name = ? AND id != ?");

        $stmt->bind_param("isi", $user_id , $category_name , $category_id);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows === 1){
            $_SESSION['empty_name'] = "the name aready existe !";
            $_SESSION['open_edit_modal'] = true;
            header('location: ./manage_categories.php');
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM category WHERE created_by  = ? AND category_name = ?");

        $stmt = $conn->prepare("UPDATE category SET category_name = ?, category_description = ? WHERE created_by = ? AND id = ?");

        $stmt->bind_param("ssii" , $category_name , $category_description , $user_id , $category_id);
        
        $stmt->execute();

        $_SESSION['success_edit'] = true;

        header('location: ./manage_categories.php');
        exit();

    }
?>