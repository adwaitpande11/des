<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("includes/login.inc.php");
?>
<body style="margin:0px;">
<div style="width:100%; background-color:rgba(255,255,0,0.5); padding:2vw 0vw">
    <div style="font-size:0.9em;">
    	Daily Expense Software
    </div>
</div>
<br>
<table style="width:100%; text-align:center;">
	<tr>
    	<td>Login to</td>
    </tr>
	<tr>
    	<td style="font-weight:bold; font-size:1.1em">Daily Expense Software</td>
    </tr>
</table>
<br>
<center>
<?php
if(isset($_GET['status']) && !empty($_GET['status']) && $_GET['status']=='success')
{
?>
	<div style="color:green">Success</div>
<?php
}
if(isset($_GET['status']) && !empty($_GET['status']) && $_GET['status']=='error')
{
?>
	<div style="color:red">Failed</div>
<?php
}
?>
<form method="post">
<table>
	<tr>
    	<td><input type="text" name="username" placeholder="Username" id="username" autocomplete="off" required /></td>
    </tr>
	<tr>
    	<td><input type="password" name="password" placeholder="Password" required /></td>
    </tr>
	<tr>
    	<td align="center"><br><input type="submit" name="submit" value="Submit" /></td>
    </tr>
</table>
</form>
</center>
<style>
input[type=text], input[type=password]{width:97%;border:0.5vw solid rgba(153,153,153,1);padding:3vw 5vw; font-size:4vw;}
body{background-color:rgba(204,204,204,1);}
body *{font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif; font-size:4vw;}
input[type=submit]{width:97%; background-color:rgba(51,204,204,1);padding:1vw 5vw;border: 0.5vw solid #999999;margin-left:-2vw;}
</style>
<script>document.getElementById("username").focus();</script>
</body>