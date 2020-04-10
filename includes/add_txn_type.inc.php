<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$txn_typename= req('txn_typename');
	$txn_flow	 = req('txn_flow');
	
	$txn_typename = ucwords($txn_flow)." - ".ucwords($txn_typename);
	
	$adw_txn_type = array(
							'txn_typename'		=> $txn_typename,
							'txn_flow'			=> $txn_flow,
							'user_id'			=> $user_id,
							);
							
	$txn_type_id = insert($con, "adw_txn_type", $adw_txn_type);
	
	if($txn_type_id > 0)
		location("?msg=1");
	else
		location("?msg=2");
}
?>