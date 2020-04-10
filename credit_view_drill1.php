<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/credit_view_drill1.inc.php");
?>
<div><strong>Credits Details:</strong> <?php echo $person_name ?></div>
<table style="border-collapse:collapse" border="1">
<tr>
	<th>Sr.</th>
	<th>Date</th>
	<th>Description</th>
	<th>Amount</th>
</tr>
<?php
$i = 0;
foreach($credit_details as $credit_detail)
{
    $i++;
?>
<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo date("d/m/Y", strtotime($credit_detail['credit_date'])); ?></td>
	<td><?php echo $credit_detail['description']; ?></td>
	<td align="right">
    	<?php
    	   echo $credit_detail['amount'];
    	   $returned_total = 0;
    	   foreach(getRows($con, "SELECT * FROM adw_credit_return WHERE credits_id = ".$credit_detail['credits_id']) as $returned)
    	   {
    	       $returned_total += $returned['amount_returned'];
    	       echo "<br><span style = \"color:green;font-size:0.8em\">+".$returned['amount_returned']."</span>";
    	   }
    	   
    	   if($credit_detail['amount'] > $returned_total)
    	   {
    	       echo "<hr>";
    	       echo "<span style = \"color:red;font-size:0.8em\">".($credit_detail['amount'] - $returned_total)."</span>";
    	   }
    	?>
	</td>
</tr>
<?php
	$total_credit_amount += $credit_detail['amount'];
}
?>
<tr class="footers">
	<td colspan="3" align="right">Total Credit</td>
    <td><?php echo $total_credit_amount ?></td>
</tr>
<tr class="footers">
	<td colspan="3" align="right">Credit Returned</td>
    <td><?php echo $credit_rerutned ?></td>
</tr>
<tr class="footers">
	<td colspan="3" align="right">Amount Remaining</td>
    <td><?php echo $total_credit_amount - $credit_rerutned ?></td>
</tr>
</table>
<?php
include("templates/menu.tpl.php");
include("templates/footer.tpl.php");
?>