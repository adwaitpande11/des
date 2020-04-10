<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$new_password = req('new_password');
	$cnf_password = req('cnf_password');
	
	if($new_password == $cnf_password)
	{
		$adw_user = array('password' => $cnf_password);
								
		$user_id = update($con, "adw_user", $adw_user, "user_id=".$user_id);
		
		if($user_id == true)
			location("logout.php");
		else
			location("?msg=2");
	}
	else
		location("?msg=3");
}
?>