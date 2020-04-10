<?php
if(isset($_REQUEST['submit']) && !empty($_REQUEST['submit']))
{
	$date_from 	= req('date_year_from')."-".req('date_month_from')."-".req('date_day_from');
	$date_to	= req('date_year_to')."-".req('date_month_to')."-".req('date_day_to');
}
else
{
	$date_from 	= date("Y-m-")."01";
	$date_to	= date("Y-m-d");
}
$txns = getRows($con, "	SELECT txn_date, SUM(txn_value) AS txn_value FROM adw_txn_main A
						INNER JOIN adw_txn_type B ON A.txn_type_id = B.txn_type_id AND A.user_id = B.user_id
						WHERE txn_flow='expense' AND (txn_date BETWEEN '".$date_from."' AND '".$date_to."') AND A.user_id='".$user_id."'
						GROUP BY txn_date
						ORDER BY txn_date");
?>