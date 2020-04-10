<?php
/*
*	$src_dir = "backup";
*	$output_filename = "myZipArchive.zip";
*
*	newZipArchive($src_dir, $output_filename, true);
*/


/*
*	1)	$srcDirName		:	Directory path from which files are required to be added to zip archive
*							e.g. documents/myfiles/files_to_be_zipped
*							Note: Do not append the trailing '/' to the directory name
*
*	2)	$destFileName	:	Filename of the output file (with .zip extension)
*							e.g. documents/myfiles/ziparchives/newfile.zip
*							Note: .zip extension is required
*
*	3)	'/*.*' represents all the files are to be added to the archive.
*
*		If you want to specify particular file extensions which you want to add to the archive,
*		replace * with {sql,csv} (comma separated list of extensions)
*		e.g. glob($srcDirName.'/*.{sql,csv}', GLOB_BRACE)
*
*	4)	Instead of saving to the directory, if you want created zip archive to be delivered via download, supply the third parameter as 'true'
*		e.g. newZipArchive($src_dir, $output_filename, true);
*		This will force the browser to download the file.
*
*/
function newZipArchive($srcDirName, $destFileName, $download = false)
{
	$zip = new ZipArchive();
	$filename = $destFileName;
	
	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
		exit("Cannot open <$filename>\n");
	}
	
	//$zip->addFromString("testfilephp.txt", "#1 This is a test string added as testfilephp.txt.\n");
	//$zip->addFromString("testfilephp2.txt", "#2 This is a test string added as testfilephp2.txt.\n");
	
	foreach(glob($srcDirName.'/*.*', GLOB_BRACE) as $file)	// glob returns the array of filenames present in the directory
	{														// which match the pattern *.{sql,csv}
		$table = end(preg_split("/\/{1}/", $file));
		$zip->addFile($file, $table);
	}
	//echo "numfiles: " . $zip->numFiles . "\n";
	echo "status:" . $zip->status . "\n";
	$zip->close();
	
	function remove_rest($dir)
	{
		if(is_dir($dir))
		{
			$objects = scandir($dir);
			foreach ($objects as $object)
			{
				if ($object != "." && $object != "..")
				{
					if(pathinfo($dir."/".$object, PATHINFO_EXTENSION) == 'zip')
						continue;
					else
						unlink($dir."/".$object);						
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}
	
	remove_rest($srcDirName);
	
	if($download==true)
	{
		header('location: '.$filename);
		exit;
	}
}
?>