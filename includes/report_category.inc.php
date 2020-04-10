<?php
if(isset($_REQUEST['submit']) && !empty($_REQUEST['submit']))
{
	$date_from 	= req('date_year_from')."-".req('date_month_from');
	$date_to	= req('date_year_to')."-".req('date_month_to');
}
elseif(isset($_GET['reporting_month']) && !empty($_GET['reporting_month']))
{
	$date_from 	= req('reporting_month');
	$date_to	= req('reporting_month');
}
else
{
	$date_from 	= date("Y-m");
	$date_to	= date("Y-m");
}
$txns = getRows($con, "	SELECT A.txn_type_id, B.txn_typename, SUM(A.txn_value) AS txn_value, A.txn_date, B.txn_flow
						FROM adw_txn_main A
						INNER JOIN adw_txn_type B ON A.txn_type_id = B.txn_type_id AND A.user_id = B.user_id
						WHERE DATE_FORMAT(txn_date, '%Y-%m') BETWEEN '".$date_from."' AND '".$date_to."' AND A.user_id = ".$user_id."
						GROUP BY B.txn_type_id
						ORDER BY txn_value DESC");
?>