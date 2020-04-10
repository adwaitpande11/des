<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/add_txn_type.inc.php");
?>
<form method="post">
<table>
<tr>
	<td>Typename </td>
    <td><input type="text" name="txn_typename" /></td>
</tr>
<tr>
	<td>Flow </td>
    <td><select name="txn_flow"><option value="expense">Expense</option><option value="earning">Earning</select></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>
<?php include("templates/menu.tpl.php") ?>
<style>
input[type=text]
{
	width: 96%;
}
select
{
	width: 100%;
}
</style>
<?php
include("templates/footer.tpl.php");
?>