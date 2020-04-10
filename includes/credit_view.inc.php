<?php
$credits = getRows($con, "	SELECT
									persons_id, SUM(amount) AS credit_amount, IFNULL(B.amount_returned, 0) AS amount_returned,
									SUM(amount)-IFNULL(B.amount_returned, 0) AS amount,
									person_name
							
							FROM adw_credits A
							LEFT JOIN (
										SELECT persons_id, SUM(amount_returned) AS amount_returned
										FROM adw_credit_return WHERE user_id = ".$user_id." GROUP BY persons_id
										) B USING(persons_id)
							INNER JOIN adw_persons C USING(persons_id)
							WHERE A.user_id=".$user_id."
							GROUP BY persons_id ORDER BY person_name"
					);
?>