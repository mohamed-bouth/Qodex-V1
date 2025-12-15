<?php
session_start();
require_once '../config/database.php';

if (isset($_POST['login'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query(
        "SELECT * FROM users WHERE email = '$email'"
    );

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();


        if (password_verify($password, $user['password_hash'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email']   = $user['email'];

            header("Location: ../enseignant/dashboard.php");
            exit;
        }
    }
    $_SESSION['signin_error'] = "Email or password incorrect";
    header("Location: ./login.php");
    exit();
}?>