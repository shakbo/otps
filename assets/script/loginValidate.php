<?php
$sqlConnection = require_once('configs/database.php');
require 'assets/script/miscellaneous.php';

$email = $_POST['email'];
$password = $_POST['password'];

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

$sqlCommand = "SELECT * FROM users WHERE email ='".$email."'";
$result = mysqli_query($sqlConnection, $sqlCommand);

if(!($result && password_verify($password, mysqli_fetch_assoc($result)['password']))) {
    alert("帳號或密碼錯誤！");
    die();
}

session_start();
$_SESSION['Logged_In'] = true;
$_SESSION['Id'] = mysqli_fetch_assoc($result)['id'];
$_SESSION['email'] = mysqli_fetch_assoc($result)['email'];
header('location:index.php?page=demo');

mysqli_close($sqlConnection);
?>