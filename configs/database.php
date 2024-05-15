<?php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'otps');

$sqlConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sqlQuery = "SET NAMES utf8";
mysqli_query($sqlConnection, $sqlQuery);

if (!($sqlConnection == false)) {
    return $sqlConnection;   
}

die("錯誤: 資料庫連線失敗" . mysqli_connect_error());
?>