<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/library/bootstrap/bootstrap.css">
    <script src="assets/library/bootstrap/bootstrap.bundle.js"></script>
    <title>OTP 展示 | 首頁</title>
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/index.css">
    <link rel="stylesheet" type="text/css" href="assets/stylesheet/modal.css">
    <?php
    session_start();

    include_once("config.php");

    $current_page = isset($_GET['page']) ? $_GET['page'] : 'homepage';

    $page_data = [
        'homepage' => [
            'title' => 'OTP 展示 | 首頁',
            'stylesheet' => 'assets/stylesheet/index.css',
            'content' => 'assets/content/home.php',
        ],
        'test' => [
            'title' => 'OTP 展示 | 測試',
            'stylesheet' => 'assets/stylesheet/index.css',
            'content' => 'assets/content/test.php',
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
    $showLogin = !in_array($current_page, ['login']);
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