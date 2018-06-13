<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/reporte_compras.php');	
	
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	$id_proveedor = $_POST['proveedor'];
	$medicamento_id = $_POST['medicamento_id'];
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 300);
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
	->setSubject("Impresion Reporte de Compras")
	->setDescription("Cambios de costos")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");
	
	
	
	$con = 3;
	
	$hoja = 0;
	
	//while ($rows = mysql_fetch_array($res)) {
	$titulo = 'REPORTE DE INGRESOS Y SALIDAS DE MERCANCIA DE '.$fecha1.' A '.$fecha2;
	
	$objPHPExcel->createSheet($hoja);
	$objPHPExcel->setActiveSheetIndex($hoja)
	->setCellValue('A1', $titulo)
	->setCellValue('A2', 'FECHA')
	->setCellValue('B2', 'CODIGO')
	->setCellValue('C2', 'CODIGO DE BARRA')
	->setCellValue('D2', 'MEDICAMENTO')
	->setCellValue('E2', 'COSTO UNITARIO')
	->setCellValue('F2', 'CANTIDAD')
	->setCellValue('G2', 'PROVEEDOR');
	
	$qrow = repcompras::select1($fecha1,$fecha2,$id_proveedor,$medicamento_id);
	
	foreach($qrow as $qw){
		$medicamento_id1 = $qw->medicamento_id;
		$id_interno = $qw->id_interno;
		$codigo_de_barra = $qw->codigo_de_barra;
		$costo_compra = $qw->costo_compra;
		$cantidad = $qw->cantidad;
		$fecha = $qw->fecha;
		$nombre_proveedor = $qw->proveedor;
		
	    $medicamento = 'N/A';
		
		$rsd = repcompras::select2($medicamento_id1);
		foreach($rsd as $rs){
			$medicamento = $rs->nombre;
		}
		
		$celdaA = 'A'.$con;
		$celdaB = 'B'.$con;
		$celdaC = 'C'.$con;
		$celdaD = 'D'.$con;
		$celdaE = 'E'.$con;
		$celdaF = 'F'.$con;
		$celdaG = 'G'.$con;
		
		
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex($hoja)
		->setCellValue($celdaA, $fecha)
		->setCellValue($celdaB, $id_interno)
		->setCellValue($celdaC, $codigo_de_barra)
		->setCellValue($celdaD, $medicamento)
		->setCellValue($celdaE, $costo_compra)
		->setCellValue($celdaF, $cantidad)
		->setCellValue($celdaG, $nombre_proveedor);
		
		$objPHPExcel->getActiveSheet()->getCell('C'.$con)->setValueExplicit($codigo_de_barra, PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$con)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		
		$con = $con + 1;
		
	}
	
	
	$rango = 'A1:G'.$con;
	
	//Estilo de hoja
	
	$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(100);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	
	$objPHPExcel->getActiveSheet()->getStyle($rango)
	->getAlignment()->setWrapText(true); 
	
	$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray(
	array( 'borders' => array(
	'allborders'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
	)
	)
	);
	
	
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('REPORTE DE COMPRAS');
	//$hoja = $hoja + 1;
	
	
	
	
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="REPORTE_COMPRAS.xls"');
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
	
