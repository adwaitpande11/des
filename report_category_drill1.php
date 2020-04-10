<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/report_category_drill1.inc.php");
?>
<div>
	<span style="font-weight:bold">Reporting Month:</span> <span><?php echo date("M Y", strtotime($date_from)) ?> to <?php echo date("M Y", strtotime($date_to)) ?></span>
</div>
<div>
	<span style="font-weight:bold">Category:</span> <span><?php echo $txn_typename; ?></span>
</div>
<table style="border-collapse:collapse" border="1">
    <tr>
        <th>Sr</th>
        <th>Date</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>
<?php
$i = 0;
foreach($txns as $txn)
{ $i++;
?>
    <tr>
        <td><?php echo $i ?></td>
        <td><a href="daily_report.php?action=drill2&date=<?php echo $txn['txn_date'] ?>"><?php echo date("d/m/Y", strtotime($txn['txn_date'])); ?></a></td>
        <td><?php echo $txn['txn_description'] ?></a></td>
        <td><?php echo $txn['txn_value'] ?></td>
    </tr>
<?php
        $total += $txn['txn_value'];
}
?>
    <tr class="footers">
        <td colspan="3" align="right">Total</td>
        <td><?php echo $total ?></td>
    </tr>
</table>
<?php include("templates/menu.tpl.php") ?>
<style>
input[type=text], textarea, select[name='persons_id'], select[name='txn_type_id']
{
	width: 100%;
}
</style>
<?php
include("templates/footer.tpl.php");
?>