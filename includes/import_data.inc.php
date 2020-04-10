<?php
if(isset($_POST['btn_submit_file_import']) && !empty($_POST['btn_submit_file_import']))
{	$directory_name = 'temp/temp_import_data/';
	$target_filename = $directory_name.$_FILES['input_file']['name'];
	
	empty_dir($directory_name);
	$file_upload_status = move_uploaded_file($_FILES['input_file']['tmp_name'], $target_filename);
	$file_extension = get_file_extension($_FILES['txn_attachment_'.$attachment_type]['name']);
	if($file_upload_status)
	{	
		$data = new Spreadsheet_Excel_Reader($target_filename);
		
		$data->sheets[0]['numRows'];
		$data->sheets[0]['numCols'];
		
		for($row = 2; $row <= $data->sheets[0]['numRows']; $row++)
		{			
			$txn_date = $data->val($row, 2, 0);
			$txn_type_id = $data->val($row, 3, 0);
			$txn_description = $data->val($row, 5, 0);
			$txn_value = $data->val($row, 6, 0);
			
			$is_txn_type_available = getOne($con, "SELECT txn_typename FROM adw_txn_type WHERE txn_type_id = ".$txn_type_id);
			
			if($is_txn_type_available === 0)
			{
				location("?msg=4");
			}
			else
			{
				$adw_txn_main = array(
										'txn_type_id'		=> $txn_type_id,
										'txn_description'	=> nl2br($txn_description),
										'txn_value'			=> $txn_value,
										'txn_date'			=> $txn_date,
										'user_id'			=> $user_id,
										);
										
				$txn_main_id = insert($con, "adw_txn_main", $adw_txn_main);
				
				if($txn_main_id == 0 || $txn_main_id == FALSE)
				{
					location("?msg=2");
				}
			}
		}
			
		if ($txn_main_id > 0)
		{
			location("?msg=1&refresh=1");
		}
	}
	else
	{
		location("?msg=2");
	}
}
?>