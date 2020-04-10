<?php
/*
*	1)	$connection	:	This parameter is the connection string to the mysql database
*						e.g.	$con = mysqli_connect("localhost", "root", "db_password")
*								export_database($con, param_2, param_3);
*
*	2)	$db_name	:	This is the name of database you want to export. This database should already exist on database server.
*						e.g.	$db = "db_mydatabase"
*								export_database(param_1, $db, param_3);
*
*	3)	$output_dir	:	This is the path to the output directory where the backup files will be saved.
*						e.g.	$folder = "backup/databases"	--Note: Do not append trailing '/' to the directory name
*								export_database(param_1, param_2, $folder);
*
*	4)	e.g. export_database($con, $db, $folder);
*		Calling this function will export all the data from database $db in .csv format and an additional .sql file with table
*		definitions in the directory specified by $folder variable.
*/

function exportDatabase($connection, $db_name, $output_dir)
{	
	mysqli_select_db($connection, $db_name) or die('Cannot select database');
	
	if(!is_dir($output_dir))
		mkdir($output_dir) or die("Cannot create output directory");		// If the directory in which backup file is to be stored does not exist, new one will be created
	
	$tables = getRows($connection, "SHOW TABLES FROM ".$db_name);	// Get all the table names from selected MySQL database
	
	$index = "Tables_in_".$db_name;
	
	$definition = '';
	foreach($tables as $table)
	{
		$table_description = getRow($connection, "SHOW CREATE TABLE ".$table[$index]);
		$definition .= $table_description['Create Table']."\r\n\r\n\r\n";		// $definition holds the string of CREATE TABLE statments for all tables
	}
	$fp = fopen($output_dir."/definitions.sql", "w");		// All the CREATE TABLE statements are stored in .sql file
	if($fp)
		file_put_contents($output_dir."/definitions.sql", $definition);
	else
		{echo "Limited privileges. Please grant write permission on backup directory or contact your administrator."; exit;}
	
	fclose($fp);
	
	foreach($tables as $table)
	{
		$all_rows = getRows($connection, "SELECT * FROM ".$table[$index]);
		if($all_rows == 0)
			continue;
		
		$fp = fopen($output_dir."/".$table[$index].".csv", "w");
		
		$columns = getRows($connection, "SHOW COLUMNS FROM ".$table[$index]);
		foreach($columns as $column)
		{
			$column_array[] = $column['Field'];
		}
		
		//fputcsv($fp, $column_array);
		$data = implode('^', $column_array)."~";
		unset($column_array);
		
		foreach($all_rows as $row)
		{
			$data .= implode('^', $row)."~";	//The line separator is ~ and ^ is column separator
			//fputcsv($fp, $row);
		}
		file_put_contents($output_dir."/".$table[$index].".csv", $data);
		//print_r($data); exit;
		fclose($fp);
		
	}
}
?>