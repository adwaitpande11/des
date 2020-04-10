<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$persons_id		= req('persons_id');
	$description	= req('description');
	$amount			= req('amount');
	$credit_date	= req('date_year')."-".req('date_month')."-".req('date_day');
	
	$adw_credits = array(
							'persons_id'		=> $persons_id,
							'user_id'			=> $user_id,
							'description'		=> $description,
							'amount'			=> $amount,
							'credit_date'		=> $credit_date,
							);
							
	$credits_id = insert($con, "adw_credits", $adw_credits);
	
	if($credits_id > 0)
		location("?msg=1");
	else
		location("?msg=2");
}
$persons = getRows($con, "SELECT persons_id, person_name FROM adw_persons WHERE user_id = ".$user_id." ORDER BY person_name");
?>