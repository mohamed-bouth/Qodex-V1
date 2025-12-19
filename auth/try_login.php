<?php
session_start();
require_once '../config/database.php';

if (isset($_POST['login'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();


        if (password_verify($password, $user['password_hash']) && $user['role'] === "teacher") {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email']   = $user['email'];
            $_SESSION["user_role"] = $user['role'];

            header("Location: ../enseignant/dashboard.php");
            exit;
        }
    }
    $_SESSION['signin_error'] = 1;
    header("Location: ./login.php");
    exit();
}?>