<?php
session_start();

if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    session_destroy();
    header("https://otps.kaoro.net/otps/index.php?page=home");
    exit;
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    session_destroy();
    session_unset();
    header("https://otps.kaoro.net/otps/index.php?page=home");
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/library/bootstrap/bootstrap.css">
    <script src="assets/library/bootstrap/bootstrap.bundle.js"></script>
    <script src="https://kit.fontawesome.com/905d6b8ff8.js" crossorigin="anonymous"></script>
    <script src="assets/library/jquerry/jquery-3.7.1.js"></script>
    <script src="assets/library/jbvalidator/jbvalidator.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/general.css">
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/modal.css">
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/miscellaneous.php');
    
    $current_page = isset($_GET['page']) ? $_GET['page'] : '404';

    $page_data = [
        'sms' => [
            'title' => 'OTP 展示 | 簡訊獲取',
            'stylesheet' => 'assets/stylesheet/sms.css',
            'content' => 'assets/content/function/sms.php',
        ],
        'authenticator' => [
            'title' => 'OTP 展示 | 驗證器獲取',
            'stylesheet' => 'assets/stylesheet/authenticator.css',
            'content' => 'assets/content/function/authenticator.php',
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
    <?php
    include_once("assets/component/footer.php");
    ?>
</body>
</html>