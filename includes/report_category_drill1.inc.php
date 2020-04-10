<?php
if($_REQUEST['action']=='report_category_drill1')
{
	$date_from 	= req('date_from');
	$date_to	= req('date_to');
	$txn_type_id= req('txn_type_id');
	
	$txns = getRows($con, "SELECT txn_main_id, txn_type_id, txn_description, txn_value, txn_date FROM adw_txn_main WHERE txn_type_id='".$txn_type_id."' AND user_id = ".$user_id." AND DATE_FORMAT(txn_date, '%Y-%m') BETWEEN '".$date_from."' AND '".$date_to."' ORDER BY txn_main_id");
	$txn_typename = getOne($con, "SELECT txn_typename FROM adw_txn_type WHERE txn_type_id='".$txn_type_id."' AND user_id = ".$user_id);
}
?>