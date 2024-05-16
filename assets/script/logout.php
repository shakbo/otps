<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/general.php');

session_start();

if(!empty($_SESSION['SES']))
{
	unset($_SESSION['SES']);
	setcookie('SES','',time()-(9000));
}

header("Location: " . ROOT . 'index.php');