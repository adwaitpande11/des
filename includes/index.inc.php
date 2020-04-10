<?php
if(isset($_POST['submit']) && !empty($_POST['submit']) && $_POST['submit'] == 'Submit')
{
	print_array($_FILES);
	
	if($_FILES['txn_attachment_file']['error'] == 0)
		$attachment_type = 'file';
	elseif($_FILES['txn_attachment_camera']['error'] == 0)
		$attachment_type = 'camera';
	else
		$attachment_type = false;
	

	$txn_type_id		= req('txn_type_id');
	$txn_description	= req('txn_description');
	$txn_value			= req('txn_value');
	$date				= req('date_year')."-".req('date_month')."-".req('date_day');
	
	$adw_txn_main = array(
							'txn_type_id'		=> $txn_type_id,
							'txn_description'	=> nl2br($txn_description),
							'txn_value'			=> $txn_value,
							'txn_date'			=> $date,
							'user_id'			=> $user_id,
							);
							
	$txn_main_id = insert($con, "adw_txn_main", $adw_txn_main);
	
	if($txn_main_id > 0)
	{
		if($attachment_type)
		{
			$target_filename = $txn_main_id.get_file_extension($_FILES['txn_attachment_'.$attachment_type]['name']);
		
			if(move_uploaded_file($_FILES['txn_attachment_'.$attachment_type]['tmp_name'], "attachments/".$target_filename))
				update($con, "adw_txn_main", array('txn_attachment'	=> $target_filename), "txn_main_id = ".$txn_main_id);
		}
		
		location("?msg=1&refresh=1");
	}
	else
		location("?msg=2");
}
$txn_types = getRows($con, "SELECT txn_type_id, txn_typename FROM adw_txn_type WHERE user_id = ".$user_id);
//$persons = getRows($con, "SELECT persons_id, person_name FROM adw_persons ORDER BY person_name");

if(isset($_GET['action']) && $_GET['action'] == 'updateTxn')
{
    if($_POST['submit'] == 'Update' && is_numeric($_GET['txn_main_id']) && $_GET['txn_main_id'] > 0)
    {
        $txn_type_id		= req('txn_type_id');
        $txn_description	= req('txn_description');
        $txn_value			= req('txn_value');
        $date				= req('date_year')."-".req('date_month')."-".req('date_day');
        
        $adw_txn_main = array(
            'txn_type_id'		=> $txn_type_id,
            'txn_description'	=> nl2br($txn_description),
            'txn_value'			=> $txn_value,
            'txn_date'			=> $date,
        );
        
        if(update($con, "adw_txn_main", $adw_txn_main, "txn_main_id = ".$_GET['txn_main_id']))
        {
            location("?msg=1&refresh=1");
        }
        else
        {
            location("?msg=2&action=updateTxn&txn_main_id=".$_GET['txn_main_id']);
        }
    }
    
    $transaction = getRow($con, "SELECT txn_main_id, txn_type_id, txn_typename, txn_description, txn_value, DAY(txn_date) AS txn_date_day, MONTH(txn_date) AS txn_date_month, YEAR(txn_date) AS txn_date_year FROM v_txn_all WHERE user_id = ".$user_id." AND txn_main_id = ".$_GET['txn_main_id']);
}
?>