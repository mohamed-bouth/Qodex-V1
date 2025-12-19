<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
require_once "../config/database.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT c.category_name , q.id , q.title , q.description , qs.question , qs.option_1 , qs.option_2 , qs.option_3 , qs.option_4 , qs.correct_option FROM quiz q JOIN question qs ON qs.quiz_id = q.id JOIN category c ON c.id = q.category_id WHERE q.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
echo json_encode($result->fetch_all(MYSQLI_ASSOC));
