<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "otps";

$sqlConnection = mysqli_connect($host,$username,$password,$database);
mysqli_query($sqlConnection, "SET NAMES utf8");
?>