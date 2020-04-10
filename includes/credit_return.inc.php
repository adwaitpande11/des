<?php
$persons_id = req('persons_id');
$pay = req("pay");
if(isset($persons_id))
{
	$amount_due = getOne($con, "SELECT SUM(amount)-IFNULL(B.amount_returned, 0) AS amount							
							FROM adw_credits A
							LEFT JOIN (
								SELECT persons_id, SUM(amount_returned) AS amount_returned
								FROM adw_credit_return WHERE user_id = ".$user_id." GROUP BY persons_id
							) B USING(persons_id)
							INNER JOIN adw_persons C USING(persons_id)
							WHERE A.user_id=".$user_id." AND persons_id=".$persons_id."
							GROUP BY persons_id HAVING amount>0");
}

/*if(isset($pay))
{
    $persons_id			= req('persons_id');
    $amount_returned	= req('amount_returned');
    $return_date		= req('date_year')."-".req('date_month')."-".req('date_day');
    
    $adw_credit_return = array(
        'persons_id'		=> $persons_id,
        'user_id'			=> $user_id,
        'amount_returned'	=> $amount_returned,
        'return_date'		=> $return_date,
    );
    
    $credit_return_id = insert($con, "adw_credit_return", $adw_credit_return);
    
    if($credit_return_id > 0)
        location("?msg=1");
        else
            location("?msg=2");
}*/

if(isset($pay))
{
    $persons_id			= req('persons_id');
    $amount_returned	= req('amount_returned');
    $return_date		= req('date_year')."-".req('date_month')."-".req('date_day');
    
    if($amount_returned > 0)
    {
        $credit_entries = getRows($con, "   SELECT credits_id, persons_id, user_id, amount, total_returned, (amount-total_returned) AS total_due
                                            FROM
                                            (
                                                SELECT 
                                                A.credits_id, A.persons_id, A.user_id, A.amount, IFNULL(SUM(B.amount_returned), 0) AS total_returned
                                                FROM
                                                adw_credits A
                                                LEFT JOIN adw_credit_return B ON (A.credits_id = B.credits_id)
                                                WHERE 1 = 1
                                                AND A.persons_id = ".$persons_id."
                                                AND A.user_id = ".$user_id."
                                                GROUP BY A.credits_id, A.persons_id, A.user_id, A.amount
                                            ) tbl_alias
                                            WHERE 
                                            amount <> total_returned
                                            ORDER BY credits_id
                                        ");
        
        mysqli_begin_transaction($con);
        foreach($credit_entries as $credit_entry)
        {
            $adw_credit_return = array(
                'persons_id'		=> $persons_id,
                'user_id'			=> $user_id,
                'credits_id '       => $credit_entry['credits_id'],
                'amount_returned'	=> $credit_entry['total_due'] > $amount_returned ? $amount_returned : $credit_entry['total_due'],
                'return_date'		=> $return_date,
            );
            
            $credit_return_id = insert($con, "adw_credit_return", $adw_credit_return);
            
            if($credit_return_id > 0)
            {
                $amount_returned -= $credit_entry['total_due'];
                
                if($amount_returned <= 0)
                {
                    $success_flag = true;
                    break;
                }
            }
            else
            {
                $success_flag = false;
                break;
            }
        }
        
        if($success_flag)
        {
            mysqli_commit($con);
            location("?msg=1");
        }
        else
        {
            mysqli_rollback($con);
            location("?msg=2");
        }
    }
    else
        location("?msg=2");
}
$persons = getRows($con, "SELECT persons_id, SUM(amount)-IFNULL(B.amount_returned, 0) AS amount, person_name							
							FROM adw_credits A
							LEFT JOIN (
								SELECT persons_id, SUM(amount_returned) AS amount_returned
								FROM adw_credit_return WHERE user_id = ".$user_id." GROUP BY persons_id
							) B USING(persons_id)
							INNER JOIN adw_persons C USING(persons_id)
							WHERE A.user_id=".$user_id."
							GROUP BY persons_id HAVING amount>0 ORDER BY person_name");
?>