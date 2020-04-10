<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	$person_name			= req('person_name');
	$person_contact_details	= req('person_contact_details');
	
	$adw_persons = array(
							'person_name'			=> $person_name,
							'person_contact_details'=> $person_contact_details,
							'user_id'				=> $user_id,
							);
							
	$persons_id = insert($con, "adw_persons", $adw_persons);
	
	if($persons_id > 0)
		location("?msg=1");
	else
		location("?msg=2");
}
?>