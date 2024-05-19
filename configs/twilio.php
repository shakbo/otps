<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/library/twilio/src/Twilio/autoload.php');

$twilioId = "";
$twilioToken = "";
return new Twilio\Rest\Client($twilioId, $twilioToken);
?>