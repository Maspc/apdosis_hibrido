<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_historial_farma_xls_prh.php');
	$userid = $_GET->userid;
	$historia = $_POST->historia;
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('America/Panama');
	
	
	
	
	if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
	
	/** Include PHPExcel */
	require_once 'Classes/PHPExcel.php';
	
	
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Apdosis")
	->setLastModifiedBy("Apdosis")
	->setTitle("Banco de Medicamentos")
	->setSubject("Impresion de Banco de Medicamentos")
	->setDescription("Cierre de banco de medicamentos para la nave")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");
	
	
	
	
	$res = dimprimir_hfxp::select1($historia);
	
	//busco los meses
	foreach($res as $rows2){
		
		
		$gres2 = dimprimir_hfxp::select2($historia,$rows2->tratamiento);
		
		foreach($gres2 as $grow2){
			$fecha_ingreso = $rows2->fecha_inicio;
			$mes_inicio = date('m', strtotime($fecha_ingreso)); 
			$mes_fin = date('m', strtotime($grow2->fecha_fin));
			
		}
		
		
		$total_meses = ($mes_fin - $mes_inicio) + 1;
		
		$con = 5;
		
	}
	

	
	$res3 = dimprimir_hfxp::select3($historia);
	
	$hoja = 0;
	
	foreach($res3 as $rows){
		
		while ($hoja < $total_meses) {
			
			$mes = $mes_inicio + $hoja;
			
			$objPHPExcel->createSheet($hoja);
			$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue('C4', 1 )
			->setCellValue('D4', 2 )
			->setCellValue('E4', 3 )
			->setCellValue('F4', 4 )
			->setCellValue('G4', 5 )
			->setCellValue('H4', 6 )
			->setCellValue('I4', 7 )
			->setCellValue('J4', 8 )
			->setCellValue('K4', 9 )
			->setCellValue('L4', 10 )
			->setCellValue('M4', 11 )
			->setCellValue('N4', 12 )
			->setCellValue('O4', 13 )
			->setCellValue('P4', 14 )
			->setCellValue('Q4', 15 )
			->setCellValue('R4', 16 )
			->setCellValue('S4', 17 )
			->setCellValue('T4', 18 )
			->setCellValue('U4', 19 )
			->setCellValue('V4', 20 )
			->setCellValue('W4', 21 )
			->setCellValue('X4', 22 )
			->setCellValue('Y4', 23 )
			->setCellValue('Z4', 24 )
			->setCellValue('AA4', 25 )
			->setCellValue('AB4', 26 )
			->setCellValue('AC4', 27 )
			->setCellValue('AD4', 28 )
			->setCellValue('AE4', 29 )
			->setCellValue('AF4', 30 )
			->setCellValue('AG4', 31 );
			
			
			//armo los titulos del encabezado
			
			$objPHPExcel->setActiveSheetIndex($hoja)
          	->setCellValue('AH3', 'TOTAL');
			
			
			
			
			$fecha_ingreso = $rows->fecha_inicio;
			$nombre_paciente = $rows->nombre_paciente;
			$peso = $rows->peso;
			$edad = $rows->edad;
			
			//inserto los encabezados
			
			$celdaB2 = "Nombre: ".$nombre_paciente."\nHistoria: ".$historia."\nFecha Ingreso: ".$fecha_ingreso."\nPeso: ".$peso."\nEdad: ".$edad;
			
			
			$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue('B2', $celdaB2 );
			
			$objPHPExcel->getActiveSheet()->mergeCells('C2:AH2');
			$objPHPExcel->getActiveSheet()->getStyle('C2:AH2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			
			
			
			//borro la temporal de medicamentos
			

		
		dimprimir_hfxp::delete1($userid);
			
			$res1 = dimprimir_hfxp::select4($historia,$rows->tratamiento,$mes);
			
			foreach($res1 as $rows1){
				
				//inserto en tabla temporal de perfiles
				
				dimprimir_hfxp::insert1($rows1->medicamento_id,$rows1->cantidad,$rows1->fecha_proceso,$userid);
				
			}
			
			
			$rres = dimprimir_hfxp::select5($userid);
			
			//inserto los nombres de los medicamentos del mes
			
			$conmed = 5;
			
			$in = 1;
			
			foreach($rres as $rrow){				
				$objPHPExcel->setActiveSheetIndex($hoja)
				->setCellValue('B'.$conmed, $rrow->nombre )
				->setCellValue('A'.$conmed, $in );
				
				//${'varmed_'.$conmed} = $rrow->medicamento_id.' - '.$conmed;
				//$varmed[$rrow->medicamento_id] = $rrow->medicamento_id.' - '.$conmed;
				$varmed[$rrow->medicamento_id] = $conmed;
				$conmed = $conmed + 1; 
				$in = $in + 1;
				
			}
			
			
		
			$gres = dimprimir_hfxp::select6($userid);
			
			foreach($gres as $grow){
				$poscan = $varmed[$grow->medicamento_id]; 
				
				$dia_mes = date('d', strtotime($grow->fecha_proceso)); 
				$mes_nom = date('F Y', strtotime($grow->fecha_proceso)); 
				
				if ($dia_mes == 1) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('C'.$poscan, $grow->cantidad );
					} else if ($dia_mes == 2) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('D'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 3) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('E'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 4) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('F'.$poscan, $grow->cantidad );
					}  else if ($dia_mes == 5) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('G'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 6) { 
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('H'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 7) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('I'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 8) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('J'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 9) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('K'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 10) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('L'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 11) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('M'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 12) {  
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('N'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 13) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('O'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 14) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('P'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 15) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('Q'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 16) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('R'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 17) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('S'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 18) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('T'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 19) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('U'.$poscan, $grow->cantidad );    
					}  else if ($dia_mes == 20) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('V'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 21) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('W'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 22) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('X'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 23) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('Y'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 24) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('Z'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 25) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('AA'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 26) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('AB'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 27) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('AC'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 28) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('AD'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 29) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('AE'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 30) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('AF'.$poscan, $grow->cantidad );  
					}  else if ($dia_mes == 31) {
					$objPHPExcel->setActiveSheetIndex($hoja)
					->setCellValue('AG'.$poscan, $grow->cantidad );  
				}
				
			}
			
			$conmed2 = $conmed - 1;
			
			$rango = 'A1:AH'.$conmed2;
			
			for ($i = 5; $i <= $conmed2; $i++) {
				
				
				
				$objPHPExcel->setActiveSheetIndex($hoja)
				->setCellValue('AH'.$i, '=SUM(B'.$i.':AG'.$i.')');
				
			}
			
			
			
			//Estilo de hoja
			
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
			
			
			
			$objPHPExcel->getActiveSheet()->getStyle($rango)->getFont()->setSize(9);
			
			$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(4.5);
			$objPHPExcel->getActiveSheet()->getStyle($rango)
			->getAlignment()->setWrapText(true); 
			
			$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray(
			array( 'borders' => array(
			'allborders'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
			)
			);
			
			
			// Rename worksheet
			$titulo_hoja = $mes_nom;
			$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue('C2', 'PERFIL DE MEDICAMENTOS / CRONOGRAMA DE '.$mes_nom);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:AH1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:AH1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
			$objPHPExcel->getActiveSheet()->getStyle('C2:AH2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);			
			
			$objPHPExcel->getActiveSheet()->setTitle($titulo_hoja);
			$hoja = $hoja + 1;
			
		}
	}
	
	
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="PERFIL.xls"');
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