<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/script/email.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/component/modal/infoupdate.php');

if(isset($_SESSION['SES']['username'])) {
    echo "  <script>
                var jsUsername = '" . $_SESSION['SES']['username'] . "';
                var message = '請透過導覽列查找並使用功能。';
            </script>";
} else {
    echo "  <script>
                var jsUsername = 'Guest';
                var message = '登入後即可使用所有功能。'
            </script>";
}
?>

<script src="assets/library/typewriter/typing.js"></script>

<div id="typewriter-container" class="text-center w-100 h1"></div>

<script>
    const typewriter = new Typewriter('#typewriter-container', {
        strings: [
            `你好, ${jsUsername} !`,
            `${message}`
        ],
        autoStart: true, 
        loop: true 
    });

    typewriter.start();
</script>

<button type="button" class="btn btn-light fixed-bottom-right" data-bs-toggle="modal" data-bs-target="#infoUpdateModal">
    編輯個人資訊
</button>
