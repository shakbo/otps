<?php
session_start();

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

if(mysqli_num_rows($result) > 0) {
    alert("此電子郵件已有人使用！");
    die();
}

// TODO: Verify email is working before save to database.

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sqlCommand = "INSERT INTO keypairs(id, hotp, counter, totp) VALUES(NULL, NULL, NULL, NULL)";
mysqli_query($sqlConnection, $sqlCommand);

$last_keypairs_id = mysqli_insert_id($sqlConnection);

$sqlCommand = "INSERT INTO users(id, username, password, email, phoneNumber, token_value, token_key, keypairs, accesslevel) VALUES(NULL, '$username', '$hashedPassword', '$email', NULL, NULL, NULL, $last_keypairs_id, '2')";
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