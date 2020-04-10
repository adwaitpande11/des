<?php
include("../../includes/connection.inc.php");
include("../../includes/functions.inc.php");

$user_id = 1;

$requestBody = file_get_contents('php://input');
$requestBody = json_decode($requestBody, true);

if($requestBody['queryResult']['action']=="expense.save" && $requestBody['queryResult']['allRequiredParamsPresent'])
{
    $txn_type_id = getOne($con, "SELECT txn_type_id FROM adw_txn_type WHERE txn_typename = '".$requestBody['queryResult']['parameters']['txn_typename']."'");
    if($txn_type_id > 0)
    {    
        $txn_description	= $requestBody['queryResult']['parameters']['txn_description'];
        $txn_value			= $requestBody['queryResult']['parameters']['txn_value'];
        $date				= $requestBody['queryResult']['parameters']['txn_date'];
        
        $adw_txn_main = array(
            'txn_type_id'		=> $txn_type_id,
            'txn_description'	=> ucfirst($txn_description),
            'txn_value'			=> $txn_value,
            'txn_date'			=> $date,
            'user_id'			=> $user_id,
        );
        
        $txn_main_id = insert($con, "adw_txn_main", $adw_txn_main);
        
        if($txn_main_id > 0)
        {
            echo prepareResponse("Transaction saved. Say 'Goodbye' to exit or you can provide other command as well.");
            //echo prepareResponse("Saved the following details - \nDate: ".$date."\nTpye: ".$requestBody['queryResult']['parameters']['txn_typename']."\nDescription: ".$txn_description."\nAmount: ".$txn_value."\n\nSay 'Cancel' to exit or you can provide other command as well.");
        }
        else
        {
            echo prepareResponse("Uh oh! Something went wrong. Please try again.");
        }
    }
    else
    {
        echo prepareResponse("Uh oh! Transaction type not available. Please try again.");
    }
}
else
{
    echo prepareResponse("Uh oh! Something went wrong while communicating with server. Please try again.");
}

function prepareResponse($msg) {
    return json_encode(array('fulfillmentText' => $msg));
}

mysqli_close($con);
?>