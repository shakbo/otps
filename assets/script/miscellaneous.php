<?php
function alert($message) {
    echo "<script>alert('$message');
    	document.location.href='/otps';
    </script>";
    return false;
}

if(!$sqlConnection = mysqli_connect("localhost","root","","otps"))
{
	die("錯誤: 資料庫連線失敗" . mysqli_connect_error());
}

function mysqli_query_custom($sqlCommand)
{
	global $sqlConnection;

	$result = mysqli_query($sqlConnection, $sqlCommand);
	if(!is_bool($result) && mysqli_num_rows($result) > 0)
	{
		$res = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$res[] = $row;
		}

		return $res;
	}

	return false;
}

function is_logged_in()
{
	session_start();

	if(!empty($_SESSION['SES']) && is_array($_SESSION['SES'])){
		if(!empty($_SESSION['SES']['id']))
			return true;
	}

	$cookie = $_COOKIE['SES'] ?? null;
	if($cookie && strstr($cookie, ":")){
		$parts = explode(":", $cookie);
		$token_key = $parts[0];
		$token_value = $parts[1];

		$sqlCommand = "SELECT * FROM users WHERE token_key = '$token_key' limit 1";
		$row = mysqli_query_custom($sqlCommand);
		if($row)
		{
			$row = $row[0];
			if($token_value == $row['token_value'])
			{
				$_SESSION['SES'] = $row;
				return true;
			}
		}
	}

	return false;
}