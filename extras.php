<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/extras.inc.php");
?>
<table>
<tr>
	<td><a href="add_person.php"><button>Add Person</button></a></td>
	<td><a href="add_txn_type.php"><button>Add Type</button></a></td>
</tr>
<tr>
	<td><a href="profile.php"><button>User Profile</button></a></td>
	<td><a href="settings.php"><button>Settings</button></a></td>
</tr>
<tr>
	<td><a href="backup.php"><button>Backup</button></a></td>
	<td><a href="import_data.php"><button>Import Data</button></a></td>
</tr>
</table>
<style>
button{width:100%;}
</style>
<?php
include("templates/footer.tpl.php");
?>