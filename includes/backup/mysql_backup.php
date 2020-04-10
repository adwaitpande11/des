<?php
include("database_export.php");
include("zip_creator.php");

function mysql_backup($con, $db_name, $file_path, $output_filename, $is_download = false)
{
	empty_directory($file_path);
	exportDatabase($con, $db_name, $file_path);
	newZipArchive($file_path, $file_path."/".$output_filename, $is_download);
}

function empty_directory($dir)
{
	if(is_dir($dir))
	{
		$objects = scandir($dir);
		foreach ($objects as $object)
		{
			if ($object != "." && $object != "..")
			{
				if (filetype($dir."/".$object) == "dir") 
					empty_directory($dir."/".$object); 
				else
					unlink($dir."/".$object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}
?>