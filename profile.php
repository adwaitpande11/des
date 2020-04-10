<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/profile.inc.php");
?>
<form method="post">
<table>
<tr>
	<td>New Password</td>
	<td><input type="password" name="new_password" /></td>
</tr>
<tr>
	<td>Confirm Password</td>
	<td><input type="password" name="cnf_password" /></td>
</tr>
<tr>
	<td></td>
	<td align="center"><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>
<?php include("templates/menu.tpl.php") ?>
<style>
input[type=text], textarea
{
	width: 100%;
}
</style>
<?php
include("templates/footer.tpl.php");
?>