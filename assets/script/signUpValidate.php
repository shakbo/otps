<?php
$sqlConnection = require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/miscellaneous.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

$sqlCommand = "SELECT * FROM users WHERE email ='".$email."'";
$result = mysqli_query($sqlConnection, $sqlCommand);

if(!($result)) {
    alert("此電子郵件已有人使用！");
    die();
}

// TODO: Verify email is working before save to database.

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sqlCommand = "INSERT INTO keypairs(key) VALUES(NULL); SET @last_keypairs_id = LAST_INSERT_ID();";

$sqlCommand = "INSERT INTO users(id, username, password, email, phoneNumber, token_value, token_key, keypairs, accesslevel) VALUES(NULL, '$username', '$hashedPassword', '$email', NULL, NULL, NULL, NULL, '1')";
$result = mysqli_query($sqlConnection, $sqlCommand);

if($result) {
    alert("註冊成功！");
    die();
} else {
    alert("註冊失敗！");
    die();
}

mysqli_close($sqlConnection);
?>