<?php
function alert($message) {
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    return false;
}

if(!$con = mysqli_connect("localhost","root","","otps"))
{
	die("錯誤: 資料庫連線失敗" . mysqli_connect_error());
}

function query($query)
{
	global $con;

	$result = mysqli_query($con, $query);
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
	if(!empty($_SESSION['SES']) && is_array($_SESSION['SES'])){

		if(!empty($_SESSION['SES']['id']))
			return true;
	}

	$cookie = $_COOKIE['SES'] ?? null;
	if($cookie && strstr($cookie, ":")){
		$parts = explode(":", $cookie);
		$token_key = $parts[0];
		$token_value = $parts[1];

		$query = "SELECT * FROM users WHERE token_key = '$token_key' limit 1";
		$row = query($query);
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