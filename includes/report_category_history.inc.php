<?php
if(isset($_REQUEST['submit']) && !empty($_REQUEST['submit']))
{
	$month_1	= req('date_year_to')."-".req('date_month_to');
}
else
{
	$month_1	= date("Y-m");													// Current month
}

	$month_2	= date("Y-m", strtotime("-1 months", strtotime($month_1)));		// Current month - 1
	$month_3	= date("Y-m", strtotime("-2 months", strtotime($month_1)));		// Current month - 2
	$month_4	= date("Y-m", strtotime("-3 months", strtotime($month_1)));		// Current month - 3

$txns = getRows($con, "	SELECT
						TXN_TYPE.txn_type_id, TXN_TYPE.txn_flow, txn_typename,
						SUM(IFNULL(month_4, 0)) AS month_4,
						SUM(IFNULL(month_3, 0)) AS month_3,
						SUM(IFNULL(month_2, 0)) AS month_2,
						SUM(IFNULL(month_1, 0)) AS month_1
						FROM
						(
							SELECT
							user_id, txn_type_id, DATE_FORMAT(txn_date, '%Y-%m') AS RPT_MONTH,
							CASE WHEN (DATE_FORMAT(txn_date, '%Y-%m') = '".$month_4."') THEN SUM(txn_value) END AS 'month_4',
							CASE WHEN (DATE_FORMAT(txn_date, '%Y-%m') = '".$month_3."') THEN SUM(txn_value) END AS 'month_3',
							CASE WHEN (DATE_FORMAT(txn_date, '%Y-%m') = '".$month_2."') THEN SUM(txn_value) END AS 'month_2',
							CASE WHEN (DATE_FORMAT(txn_date, '%Y-%m') = '".$month_1."') THEN SUM(txn_value) END AS 'month_1'
							FROM
							adw_txn_main
							GROUP BY
							txn_type_id, DATE_FORMAT(txn_date, '%Y-%m')
							ORDER BY
							RPT_MONTH, txn_type_id
						) AS MAIN
						RIGHT JOIN adw_txn_type TXN_TYPE ON (MAIN.txn_type_id = TXN_TYPE.txn_type_id AND MAIN.user_id = TXN_TYPE.user_id)
						WHERE TXN_TYPE.user_id = ".$user_id."
						GROUP BY txn_typename");
?>