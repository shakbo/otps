<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');

include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/otp/authenticator.php');

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

$otpPassword = $_POST['otp-password'];

$authenticator = new Authenticator();

$id = $_SESSION['SES']['id'];

$sqlCommand = "SELECT `totp` FROM `keypairs` WHERE `id` = (SELECT `keypairs` FROM `users` WHERE `id` = $id)";
$result = mysqli_query($sqlConnection, $sqlCommand);
$row = mysqli_fetch_assoc($result);

if ($authenticator -> verifyOtp($row['totp'], $otpPassword)) {
    alert("驗證成功！");
} else {
    alert("驗證失敗！");
}

function alert($message) {
    echo "<script>alert('$message');
        document.location.href = '/otps/manager.php?page=authenticator';
    </script>";
    return false;
}
?>