<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/general.php');
$sqlConnection = require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/miscellaneous.php');

$email = $_POST['email'];
$password = $_POST['password'];
$remember = $_POST['remember'] ?? null;

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

$sqlCommand = "SELECT * FROM users WHERE email ='$email' limit 1";
$result = mysqli_query_custom($sqlCommand);

if(!$result) {
    alert("帳號不存在！");
    die();
}

$result = $result[0];

if(!password_verify($password, $result['password'])) {
    alert("密碼錯誤！");
    die();
}

$_SESSION['SES'] = $result;

if($remember) {
    $expires = time() + (60*60*24*30);
    $salt = "TzuyuTop1";

    $token_key = hash('sha256', (time().$salt));
    $token_value = hash('sha256', ('Logged_In'.$salt));

    setcookie('SES', $token_key.':'.$token_value, $expires);

    $id = $result['id'];
    $sqlCommand = "UPDATE users set token_key = '$token_key', token_value='$token_value' where id = '$id' limit 1";
    mysqli_query_custom($sqlCommand);
}

$_SESSION["loggedin"] = true;

header("Location: " . ROOT . 'index.php?page=personalHomepage');
mysqli_close($sqlConnection);
exit;
?>