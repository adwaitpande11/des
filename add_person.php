<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/add_person.inc.php");
?>
<form method="post">
<table>
<tr>
	<td>Name</td>
	<td><input type="text" name="person_name" /></td>
</tr>
<tr>
	<td>Details</td>
	<td><textarea name="person_contact_details"></textarea></td>
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