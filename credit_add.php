<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/credit_add.inc.php");
?>
<form method="post">
<table>
<tr>
	<td>Date</td>
	<td>
    	<select name="date_day" class="date_day">
<?php
			for($i=1; $i<=31; $i++)
			{
?>
	        	<option value="<?php if(strlen($i)==1){echo "0".$i;}else{echo $i;} ?>" <?php if($i == date("d")) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			}
?>
    	</select>
        <select name="date_month" class="date_month">
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
    	<select name="date_year" class="date_year">
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
	<td>Name</td>
	<td>
    	<select name="persons_id">
        	<option value="0">Select Person</option>
<?php
		foreach($persons as $person)
		{
?>
			<option value="<?php echo $person['persons_id'] ?>"><?php echo $person['person_name'] ?></option>
<?php
		}
?>
        </select>
    </td>
</tr>
<tr>
	<td>Detail</td>
	<td><textarea name="description"></textarea></td>
</tr>
<tr>
	<td>Value</td>
	<td><input type="text" name="amount" autocomplete="off" /></td>
</tr>
<tr>
	<td></td>
	<td align="center"><input type="submit" name="submit" value="Add Credit" /></td>
</tr>
</table>
</form>

<style>
select[name='persons_id'], select[name='txn_type_id']
{
	width: 100%;
}
textarea,input[type=text]{width:97%;}
</style>
<?php
include("templates/menu.tpl.php");
include("templates/footer.tpl.php");
?>