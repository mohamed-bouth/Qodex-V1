<?php
require_once '../config/database.php';

$name  = "ayoub bouharb";
$email = "teacher@gmail.com";
$pass  = password_hash("123456", PASSWORD_DEFAULT);
$role  = "teacher";

$sql = "INSERT INTO users (user_name, email, password_hash, role)
        VALUES ('$name', '$email', '$pass', '$role')";

if ($conn->query($sql)) {
    echo "✅ User added successfully";
} else {
    echo "❌ Error: " . $DB->error;
}
