<?php
include("../../includes/connection.inc.php");
include("../../includes/functions.inc.php");
$user_id = 1;
$expense_month = getOne($con, "SELECT SUM(txn_value) AS txn_value FROM adw_txn_main A INNER JOIN adw_txn_type B ON A.txn_type_id = B.txn_type_id AND A.user_id = B.user_id WHERE A.user_id = ".$user_id." AND txn_flow='expense' AND (txn_date BETWEEN '".date('Y-m')."-01' AND '".date('Y-m-d')."')");
$earning_month = getOne($con, "SELECT SUM(txn_value) AS txn_value FROM adw_txn_main A INNER JOIN adw_txn_type B ON A.txn_type_id = B.txn_type_id AND A.user_id = B.user_id WHERE A.user_id = ".$user_id." AND txn_flow='earning' AND (txn_date BETWEEN '".date('Y-m')."-01' AND '".date('Y-m-d')."')");
$savings_month = $earning_month - $expense_month;
$json_output = array(
					'expense_month'	=> currency_format($expense_month),
					'earning_month'	=> currency_format($earning_month),
					'savings_month'	=> currency_format($savings_month),
					);
echo json_encode($json_output);
?>