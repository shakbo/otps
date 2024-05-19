<?php
session_start();

if(!($_SERVER['REQUEST_METHOD'] == 'POST')) {
    alert("呼叫方法錯誤！");
    die();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/otp/generate/randomNumber.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/email.php');

$id = $_SESSION['SES']['id'];

$sqlCommand = "SELECT `email` FROM `users` WHERE `id` = $id";
$result = mysqli_query($sqlConnection, $sqlCommand);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];

$randomnumberotpValue = randomnumberotp();

sendMail($email, "隨機數OTP驗證碼", $randomnumberotpValue);

// $twilioClient = require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/twilio.php');
// $twilioClient->messages->create(
//     '+886938962200', [
//         'from' => '+17012034272',
//         'body' => $randomnumberotpValue
//     ]
// );

$sqlCommand = "UPDATE `otpstorage` SET `randomnumberotp` = $randomnumberotpValue, `randomnumberotp_expiredtime` = NOW() + INTERVAL 30 SECOND, `randomnumberotp_available` = 1 WHERE `id` IN (SELECT `otpstorage` FROM `users` WHERE `id` = $id)";
mysqli_query($sqlConnection, $sqlCommand);

mysqli_close($sqlConnection);

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "Debug Objects: " . $output . "";
}
?>