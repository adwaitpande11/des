<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/report_category_history.inc.php");
?>
<form method="post">
<table>
<tr>
	<td>End Month:</td>
	<td>
    	<select name="date_month_to">
			<option value="01" <?php if(date("m")==1) echo "selected='selected'" ?>>January</option>
			<option value="02" <?php if(date("m")==2) echo "selected='selected'" ?>>February</option>
			<option value="03" <?php if(date("m")==3) echo "selected='selected'" ?>>March</option>
			<option value="04" <?php if(date("m")==4) echo "selected='selected'" ?>>April</option>
			<option value="05" <?php if(date("m")==5) echo "selected='selected'" ?>>May</option>
			<option value="06" <?php if(date("m")==6) echo "selected='selected'" ?>>June</option>
			<option value="07" <?php if(date("m")==7) echo "selected='selected'" ?>>July</option>
			<option value="08" <?php if(date("m")==8) echo "selected='selected'" ?>>August</option>
			<option value="09" <?php if(date("m")==9) echo "selected='selected'" ?>>September</option>
			<option value="10" <?php if(date("m")==10) echo "selected='selected'" ?>>October</option>
			<option value="11" <?php if(date("m")==11) echo "selected='selected'" ?>>November</option>
			<option value="12" <?php if(date("m")==12) echo "selected='selected'" ?>>December</option>
        </select>
    	<select name="date_year_to">
<?php
			for($i=2014; $i<=2020; $i++)
			{
?>
	        	<option value="<?php echo $i ?>" <?php if($i == date("Y")) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			}
?>
    	</select>
    </td>
	<td align="center"><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>

<table id="tbl_report_category_history">
    <tr>
        <th>Sr</th>
        <th>Transaction Type</th>
        <th><?php echo date("M y", strtotime($month_4)) ?></th>
        <th><?php echo date("M y", strtotime($month_3)) ?></th>
        <th><?php echo date("M y", strtotime($month_2)) ?></th>
        <th><?php echo date("M y", strtotime($month_1)) ?></th>
        <th>Total</th>
        <th>Average</th>
    </tr>
<?php
$i = 0;
foreach($txns as $txn)
{ $i++;
?>
    <tr>
        <td><?php echo $i ?></td>
        <td style="white-space: nowrap;"><?php echo $txn['txn_typename'] ?></td>
        <td class="align_right"><a href="<?php if($txn['month_4'] == '0'){echo "javascript:void(0)";}else{ ?>report_category_drill1.php?action=report_category_drill1&txn_type_id=<?php echo $txn['txn_type_id'] ?>&date_from=<?php echo $month_4 ?>&date_to=<?php echo $month_4; } ?>"><?php echo currency_format($txn['month_4']) ?></a></td>
        <td class="align_right"><a href="<?php if($txn['month_3'] == '0'){echo "javascript:void(0)";}else{ ?>report_category_drill1.php?action=report_category_drill1&txn_type_id=<?php echo $txn['txn_type_id'] ?>&date_from=<?php echo $month_3 ?>&date_to=<?php echo $month_3; } ?>"><?php echo currency_format($txn['month_3']) ?></a></td>
        <td class="align_right"><a href="<?php if($txn['month_2'] == '0'){echo "javascript:void(0)";}else{ ?>report_category_drill1.php?action=report_category_drill1&txn_type_id=<?php echo $txn['txn_type_id'] ?>&date_from=<?php echo $month_2 ?>&date_to=<?php echo $month_2; } ?>"><?php echo currency_format($txn['month_2']) ?></a></td>
        <td class="align_right"><a href="<?php if($txn['month_1'] == '0'){echo "javascript:void(0)";}else{ ?>report_category_drill1.php?action=report_category_drill1&txn_type_id=<?php echo $txn['txn_type_id'] ?>&date_from=<?php echo $month_1 ?>&date_to=<?php echo $month_1; } ?>"><?php echo currency_format($txn['month_1']) ?></a></td>
        <td class="align_right"><?php echo currency_format($txn_sum = $txn['month_1'] + $txn['month_2'] + $txn['month_3'] + $txn['month_4']) ?></td>
        <td class="align_right"><?php echo currency_format(ceil($txn_sum/4)); ?></td>
    </tr>
<?php 
    if($txn['txn_flow'] == "expense")
	{
		$expense_1 += $txn['month_1'];
		$expense_2 += $txn['month_2'];
		$expense_3 += $txn['month_3'];
		$expense_4 += $txn['month_4'];
	}
    if($txn['txn_flow'] == "earning")
	{
		$earning_1 += $txn['month_1'];
		$earning_2 += $txn['month_2'];
		$earning_3 += $txn['month_3'];
		$earning_4 += $txn['month_4'];
	}
}
?>
    <tr class="footers">
        <td colspan="2" align="right">Total Expense</td>
        <td class="align_right"><?php echo currency_format($expense_4) ?></td>
        <td class="align_right"><?php echo currency_format($expense_3) ?></td>
        <td class="align_right"><?php echo currency_format($expense_2) ?></td>
        <td class="align_right"><?php echo currency_format($expense_1) ?></td>
        <td class="align_right"><?php echo currency_format($expense_sum = $expense_1 + $expense_2 + $expense_3 + $expense_4) ?></td>
        <td class="align_right"><?php echo currency_format(ceil($expense_sum/4)); ?></td>
    </tr>
    <tr class="footers">
        <td colspan="2" align="right">Total Earning</td>
        <td class="align_right"><?php echo currency_format($earning_4) ?></td>
        <td class="align_right"><?php echo currency_format($earning_3) ?></td>
        <td class="align_right"><?php echo currency_format($earning_2) ?></td>
        <td class="align_right"><?php echo currency_format($earning_1) ?></td>
        <td class="align_right"><?php echo currency_format($earning_sum = $earning_1 + $earning_2 + $earning_3 + $earning_4) ?></td>
        <td class="align_right"><?php echo currency_format(ceil($earning_sum/4)); ?></td>
    </tr>
    <tr class="footers">
        <td colspan="2" align="right">Saving</td>
        <td class="align_right"><?php echo currency_format($saving_4 = $earning_4 - $expense_4 )?></td>
        <td class="align_right"><?php echo currency_format($saving_3 = $earning_3 - $expense_3) ?></td>
        <td class="align_right"><?php echo currency_format($saving_2 = $earning_2 - $expense_2) ?></td>
        <td class="align_right"><?php echo currency_format($saving_1 = $earning_1 - $expense_1) ?></td>
        <td class="align_right"><?php echo currency_format($saving_sum = $saving_1 + $saving_2 + $saving_3 + $saving_4) ?></td>
        <td class="align_right"><?php echo currency_format(ceil($saving_sum/4)); ?></td>
    </tr>
</table>
<?php include("templates/menu.tpl.php") ?>
<style>
input[type=text], textarea, select[name='persons_id'], select[name='txn_type_id']{width: 100%;}
.align_right{text-align:right; padding-right:10px; padding-left:10px; white-space: nowrap;}
#tbl_report_category_history, #tbl_report_category_history td, #tbl_report_category_history th
{
	border-collapse:collapse; table-layout:fixed; border: 0.5vw solid #999999;
}
</style>
<?php
include("templates/footer.tpl.php");
?>