<?php
include("includes/connection.inc.php");
include("includes/functions.inc.php");

if(isset($_GET['curl_visit']) && $_GET['curl_visit'] == 'true'){}
else
	include("authentication.php");


//include("templates/header.tpl.php");
require("includes/backup/mysql_backup.php");


$db_name			= DATABASE;
$file_path			= "backup_files";
$output_filename	= "backup_".time().".zip";

if(isset($_GET['is_download']))
	$is_download = $_GET['is_download'];
else
	$is_download = true;

mysql_backup($con, $db_name, $file_path, $output_filename, $is_download);
?>