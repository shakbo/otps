<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/library/bootstrap/bootstrap.css">
    <script src="assets/library/bootstrap/bootstrap.bundle.js"></script>
    <script src="assets/library/jquerry/jquery-3.7.1.js"></script>
    <script src="assets/library/jbvalidator/jbvalidator.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/general.css">
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/index.css">
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/modal.css">
    <title>OTP 展示 | 首頁</title>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/miscellaneous.php');
    ?>
</head>
<body>
    <?php
    $showLogin = !is_logged_in();
    include_once("assets/component/navbar.php");
    ?>
    <div class="background"></div>
    <main>
        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/content/index.php'); ?>
    </main>
</body>
</html>