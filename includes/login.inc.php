<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{		
	$username	= req('username');
	$password	= req('password');
	$continue	= req('continue');
	
	$login_result = getOne($con, "SELECT user_id FROM adw_user WHERE username='".$username."' AND password='".$password."'");
	
	if($login_result==0)
	{
		location("?status=error");
	}
	else
	{
		$cookie_user_id = setcookie("user_id", $login_result, time()+(30 * 24 * 60 * 60));
		$cookie_username = setcookie("username", $username, time()+(30 * 24 * 60 * 60));
		$_SESSION['user_id'] = $login_result;
				
		if(empty($continue))
			location("index.php");
		else {
		if(empty($_SERVER['HTTPS']))
			location("http://".urldecode($continue));
			else
			location("https://".urldecode($continue));
			}
	}
}
?>