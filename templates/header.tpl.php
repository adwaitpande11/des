<?php
$user_id = $_COOKIE['user_id'];

if((isset($_GET['refresh']) && !empty($_GET['refresh'])) || !isset($_SESSION['expense_month']) || !isset($_SESSION['earning_month']))
{
	$_SESSION['expense_month'] = getOne($con, "SELECT SUM(txn_value) AS txn_value FROM adw_txn_main A INNER JOIN adw_txn_type B ON A.txn_type_id = B.txn_type_id AND A.user_id = B.user_id WHERE A.user_id = ".$user_id." AND txn_flow='expense' AND (txn_date BETWEEN '".date('Y-m')."-01' AND '".date('Y-m-d')."')");
	$_SESSION['earning_month'] = getOne($con, "SELECT SUM(txn_value) AS txn_value FROM adw_txn_main A INNER JOIN adw_txn_type B ON A.txn_type_id = B.txn_type_id AND A.user_id = B.user_id WHERE A.user_id = ".$user_id." AND txn_flow='earning' AND (txn_date BETWEEN '".date('Y-m')."-01' AND '".date('Y-m-d')."')");
}

if($_SESSION['expense_month'] >= 30000 && $_SESSION['expense_month'] < 45000)
{
	$background = 'rgba(255,255,0,0.5)';//Orange
	$color		= '#000';
}
elseif($_SESSION['expense_month'] >= 45000)
{
	$background = 'rgba(255,0,0,0.5)';	//Red
	$color		= '#FFF';
}
else
{
	$background = 'rgba(0,204,102,1)';	//Green
	$color		= '#000';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body style="margin:0px; background-color:rgba(204,204,204,1);">
<div id="container">
<div style="width:100%; background-color:<?php echo $background ?>; color:<?php echo $color ?>; display:table">
	<?php /*?><div style="font-size: 0.9em; width:100%">
    	<div style="float:left"><strong>Earning:</strong> <?php echo currency_format($_SESSION['earning_month']) ?> |</div>
    	<div style="float:left"><strong>Expense:</strong> <?php echo currency_format($_SESSION['expense_month']) ?> |</div>
    	<div style="float:left"><strong>Saving:</strong> <?php echo currency_format($_SESSION['earning_month']-$_SESSION['expense_month']) ?></div>
    </div><?php */?>
    <table style="width:100%">
        <tr>
            <td style="width:33%; padding:1vw 3vw;"><strong style="font-size:0.7em">Earning:</strong> <?php echo currency_format($_SESSION['earning_month']) ?></td>
            <td style="width:33%; padding:1vw 3vw;"><strong style="font-size:0.7em">Expense:</strong> <?php echo currency_format($_SESSION['expense_month']) ?></td>
            <td style="padding:1vw 3vw;"><strong style="font-size:0.7em">Saving:</strong> <?php echo currency_format($_SESSION['earning_month']-$_SESSION['expense_month']) ?></td>
        </tr>
    </table>
</div>
<div style="width:100%; background-color:#666666; color:white; display:table">
	<div style="font-size:0.7em;" class="mainMenu">
    	<a href="index.php"><div><img src="images/home_mini.png" style="width:3vw;height:3vw"></div></a>
    	<a href="menu_reports.php"><div>Reports</div></a>
    	<a href="credit_view.php"><div>Credits</div></a>
    	<a href="extras.php"><div>Extras</div></a>
    </div>
</div>
<!--<div id="page_loading" style="display:none">Loading, please wait&hellip;</div>-->
<div class="content_holder">
<?php
if(isset($_GET['msg']) && !empty($_GET['msg']))
{
	$msg_no = $_GET['msg'];
	include("includes/messages.inc.php");
?>
	<div class="message <?php echo $msg[$msg_no]['class'] ?>"><?php echo $msg[$msg_no]['message'] ?></div>
    <style>
    .message{color:#FFF; font-weight: bold; padding-left: 5px; margin-top: 5px;}
	.success{background-color: rgba(51,153,0,1);}
	.error{background-color: rgba(204,0,0,1);}
    </style>
<?php
}
?>