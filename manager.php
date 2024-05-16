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
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/modal.css">
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/miscellaneous.php');
    
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'home';

    $page_data = [
        'home' => [
            'title' => 'OTP 展示 | 個人首頁',
            'stylesheet' => 'assets/stylesheet/home.css',
            'content' => 'assets/content/home.php',
        ]
    ];

    if (array_key_exists($current_page, $page_data)) {
        $page = $page_data[$current_page];
        echo '<title>' . $page['title'] . '</title>';
        echo '<link rel="stylesheet" type="text/css" href="' . $page['stylesheet'] . '">';
    }
    ?>
</head>
<body>
    <?php
    $showLogin = !is_logged_in();
    include_once("assets/component/navbar.php");
    ?>
    <div class="background"></div>
    <main>
    <?php
    if (array_key_exists($current_page, $page_data)) {
        include_once($page['content']);
    } else {
        echo "<h1>Page not found</h1>";
    }
    ?>
    </main>
</body>
</html>