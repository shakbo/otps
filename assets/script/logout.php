<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/general.php');

session_start();

if(!empty($_SESSION['SES']) || !empty($_SESSION['loggedin']))
{
	unset($_SESSION['SES']);
	setcookie('SES','',time()-(9000));
	$_SESSION = array(); 
	session_destroy(); 
}

header("Location: " . ROOT . 'index.php');