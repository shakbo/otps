<?php
session_start();

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

$otpPassword = $_POST['otp-password'];

include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');

$id = $_SESSION['SES']['id'];

$sqlCommand = "SELECT `hotp`, `hotp_expiredtime`, `hotp_available` FROM `otpstorage` WHERE `id` = (SELECT `otpstorage` FROM `users` WHERE `id` = $id)";
$result = mysqli_query($sqlConnection, $sqlCommand);

$row = mysqli_fetch_assoc($result);

$hotp = $row['hotp'];
$hotp_expiredtime = $row['hotp_expiredtime'];

if (time() > strtotime($hotp_expiredtime)) {
    alert("該OTP已超時，請重新請求。");
    die();
}

if ((int)$row['hotp_available'] == 0) {
    alert("該OTP已被使用，請重新請求。");
    die();
}

if ($otpPassword != $hotp) {
    alert("OTP錯誤，請再試一次。");
    die();
}

$sqlCommand = "UPDATE `keypairs` SET `counter` = $counter + 1 WHERE `id` IN (SELECT `keypairs` FROM `users` WHERE `id` = $id)";
mysqli_query($sqlConnection, $sqlCommand);

$sqlCommand = "UPDATE `otpstorage` SET `hotp_available` = 0 WHERE `id` IN (SELECT `otpstorage` FROM `users` WHERE `id` = $id)";
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