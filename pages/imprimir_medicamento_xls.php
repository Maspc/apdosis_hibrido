<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/imprimir_medicamento_xls.php');
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Europe/London');
	
	if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
	
	/** Include PHPExcel */
	require_once 'Classes/PHPExcel.php';
	
	
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Apdosis")
	->setLastModifiedBy("Apdosis")
	->setTitle("Medicamentos")
	->setSubject("Impresion de Medicamentos")
	->setDescription("Medicamentos Apdosis")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");
	
	$hoja = 0;
	
	$con = 3;
	
	$titulo = 'Listado de Medicamentos';
	
	$objPHPExcel->createSheet($hoja);
	$objPHPExcel->setActiveSheetIndex($hoja)
	->setCellValue('A1', $titulo)
	->setCellValue('A2', 'ARTÍCULO')
	->setCellValue('B2', 'CODIGO DE BARRA');
	
	$rows = imprimedxls::select1();
	foreach($rows as $rw){
		$celdaA = 'A'.$con;
		$celdaB = 'B'.$con;
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex($hoja)
		->setCellValue($celdaA, $rw->medicamento)
		->setCellValue($celdaB, $rw->codigo_de_barra);
		
		$objPHPExcel->getActiveSheet()->getCell('B'.$con)->setValueExplicit($rw->codigo_de_barra, PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$con)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		
		$con = $con + 1;
	}
	
	$rango = 'A1:B'.$con;
	
	//Estilo de hoja
	
	$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(100);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getStyle($rango)
    ->getAlignment()->setWrapText(true); 
	
	$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray(
	array( 'borders' => array(
	'allborders'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
	)
	)
	);
	
	
	// Rename worksheet
	$titulo_hoja = 'Medicamentos';
	$objPHPExcel->getActiveSheet()->setTitle($titulo_hoja);
	
	
	
	
	
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="MEDICAMENTOS.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');
	
	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
exit;