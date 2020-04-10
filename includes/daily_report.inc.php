<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$date = req('date_year')."-".req('date_month')."-".req('date_day');
}
elseif($_REQUEST['action']=='drill2')
{
	$date = $_REQUEST['date'];
}
else
{
	$date	= date("Y-m-d");
}
$txns = getRows($con, "	SELECT TXN_MAIN.txn_main_id, TXN_MAIN.txn_attachment, txn_typename, txn_description, txn_value, txn_date, txn_flow
						FROM adw_txn_main TXN_MAIN
						INNER JOIN adw_txn_type TXN_TYPE ON TXN_MAIN.txn_type_id = TXN_TYPE.txn_type_id AND TXN_MAIN.user_id = TXN_TYPE.user_id
						WHERE txn_date = '".$date."' AND TXN_MAIN.user_id = ".$user_id." ORDER BY txn_main_id");
?>