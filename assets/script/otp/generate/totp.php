<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/otp/generate/hotp.php');

function totp($key, $unixtime, $digits = 6, $hash = 'sha1') {
    return hotp($key, $unixtime, $digits, $hash);
}
?>