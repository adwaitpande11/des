<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/classes/excel_reader2.php");
include("includes/import_data.inc.php");
?>
<h1>Import Data</h1>
<form method="post" enctype="multipart/form-data">
	<input type="file" name="input_file">
    <input type="submit" name="btn_submit_file_import" value="Submit">
</form>
<br>
<div><a href="docs/Import_Format_Expense_List.xls">Download template</a></div>
<br><br>
<?php
include("templates/footer.tpl.php");
?>