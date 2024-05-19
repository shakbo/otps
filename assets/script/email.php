<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/library/phpmailer/src/Exception.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/library/phpmailer/src/PHPMailer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/library/phpmailer/src/SMTP.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/email.php');

function sendMail($email, $subject, $message) {
    $mail = new PHPMailer(true);

    $mail -> isSMTP();

    $mail -> SMTPAuth = true;

    $mail -> Host = MAIL_HOST;
    $mail -> Username = MAIL_USERNAME;
    $mail -> Password = MAIL_PASSWORD;

    $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail -> Port = 587;

    $mail->CharSet = "UTF-8";
    $mail->Subject = "=?UTF-8?B?".base64_encode($subject)."?=";

    $mail -> setFrom(MAIL_SEND_FROM, MAIL_SEND_FROM_NAME);

    $mail -> addAddress($email);
    $mail -> addReplyTo(MAIL_REPLY_TO, MAIL_REPLY_TO_NAME);
    $mail -> isHTML(true);

    $mail -> Subject = $subject;
    $mail -> Body = $message;
    $mail -> AltBody = $message;

    if(!$mail->send()) {
        return "電子郵件送出失敗，請稍後再試。";
    }
    return "電子郵件已送出";
}
?>