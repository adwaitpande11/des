<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");
include("authentication.php");
include("templates/header.tpl.php");
include("includes/menu_reports.inc.php");
?>
<table>
<tr>
	<td><a href="daily_report.php"><button>Daily Report</button></a></td>
	<td><a href="report_custom.php"><button>Custom Report</button></a></td>
</tr>
<tr>
	<td><a href="report_monthly.php"><button>Monthly Expense</button></a></td>
	<td><a href="chart_monthly.php"><button>Monthwise Report</button></a></td>
</tr>
<tr>
	<td><a href="report_category.php"><button>Category Report</button></a></td>
	<td><a href="report_category_history.php"><button>Category History</button></a></td>
</tr>
<tr>
	<td><a href="report_excel_export.php"><button>Excel Report</button></a></td>
	<td></td>
</tr>
</table>
<style>
button{width:100%;}
</style>
<?php
include("templates/footer.tpl.php");
?>