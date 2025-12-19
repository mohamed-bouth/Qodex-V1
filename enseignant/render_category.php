<?php
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit();
    }
    include "../config/database.php";
    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT 
                            cat.id,
                            cat.category_name,
                            cat.category_description,

                            COUNT(DISTINCT q.id) AS quiz_count

                            FROM category cat

                            LEFT JOIN quiz q 
                                ON q.category_id = cat.id

                            WHERE cat.created_by = '$user_id'

                            GROUP BY cat.id;");
    $results = $result->fetch_all(MYSQLI_ASSOC);