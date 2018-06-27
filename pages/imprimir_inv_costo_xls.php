<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_inv_costo_xls.php');
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 0);
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
	->setTitle("Costos")
	->setSubject("Impresion Reporte de Costos")
	->setDescription("Cambios de costos")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");
	
	
	
	$con = 3;
	
	$hoja = 0;
	
	//while ($rows = mysql_fetch_array($res)) {
	$titulo = 'COSTO TOTAL DE INVENTARIO';
	
	$objPHPExcel->createSheet($hoja);
	$objPHPExcel->setActiveSheetIndex($hoja)
	->setCellValue('A1', $titulo)
	->setCellValue('A2', 'MEDICAMENTO')
	->setCellValue('B2', 'CODIGO DE BARRA')
	->setCellValue('C2', 'CANTIDAD')
	->setCellValue('D2', 'COSTO UNITARIO')
	->setCellValue('E2', 'COSTO INVENTARIO')
	->setCellValue('F2', 'TIPO');
	
	
	
	$qres = imprimir::select1();
	
	foreach($qres as $qrow){
		
		$medicamento = $qrow->medicamento;
		$codigo_de_barra = $qrow->codigo_de_barra;
		$costo_unitario = $qrow->costo_unitario;
		$cantidad = $qrow->cantidad;
		$costo_total = $qrow->costo_total;
		$tipo_mercancia = $qrow->tipo_mercancia;
		
		if($tipo_mercancia == 1){
			$prod = 'MEDICAMENTO';
			}else if ($tipo_mercancia == 2){
		$prod = 'PRODUCTO';}
		else {
			$prod = 'INSUMO';
		}
		
		
		
		
		$celdaA = 'A'.$con;
		$celdaB = 'B'.$con;
		$celdaC = 'C'.$con;
		$celdaD = 'D'.$con;
		$celdaE = 'E'.$con;
		$celdaF = 'F'.$con;
		
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex($hoja)
		->setCellValue($celdaA, $medicamento)
		->setCellValue($celdaB, $codigo_de_barra)
		->setCellValue($celdaC, $cantidad)
		->setCellValue($celdaD, $costo_unitario)
		->setCellValue($celdaE, $costo_total)
		->setCellValue($celdaF, $prod);
		
		$objPHPExcel->getActiveSheet()->getCell('B'.$con)->setValueExplicit($codigo_de_barra, PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$con)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		
		$con = $con + 1;
		
		
		
		
		
		
		
		
	} 
	
	
	
	
	$rango = 'A1:E'.$con;
	
	//Estilo de hoja
	
	$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(100);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
	
	
	$objPHPExcel->getActiveSheet()->getStyle($rango)
    ->getAlignment()->setWrapText(true); 
	
	$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray(
	array( 'borders' => array(
	'allborders'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
	)
	)
	);
	
	
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('REPORTE DE COSTOS');
	//$hoja = $hoja + 1;
	
	
	
	
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="REPORTE_COSTOS.xls"');
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
	
