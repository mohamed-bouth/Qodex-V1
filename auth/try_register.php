<?php
session_start();
require_once '../config/database.php';

if(isset($_POST['create'])){
    $user_name = $_POST['name'];
    $_SESSION['username'] = $_POST['name'];

    $user_email = $_POST['email'];
    $_SESSION['email'] = $_POST['email'];

    $user_role = $_POST['option'];
    $_SESSION['option'] = $_POST['option'];

    $user_check_password = $_POST['password'];
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $_SESSION['password'] = $_POST['password'];

    $user_confrime_password = $_POST['confrimePassword'];
    $_SESSION['confrimePassword'] = $_POST['confrimePassword'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? ");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $_SESSION['gmail_error'] = true;
        header("location: ./register.php");
        exit();
    };
    if($user_check_password !== $user_confrime_password){
        $_SESSION['password_error'] =  true;
        header("location: ./register.php");
        exit();
    };
    if($result->num_rows === 0){

        $stmt = $conn->prepare("INSERT INTO users (user_name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_name, $user_email, $user_password, $user_role);
        $stmt->execute();
        $stmt->close();

        header("location: ./login.php");
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['option']);
        unset($_SESSION['password']);
        unset($_SESSION['confrimePassword']);
        exit();
    };
}
?>