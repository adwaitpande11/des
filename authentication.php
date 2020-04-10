<?php
$user_id = $_COOKIE['user_id'];
$user_id_sess = $_SESSION['user_id'];

if((!isset($user_id) || empty($user_id) || $user_id==0 || $user_id=='' || $user_id=='0') && (!isset($user_id_sess) || empty($user_id_sess) || $user_id_sess==0 || $user_id_sess=='' || $user_id_sess=='0'))
{
	$current_url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	location("login.php?continue=".urlencode($current_url));
}
else
{
	setcookie("user_id", $user_id, time()+(30 * 24 * 60 * 60));
	$_SESSION['user_id'] = $user_id_sess;
}

?>