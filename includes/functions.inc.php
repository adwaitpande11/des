<?php
function req($element_name)
{
    return $_REQUEST[$element_name];
}

function print_array($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function getRows($connection, $query)
{
   $resultset = array();
   $result = mysqli_query($connection, $query);
   $result_rows = mysqli_num_rows($result);
      
   if($result_rows == 0)
   {
       return 0;
   }
   else
   {
       while(($row = mysqli_fetch_assoc($result)))
       {
           $resultset[] = $row;
       }
       return $resultset;
   }
}


function getRow($connection, $query)
{
   $result = mysqli_query($connection, $query);
   $result_rows = mysqli_num_rows($result);
   if($result_rows == 0)
   {
       return 0;
   }
   else
   {
       return mysqli_fetch_assoc($result);
   }
}

function getOne($connection, $query)
{
   $result = mysqli_query($connection, $query);
   $result_rows = mysqli_num_rows($result);
   if($result_rows == 0)
   {
       return 0;
   }
   else
   {
       $value = mysqli_fetch_row($result);
       return $value[0];
   }
}

function insert($connection, $tablename, $arr)
{
	$query = "INSERT INTO `".$tablename."`(";
	
	$i = 0;
	foreach($arr as $key => $value)
	{
		$i++;
		$query .= $key;
		if($i == count($arr))
			break;
		
		$query .= ", ";
	}
	$query .= ") VALUES(";
	
	$i = 0;
	foreach($arr as $key => $value)
	{
		$i++;
		$query .= "'".mysqli_real_escape_string($connection, $value)."'";
		if($i == count($arr))
			break;
		
		$query .= ", ";
	}
	$query .= ")";
	
	if(mysqli_query($connection, $query))
	{
		$res = mysqli_query($connection, 'SHOW COLUMNS FROM `'.$tablename.'`');
		while($row = mysqli_fetch_assoc($res))
		{
			if ($row['Extra'] == 'auto_increment')
				$lastIdGenerated = getOne($connection, "SELECT MAX(".$row['Field'].") FROM `".$tablename."`");
		}
		return $lastIdGenerated;
	}
	else
	{
		return 0;
	}
}

function update($connection, $tablename, $arr, $where)
{
	$query = "UPDATE `".$tablename."` SET ";
	
	$i = 0;
	foreach($arr as $key => $value)
	{
		$i++;
		$query .= $key."='".mysqli_real_escape_string($connection, $value)."'";
		if($i == count($arr))
			break;
		
		$query .= ", ";
	}
	$query .= " WHERE ".$where;
	
	if(mysqli_query($connection, $query))
	{
		return true;
	}
	else
	{
		return 0;
	}
}

function delete($connection, $query)
{
   return mysqli_query($connection, $query);
}

function location($location)
{
	header("location: ".$location);
	exit;
}

function currency_format($num)
{
	return number_format($num);
}

function empty_dir($dir)
{
	if(is_dir($dir))
	{
		$objects = scandir($dir);
		foreach ($objects as $object)
		{
			if ($object != "." && $object != "..")
			{
				if (filetype($dir."/".$object) == "dir") 
					rrmdir($dir."/".$object); 
				else
					unlink($dir."/".$object);
			}
		}
		reset($objects);
	}
}

function rrmdir($dir)
{
	empty_dir($dir);
	rmdir($dir);
}

function get_file_extension($filename)
{
	return ".".end(explode(".", $filename));
}

function call_api($method, $url, $is_json = false, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
            {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                if($is_json)
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "desapiuser:Predict#123");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
?>