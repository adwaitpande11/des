<?php
if(isset($_REQUEST['submit']) && !empty($_REQUEST['submit']))
{
	$month_from = req('date_month_from');
	$year_from = req('date_year_from');
	$month_to = req('date_month_to');
	$year_to = req('date_year_to');
}
else
{
	$month_minus_four = getRows($con, "SELECT MONTH(DATE_SUB(curdate(), INTERVAL 3 MONTH)) AS MONTH, YEAR(DATE_SUB(curdate(), INTERVAL 3 MONTH)) AS YEAR FROM DUAL");
	$month_from = $month_minus_four['MONTH'];
	$year_from = $month_minus_four['YEAR'];
	$month_to = date("m");
	$year_to = date("Y");
}
$txns = getRows($con, " SELECT EXPENSE.REPORTING_MONTH, EXPENSE.REPORTING_YEAR, MNTH_EARNING, MNTH_EXPENSE FROM 
						(
							SELECT SUM(TXN_VALUE) AS MNTH_EXPENSE, MONTH(TXN_DATE) AS REPORTING_MONTH, YEAR(TXN_DATE) AS REPORTING_YEAR, TXN_DATE
							FROM `adw_txn_main` MAIN
							INNER JOIN `adw_txn_type` TXN_TYPE USING(TXN_TYPE_ID)
							WHERE TXN_TYPE.TXN_FLOW = 'expense' AND TXN_TYPE.USER_ID = ".$user_id."
							GROUP BY MONTH(TXN_DATE), YEAR(TXN_DATE)
						) EXPENSE
						
						LEFT JOIN
						(
							SELECT SUM(MAIN2.TXN_VALUE) AS MNTH_EARNING, MONTH(MAIN2.TXN_DATE) AS REPORTING_MONTH, YEAR(MAIN2.TXN_DATE) AS REPORTING_YEAR
							FROM `adw_txn_main` MAIN2
							INNER JOIN `adw_txn_type` TXN_TYPE2 USING(TXN_TYPE_ID)
							WHERE TXN_TYPE2.TXN_FLOW = 'earning' AND TXN_TYPE2.USER_ID = ".$user_id."
							GROUP BY MONTH(TXN_DATE), YEAR(TXN_DATE)
						) EARNING
						ON EXPENSE.REPORTING_MONTH = EARNING.REPORTING_MONTH AND EXPENSE.REPORTING_YEAR = EARNING.REPORTING_YEAR
						WHERE	(EXPENSE.TXN_DATE BETWEEN '".$year_from."-".$month_from."-01' AND '".$year_to."-".$month_to."-31')
								/*(EXPENSE.REPORTING_MONTH >= '".$month_from."' AND EXPENSE.REPORTING_MONTH <= '".$month_to."')
								AND
								(EXPENSE.REPORTING_YEAR >= '".$year_from."' AND EXPENSE.REPORTING_YEAR <= '".$year_to."')*/
						ORDER BY EXPENSE.REPORTING_YEAR, EXPENSE.REPORTING_MONTH");

?>