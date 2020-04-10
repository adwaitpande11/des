<?php
include("includes/connection.inc.php");
include("authentication.php");
include("includes/SQLToExcel.inc.php");

$query[] = '
			SELECT
			A.txn_main_id AS "Transaction ID",
			CONCAT(UPPER(LEFT(B.txn_flow, 1)), SUBSTRING(B.txn_flow, 2)) AS "Type",
			B.txn_typename AS "Category",
			A.txn_description AS "Description",
			CASE B.txn_flow
			WHEN \'earning\' THEN A.txn_value
			WHEN \'expense\' THEN (A.txn_value*-1)
			END AS "Amount",
			A.txn_date AS "Date"
			FROM
			adw_txn_main A
			INNER JOIN adw_txn_type B on A.txn_type_id = B.txn_type_id
			WHERE
			A.user_id = \'1\'
			ORDER BY A.txn_main_id
		';
		
$query[] = '
			SELECT
			AAA.person_name AS "Name of Person",
			AAA.credit_flow AS "Credit Flow",
			AAA.description AS "Description",
			AAA.amount AS "Amount",
			AAA.credit_date AS "Date"
			FROM
			(
				SELECT
				B.person_name,
				\'Credit Taken\' AS credit_flow,
				A.description,
				A.amount,
				A.credit_date
				FROM
				adw_credits A
				INNER JOIN adw_persons B ON A.persons_id = B.persons_id
				WHERE
				A.user_id = 1
				UNION ALL
				SELECT
				BB.person_name,
				\'Credit Returned\' AS credit_flow,
				NULL AS "description",
				(AA.amount_returned*-1) AS amount_returned,
				AA.return_date
				FROM
				adw_credit_return AA
				INNER JOIN adw_persons BB ON AA.persons_id = BB.persons_id
				WHERE
				AA.user_id = 1
			) AAA
			ORDER BY AAA.person_name
		';

$sheetName[] = 'Detail Report - Transactions';
$sheetName[] = 'Credits Report';

$output_filename = "reports/DES Report ".time().".xlsx";
SQLToExcel($output_filename, $con, $query, $sheetName);

location($output_filename);
?>