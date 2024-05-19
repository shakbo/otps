<?php
session_start();

$sqlConnection = require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/miscellaneous.php');

$id = $_SESSION['SES']['id'];

$username = $_POST['username'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

$sqlCommand = "SELECT password FROM users WHERE id = $id";
$result = mysqli_query($sqlConnection, $sqlCommand);
$row = mysqli_fetch_assoc($result);

if(!password_verify($password, $row['password'])) {
    alert("密碼錯誤！");
    die();
}

if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    alert("電子郵件格式有誤！");
    die();
}

$sqlCommand = "UPDATE `users` SET username = '$username', phoneNumber = '$phoneNumber' WHERE `users`.`id` = $id";
$result = mysqli_query($sqlConnection, $sqlCommand);

if($result) {
    alert("更新成功！");
    die();
} else {
    alert("更新失敗！");
    die();
}

mysqli_close($sqlConnection);
?>