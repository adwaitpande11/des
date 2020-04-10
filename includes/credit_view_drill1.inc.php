<?php
$persons_id = req("persons_id");
$person_name = req("person_name");

$credit_details = getRows($con, "SELECT credits_id, description, amount, credit_date FROM `adw_credits` WHERE persons_id=".$persons_id." AND user_id=".$user_id);
$credit_rerutned = getOne($con, "SELECT SUM(amount_returned) AS amount_returned FROM adw_credit_return WHERE persons_id=".$persons_id." AND user_id=".$user_id." GROUP BY persons_id");
?>