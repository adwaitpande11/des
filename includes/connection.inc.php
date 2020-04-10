<?php
ob_start();
session_start();

//error_reporting(0);
date_default_timezone_set("Asia/Kolkata");

//$environment = 'dev';
$environment = 'prod';

// My laptop
if($_SERVER['HTTP_HOST'] == 'localhost')
{
	define("HOST", "p:localhost");
	define("USERNAME", "root");
	define("PASSWORD", "");
	define("DATABASE", "adw_des_oltp");
}

// Website
if($_SERVER['HTTP_HOST'] == 'des.com')
{
    if($environment == 'dev')
	{
		define("HOST", "localhost");
		define("USERNAME", "dev_user");
		define("PASSWORD", "dev_password");
		define("DATABASE", "adw_dev_des_oltp");
	}
	else if($environment == 'prod')
	{
	    define("HOST", $_SERVER['HTTP_HOST']);
		define("USERNAME", "prod_user");
		define("PASSWORD", "prod_password");
		define("DATABASE", "adw_des_oltp");
	}
}

// Un-comment this while debugging database connection issue
/*echo HOST."<br>";
echo USERNAME."<br>";
echo PASSWORD."<br>";
echo DATABASE."<br>";

print_array($_SERVER);*/

if(!isset($con))
{	
	$con = mysqli_connect(HOST, USERNAME, PASSWORD) or die("Cannot connect to database");
	mysqli_select_db($con, DATABASE) or die("Database not selected");
}
?>
