<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/report_custom.inc.php");
?>
<form method="post">
<table>
<tr>
	<td>From: </td>
	<td>
    	<select name="date_day_from">
<?php
			for($i=1; $i<=31; $i++)
			{
?>
	        	<option value="<?php if(strlen($i)==1){echo "0".$i;}else{echo $i;} ?>" <?php if($i == 1) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			}
?>
    	</select>
        <select name="date_month_from">
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
    	<select name="date_year_from">
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
</tr>
<tr>
	<td>To:</td>
	<td>
    	<select name="date_day_to">
<?php
			for($i=1; $i<=31; $i++)
			{
?>
	        	<option value="<?php if(strlen($i)==1){echo "0".$i;}else{echo $i;} ?>" <?php if($i == date("d")) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			}
?>
    	</select>
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
</tr>
<tr>
	<td></td>
	<td align="center"><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>

<div><span style="font-weight:bold">Report Date:</span> <span><?php echo date("d M Y", strtotime($date_from)) ?> to <?php echo date("d M Y", strtotime($date_to)) ?></span></div>
<table style="border-collapse:collapse" border="1">
    <tr>
        <th>Sr</th>
        <th><img src="images/attachment.png" width="16" height="16"/></th>
        <th>Date</th>
        <th>Type</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>
<?php
$i = 0; $expense = 0; $earning = 0;
foreach($txns as $txn)
{ $i++;
?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php if($txn['txn_attachment'] != ''){ ?>
        	<a href="<?php echo "attachments/".$txn['txn_attachment'] ?>" target="_blank"><img src="images/attachment.png" width="16" height="16"/></a>
			<?php } ?></td>
        <td><?php echo date("d/m/Y", strtotime($txn['txn_date'])) ?></td>
        <td><?php echo $txn['txn_typename'] ?></td>
        <td><?php echo $txn['txn_description'] ?></td>
        <td><?php echo $txn['txn_value'] ?></td>
    </tr>
<?php
    if($txn['txn_flow'] == "expense")
        $expense += $txn['txn_value'];
    if($txn['txn_flow'] == "earning")
        $earning += $txn['txn_value'];
}
?>
    <tr class="footers">
        <td colspan="5" align="right">Total Expense</td>
        <td><?php echo $expense ?></td>
    </tr>
    <tr class="footers">
        <td colspan="5" align="right">Total Earning</td>
        <td><?php echo $earning ?></td>
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