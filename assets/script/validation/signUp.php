<?php
session_start();

$sqlConnection = require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/miscellaneous.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/otp/generate/secretkey.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    alert("電子郵件格式有誤！");
    die();
}

$sqlCommand = "SELECT * FROM users WHERE email ='".$email."'";
$result = mysqli_query($sqlConnection, $sqlCommand);

if(mysqli_num_rows($result) > 0) {
    alert("此電子郵件已有人使用！");
    die();
}

$hotp_key = generateSecretKey();
$totp_key = generateSecretKey();
$sqlCommand = "INSERT INTO keypairs(id, hotp, counter, totp) VALUES(NULL, '$hotp_key', 0, '$totp_key')";
mysqli_query($sqlConnection, $sqlCommand);
$last_keypairs_id = mysqli_insert_id($sqlConnection);

$sqlCommand = "INSERT INTO otpstorage(id, hotp, hotp_expiredtime, totp, totp_expiredtime, randomnumberotp, randomnumberotp_expiredtime) VALUES(NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
mysqli_query($sqlConnection, $sqlCommand);
$last_otpstorage_id = mysqli_insert_id($sqlConnection);

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sqlCommand = "INSERT INTO users(id, username, password, email, phoneNumber, token_value, token_key, keypairs, otpstorage, accesslevel, activated) VALUES(NULL, '$username', '$hashedPassword', '$email', NULL, NULL, NULL, $last_keypairs_id, $last_otpstorage_id, '2', '2')";
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