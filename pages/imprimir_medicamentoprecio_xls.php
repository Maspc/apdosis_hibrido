<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/imprimir_medicamentoprecio_xls.php');
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '2048M');
	set_time_limit(300);
	date_default_timezone_set('Europe/London');
	
	if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
	
	/** Include PHPExcel */
	require_once './Classes/PHPExcel.php';
	
	
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
	
	$titulo = 'Listado de Productos';
	
	$objPHPExcel->createSheet($hoja);
	$objPHPExcel->setActiveSheetIndex($hoja)
	->setCellValue('A1', $titulo)
	->setCellValue('A2', 'ARTÍCULO')
	->setCellValue('B2', 'CODIGO DE BARRA')
	->setCellValue('C2', 'GRUPO')
	->setCellValue('D2', 'SUB GRUPO')
	->setCellValue('E2', 'COSTO')
	->setCellValue('F2', 'PRECIO')			
	->setCellValue('G2', 'EXIST BODEGA')
	->setCellValue('H2', 'EXIST. TIENDA')
	->setCellValue('I2', 'TIPO')
	->setCellValue('J2', 'PROVEEDOR');
	
	$rows = imprimed::select1();
	foreach($rows as $rw){
		$celdaA = 'A'.$con;
		$celdaB = 'B'.$con;
		$celdaC = 'C'.$con;
		$celdaD = 'D'.$con;
		$celdaE = 'E'.$con;
		$celdaF = 'F'.$con;
		$celdaG = 'G'.$con;
		$celdaH = 'H'.$con;
		$celdaI = 'I'.$con;
		$celdaJ = 'J'.$con;		
		
		$grow = imprimed::select2($rw->codigo_interno);
		
		if(count($grow) > 0){
			foreach($grow as $gw){
				$proveedor = $gw->nombre;
			}			
			}else {
			$proveedor = ' ';
		}
		
		$cantidad_tienda = 0;		
		
		$frow = imprimed::select3($rw->codigo_interno);
		
		foreach($frow as $fw){
			$cantidad_tienda = $fw->cantidad_inicial;
			}		
		
		if ($rw->tipo_mercancia == 1){
			$tipo = 'MEDICAMENTO';	
			} else {
			$tipo = 'PRODUCTO';
		}
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex($hoja)
		->setCellValue($celdaA, $rw->medicamento)
		->setCellValue($celdaB, $rw->codigo_de_barra)
		->setCellValue($celdaC, $rw->grupo)
		->setCellValue($celdaD, $rw->sub_grupo)
		->setCellValue($celdaE, $rw->costo_unitario)
		->setCellValue($celdaF, $rw->precio_unitario)
		->setCellValue($celdaG, $rw->cantidad)
		->setCellValue($celdaH, $cantidad_tienda)
		->setCellValue($celdaI, $tipo)
		->setCellValue($celdaJ, $proveedor);
		
		$objPHPExcel->getActiveSheet()->getCell('B'.$con)->setValueExplicit($rw->codigo_de_barra, PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$con)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		
		$con = $con + 1;
	}
	
	$rango = 'A1:J'.$con;
	
	//Estilo de hoja
	
	$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(100);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getStyle($rango)
    ->getAlignment()->setWrapText(true); 
	
	$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray(
	array( 'borders' => array(
	'allborders'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
	)
	)
	);
	
	
	// Rename worksheet
	$titulo_hoja = 'Articulos';
	$objPHPExcel->getActiveSheet()->setTitle($titulo_hoja);
	
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="LISTADO_ARTICULOS.xls"');
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
	
