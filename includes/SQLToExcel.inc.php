<?php
require_once 'classes/PHPExcel.php';
include("includes/functions.inc.php");
function SQLToExcel($output_file_name, $mysql_connection_variable, $mysql_query, $sheet_name = false)
{
	$excelObject = new PHPExcel();
	
	$tab_count = count($mysql_query);
	
	if($tab_count > 1)
	{
		for($i = 1; $i < $tab_count; $i++)
		{
			$excelObject->createSheet($i);
		}
	}
	
	for($sheetIndex = 0; $sheetIndex < $tab_count; $sheetIndex++)
	{	
		$dataset = getRows($mysql_connection_variable, $mysql_query[$sheetIndex]);
		$column_count = count($dataset[0]);
		$column_name = array_keys($dataset[0]);
	
		$activeSheet = $excelObject->setActiveSheetIndex($sheetIndex);
		if($sheet_name!=false)$activeSheet->setTitle($sheet_name[$sheetIndex]);
		
		$init_excel_column = 'A';
		foreach($column_name as $each)
		{
			$activeSheet->setCellValue($init_excel_column.'1', $each);
			$init_excel_column++;
		}
		
		$rownum = 2;
		foreach($dataset as $each)
		{
			$init_excel_column = 'A';
			for($i = 0; $i < $column_count; $i++)
			{
				$activeSheet->setCellValue(''.$init_excel_column.''.$rownum, $each[$column_name[$i]]);
				$init_excel_column++;
			}
			$rownum++;
		}
		
		unset($dataset);
		unset($column_count);
		unset($column_name);
	}
	
	$excelObject->setActiveSheetIndex(0);
	
	$objWriter = PHPExcel_IOFactory::createWriter($excelObject, 'Excel2007');
	$objWriter->save($output_file_name);
	
	return true;
}
?>