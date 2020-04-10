<?php
include("connection.inc.php");
include("functions.inc.php");
include("authentication.php");

$action = req('action');
if($action == 'run')
{
    $persons = getRows($con, "SELECT DISTINCT persons_id FROM adw_credits");
    
    foreach($persons as $person)
    {
        $returned_credit = getOne($con, "SELECT SUM(amount_returned) AS returned_credit FROM adw_credit_return WHERE persons_id = ".$person['persons_id']);
        
        if($returned_credit > 0)
        {
            $credit_entries = getRows($con, "SELECT DISTINCT credits_id, persons_id, user_id, amount, credit_date FROM adw_credits WHERE persons_id = ".$person['persons_id']." ORDER BY credit_date, amount");
            
            foreach($credit_entries as $credit_entry)
            {
                $adw_credit_return_new = array(
                    'persons_id'		=> $person['persons_id'],
                    'user_id'			=> $credit_entry['user_id'],
                    'credits_id '       => $credit_entry['credits_id'],
                    'amount_returned'	=> $credit_entry['amount'] > $returned_credit ? $returned_credit : $credit_entry['amount'],
                    'return_date'		=> $credit_entry['credit_date'],
                );
                
                $credit_return_id = insert($con, "adw_credit_return_new", $adw_credit_return_new);
                
                if($credit_return_id > 0)
                {
                    $returned_credit -= $credit_entry['amount'];
                    
                    if($returned_credit <= 0)
                        break;
                }
                else
                {
                    echo "Failed";
                }
            }
        }
        
        echo "Credit entries updated for Persons ID = ".$person['persons_id']. ". Total paid  = ".getOne($con, "SELECT SUM(amount_returned) AS returned_credit FROM adw_credit_return_new WHERE persons_id = ".$person['persons_id'])."<br>";
    }
}
?>