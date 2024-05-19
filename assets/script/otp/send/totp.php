<?php
session_start();

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/otp/generate/totp.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/email.php');

$id = $_SESSION['SES']['id'];

$sqlCommand = "SELECT `totp` FROM `keypairs` WHERE `id` = (SELECT `keypairs` FROM `users` WHERE `id` = $id)";
$result = mysqli_query($sqlConnection, $sqlCommand);
$row = mysqli_fetch_assoc($result);
$secretKey = $row['totp'];

$totpValue = totp($secretKey, time());

$sqlCommand = "SELECT `email` FROM `users` WHERE `id` = $id";
$result = mysqli_query($sqlConnection, $sqlCommand);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];

sendMail($email, "TOTP驗證碼", $totpValue);

// $twilioClient = require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/twilio.php');
// $twilioClient->messages->create(
//     '', [
//         'from' => '+17012034272',
//         'body' => $totpValue
//     ]
// );

$sqlCommand = "UPDATE `otpstorage` SET `totp` = $totpValue, `totp_expiredtime` = NOW() + INTERVAL 30 SECOND, `totp_available` = 1 WHERE `id` IN (SELECT `otpstorage` FROM `users` WHERE `id` = $id)";
mysqli_query($sqlConnection, $sqlCommand);

mysqli_close($sqlConnection);


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "Debug Objects: " . $output . "";
}
?>