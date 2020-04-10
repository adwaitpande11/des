<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$date_from 	= req('date_year_from')."-".req('date_month_from')."-".req('date_day_from');
	$date_to	= req('date_year_to')."-".req('date_month_to')."-".req('date_day_to');
}
else
{
	$date_from	= date("Y-m-d");
	$date_to	= date("Y-m-d");
}
$txns = getRows($con, "	SELECT txn_main_id, txn_attachment, txn_typename, txn_description, txn_value, txn_date, txn_flow
						FROM adw_txn_main A
						INNER JOIN adw_txn_type B ON A.txn_type_id = B.txn_type_id AND A.user_id = B.user_id
						WHERE txn_date BETWEEN '".$date_from."' AND '".$date_to."' AND A.user_id = ".$user_id."
						ORDER BY txn_date");
?>