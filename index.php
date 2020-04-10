<?php
include("includes/functions.inc.php");
include("includes/connection.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/index.inc.php");
?>
<form method="post" enctype="multipart/form-data">
<table><tr>
<td>

<table>
<tr>
	<td>Date</td>
	<td style="white-space:nowrap">
    	<select name="date_day" class="date_day">
<?php
            if($_GET['action']=='updateTxn')
            {
                for($i=1; $i<=31; $i++)
                {
                    ?>
	        		<option value="<?php if(strlen($i)==1){echo "0".$i;}else{echo $i;} ?>" <?php if($i == $transaction['txn_date_day']) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			    }
            }
            else
            {
			     for($i=1; $i<=31; $i++)
			     {
?>
	        		<option value="<?php if(strlen($i)==1){echo "0".$i;}else{echo $i;} ?>" <?php if($i == date("d")) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			     }
            }
?>
    	</select>
    	
<?php
            if($_GET['action']=='updateTxn')
            {
?>
              <select name="date_month" class="date_month">
        			<option value="01" <?php if($transaction['txn_date_month']==1) echo "selected='selected'" ?>>January</option>
        			<option value="02" <?php if($transaction['txn_date_month']==2) echo "selected='selected'" ?>>February</option>
        			<option value="03" <?php if($transaction['txn_date_month']==3) echo "selected='selected'" ?>>March</option>
        			<option value="04" <?php if($transaction['txn_date_month']==4) echo "selected='selected'" ?>>April</option>
        			<option value="05" <?php if($transaction['txn_date_month']==5) echo "selected='selected'" ?>>May</option>
        			<option value="06" <?php if($transaction['txn_date_month']==6) echo "selected='selected'" ?>>June</option>
        			<option value="07" <?php if($transaction['txn_date_month']==7) echo "selected='selected'" ?>>July</option>
        			<option value="08" <?php if($transaction['txn_date_month']==8) echo "selected='selected'" ?>>August</option>
        			<option value="09" <?php if($transaction['txn_date_month']==9) echo "selected='selected'" ?>>September</option>
        			<option value="10" <?php if($transaction['txn_date_month']==10) echo "selected='selected'" ?>>October</option>
        			<option value="11" <?php if($transaction['txn_date_month']==11) echo "selected='selected'" ?>>November</option>
        			<option value="12" <?php if($transaction['txn_date_month']==12) echo "selected='selected'" ?>>December</option>
                </select>
<?php
            }
            else
            {
?>
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
<?php
            }
?>
        
    	<select name="date_year" class="date_year">
<?php
            if($_GET['action']=='updateTxn')
            {
    			for($i=2014; $i<=2020; $i++)
    			{
?>
	        		<option value="<?php echo $i ?>" <?php if($i == $transaction['txn_date_year']) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			    }
            }
            else
            {
                for($i=2014; $i<=2020; $i++)
                {
                    ?>
	        		<option value="<?php echo $i ?>" <?php if($i == date("Y")) echo "selected='selected'" ?>><?php echo $i ?></option>
<?php
			    }                
            }
?>
    	</select>
    </td>
</tr>
<tr>
	<td>Type</td>
	<td>
    	<select name="txn_type_id">
<?php
		foreach($txn_types as $txn_type)
		{
?>
			<option value="<?php echo $txn_type['txn_type_id']; ?>" <?php if($txn_type['txn_type_id'] == $transaction['txn_type_id']) {echo "selected='selected'";} ?>><?php echo $txn_type['txn_typename'] ?></option>
<?php
		}
?>
        </select>
    </td>
</tr>
<tr>
	<td>Detail</td>
	<td><textarea name="txn_description"><?php echo $transaction['txn_description'] ?></textarea></td>
</tr>
<tr>
	<td>Value</td>
	<td>
    	<span><input type="text" name="txn_value" autocomplete="off" value="<?php echo $transaction['txn_value'] ?>" /></span>
        
    </td>
</tr>
<?php /*?><tr>
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
</tr><?php */?>
<tr>
	<td></td>
	<td align="center"><input type="submit" name="submit" value="<?php if($_GET['action'] == 'updateTxn') { echo "Update"; } else { echo "Submit"; } ?>" /></td>
</tr>
</table>

</td>
<td>
	<div class="image-upload">
    	<label for="file-input-attachment"><img src="images/attachment.png" style="width:4vw;height:4vw"/></label>
		<input name="txn_attachment_file" id="file-input-attachment" type="file"/>
	</div>
    
    <div class="image-upload">
    	<label for="file-input-camera"><img src="images/camera.png" style="width:4vw;height:4vw"/></label>
    	<input name="txn_attachment_camera" id="file-input-camera" accept="image/*" type="file" capture/>
	</div>
</td>
</tr>
</table>
</form>
<?php include("templates/menu.tpl.php") ?>
<style>
select[name='persons_id'], select[name='txn_type_id']
{
	width: 100%;
}
textarea,input[type=text]{width:97%;}
.image-upload > input { display: none; }
</style>
<?php
include("templates/footer.tpl.php");
?>