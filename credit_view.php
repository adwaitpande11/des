<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/credit_view.inc.php");
?>
<table>
<tr>
	<td><a href="credit_add.php"><button>Add Credit</button></a></td>
</tr>
</table>
<div><strong>Credits</strong></div>
<table style="border-collapse:collapse" border="1">
<tr>
	<th>Sr</th>
	<th>Name</th>
	<th>Credit</th>
	<th>Paid</th>
	<th>Due</th>
    <th></th>
</tr>
<?php
$i = 0;
foreach($credits as $credit)
{
	if($credit['amount']<=0)
		continue;
	$i++;
?>
<tr>
	<td><?php echo $i; ?></td>
	<td><a href="credit_view_drill1.php?action=drill1&persons_id=<?php echo $credit['persons_id'] ?>&person_name=<?php echo urlencode($credit['person_name']) ?>"><?php echo $credit['person_name']; ?></a></td>
	<td><?php echo $credit['credit_amount']; ?></td>
	<td><?php echo $credit['amount_returned']; ?></td>
	<td><?php echo $credit['amount']; ?></td>
    <td><a href="credit_return.php?persons_id=<?php echo $credit['persons_id'] ?>" title="Return Money">
    	<img src="images/money_return.png" style="width:3vw;height:3vw;" alt="Return Money"></a></td>
</tr>
<?php
	$gross_credit += $credit['credit_amount'];
	$paid_credit += $credit['amount_returned'];
	$total_credit_amount += $credit['amount'];
}
?>
<tr class="footers">
	<td colspan="2" align="right">Total</td>
    <td><?php echo $gross_credit ?></td>
    <td><?php echo $paid_credit ?></td>
    <td><?php echo $total_credit_amount ?></td>
    <td></td>
</tr>
</table>
<?php
include("templates/menu.tpl.php");
include("templates/footer.tpl.php");
?>