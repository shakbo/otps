<?php
session_start();

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

$otpPassword = $_POST['otp-password'];

include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');

$id = $_SESSION['SES']['id'];

$sqlCommand = "SELECT `randomnumberotp`, `randomnumberotp_expiredtime`, `randomnumberotp_available` FROM `otpstorage` WHERE `id` = (SELECT `otpstorage` FROM `users` WHERE `id` = $id)";
$result = mysqli_query($sqlConnection, $sqlCommand);

$row = mysqli_fetch_assoc($result);

$randomnumberotp = $row['randomnumberotp'];
$randomnumberotp_expiredtime = $row['randomnumberotp_expiredtime'];

if (time() > strtotime($randomnumberotp_expiredtime)) {
    alert("該OTP已超時，請重新請求。");
    die();
}

if ((int)$row['randomnumberotp_available'] == 0) {
    alert("該OTP已被使用，請重新請求。");
    die();
}

if ($otpPassword != $randomnumberotp) {
    alert("OTP錯誤，請再試一次。");
    die();
}

$sqlCommand = "UPDATE `otpstorage` SET `randomnumberotp_available` = 0 WHERE `id` IN (SELECT `otpstorage` FROM `users` WHERE `id` = $id)";
mysqli_query($sqlConnection, $sqlCommand);

alert("驗證成功！");

function alert($message) {
    echo "<script>alert('$message');
        document.location.href = '/otps/manager.php?page=sms';
    </script>";
    return false;
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "'Debug Objects: " . $output . "' );</script>";
}
?>