<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/chart_monthly.inc.php");
?>
<form method="post">
<table>
<tr>
	<td>From: </td>
	<td>
        <select name="date_month_from">
			<option value="01" <?php if($month_from==1) echo "selected='selected'" ?>>January</option>
			<option value="02" <?php if($month_from==2) echo "selected='selected'" ?>>February</option>
			<option value="03" <?php if($month_from==3) echo "selected='selected'" ?>>March</option>
			<option value="04" <?php if($month_from==4) echo "selected='selected'" ?>>April</option>
			<option value="05" <?php if($month_from==5) echo "selected='selected'" ?>>May</option>
			<option value="06" <?php if($month_from==6) echo "selected='selected'" ?>>June</option>
			<option value="07" <?php if($month_from==7) echo "selected='selected'" ?>>July</option>
			<option value="08" <?php if($month_from==8) echo "selected='selected'" ?>>August</option>
			<option value="09" <?php if($month_from==9) echo "selected='selected'" ?>>September</option>
			<option value="10" <?php if($month_from==10) echo "selected='selected'" ?>>October</option>
			<option value="11" <?php if($month_from==11) echo "selected='selected'" ?>>November</option>
			<option value="12" <?php if($month_from==12) echo "selected='selected'" ?>>December</option>
        </select>
    	<select name="date_year_from">
<?php
			for($i=2014; $i<=2020; $i++)
			{
?>
	        	<option value="<?php echo $i ?>" <?php if($i == $year_from) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			}
?>
    	</select>
    </td>
</tr>
<tr>
	<td>To:</td>
	<td>
        <select name="date_month_to">
			<option value="01" <?php if($month_to==1) echo "selected='selected'" ?>>January</option>
			<option value="02" <?php if($month_to==2) echo "selected='selected'" ?>>February</option>
			<option value="03" <?php if($month_to==3) echo "selected='selected'" ?>>March</option>
			<option value="04" <?php if($month_to==4) echo "selected='selected'" ?>>April</option>
			<option value="05" <?php if($month_to==5) echo "selected='selected'" ?>>May</option>
			<option value="06" <?php if($month_to==6) echo "selected='selected'" ?>>June</option>
			<option value="07" <?php if($month_to==7) echo "selected='selected'" ?>>July</option>
			<option value="08" <?php if($month_to==8) echo "selected='selected'" ?>>August</option>
			<option value="09" <?php if($month_to==9) echo "selected='selected'" ?>>September</option>
			<option value="10" <?php if($month_to==10) echo "selected='selected'" ?>>October</option>
			<option value="11" <?php if($month_to==11) echo "selected='selected'" ?>>November</option>
			<option value="12" <?php if($month_to==12) echo "selected='selected'" ?>>December</option>
        </select>
    	<select name="date_year_to">
<?php
			for($i=2014; $i<=2020; $i++)
			{
?>
	        	<option value="<?php echo $i ?>" <?php if($i == $year_to) echo "selected='selected'" ?>><?php echo $i ?></option>
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


<table style="border-collapse:collapse" border="1">
    <tr>
        <th colspan="5">Actuals</th>
        <th>Predicted</th>
    </tr>
    <tr>
        <th>Sr</th>
        <th>Month</th>
        <th>Earning</th>
        <th>Expense</th>
        <th>Saving</th>
        <th>Expense</th>
    </tr>
<?php
$i = 0;
foreach($txns as $txn)
{ $i++;
?>
    <tr>
        <td><?php echo $i ?></td>
        <td><a href="report_category.php?reporting_month=<?php echo date('Y-m', strtotime($txn['REPORTING_YEAR']."-".$txn['REPORTING_MONTH']."-01")) ?>"><?php echo date('M', strtotime($txn['REPORTING_YEAR']."-".$txn['REPORTING_MONTH']."-01"))." ".$txn['REPORTING_YEAR'] ?></a></td>
        <td><?php echo currency_format($txn['MNTH_EARNING']) ?></td>
        <td><?php echo currency_format($txn['MNTH_EXPENSE']) ?></td>
        <td><?php echo currency_format($txn['MNTH_EARNING']-$txn['MNTH_EXPENSE']) ?></td>
        <td><?php 
        $regressor_input = "SELECT txn_months.txn_month,
                            COALESCE(expense_data.expense, 0) AS expense,
                            COALESCE(earning_data.earning, 0) AS earning
                            FROM
                            (
                            	SELECT DISTINCT date_format(txn_date, \"%Y-%m\") AS txn_month FROM adw_txn_main
                            ) AS txn_months
                            LEFT JOIN 
                            (
                            	SELECT date_format(a.txn_date, \"%Y-%m\") AS txn_month, sum(a.txn_value) as expense
                            	FROM adw_txn_main a INNER JOIN adw_txn_type b ON a.txn_type_id = b.txn_type_id
                            	WHERE UPPER(b.txn_flow) = 'EXPENSE'
                            	GROUP BY date_format(a.txn_date, \"%Y-%m\")
                            ) AS expense_data ON txn_months.txn_month = expense_data.txn_month
                            LEFT JOIN 
                            (
                            	SELECT date_format(a.txn_date, \"%Y-%m\") AS txn_month, sum(a.txn_value) as earning
                            	FROM adw_txn_main a INNER JOIN adw_txn_type b ON a.txn_type_id = b.txn_type_id
                            	WHERE UPPER(b.txn_flow) = 'EARNING'
                            	GROUP BY date_format(a.txn_date, \"%Y-%m\")
                            ) AS earning_data ON txn_months.txn_month = earning_data.txn_month
                            WHERE txn_months.txn_month < '".date('Y-m-d', strtotime($txn['REPORTING_YEAR']."-".($txn['REPORTING_MONTH'])."-01"))."'
                            ORDER BY txn_months.txn_month";
        $regressor_input = getRows($con, $regressor_input);
        if(empty($txn['MNTH_EARNING']))
            $month_earning = 0;
        else
            $month_earning = $txn['MNTH_EARNING'];
        
        if($regressor_input == 0)
            $regressor_input = array();
        $request_uri = "https://prediction-services-v1.herokuapp.com/simple-linear-regressor?x_earning=".$month_earning;
        echo round(call_api("POST", $request_uri, true, json_encode($regressor_input)));
        ?></td>
    </tr>
<?php
        $expense += $txn['MNTH_EXPENSE'];
        $earning += $txn['MNTH_EARNING'];
        $saving += ($txn['MNTH_EARNING']-$txn['MNTH_EXPENSE']);
}
?>
    <tr class="footers">
        <td colspan="2" align="right">Total</td>
        <td><?php echo currency_format($earning) ?></td>
        <td><?php echo currency_format($expense) ?></td>
        <td><?php echo currency_format($saving) ?></td>
        <td></td>
    </tr>
</table>
<br>
<style>
input[type=text], textarea, select[name='persons_id'], select[name='txn_type_id']
{
	width: 100%;
}
</style>
<?php
include("templates/footer.tpl.php");
?>