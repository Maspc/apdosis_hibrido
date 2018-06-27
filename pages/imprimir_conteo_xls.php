<?php
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=reporte_conteo.csv');
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_conteo_xls.php');
	
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 300);
	
	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	// output the column headings
	fputcsv($output, array('ID ANAQUEL', 'CODIGO DE BARRA', 'PRODUCTO',  'CANTIDAD'));
	
	$qres = imprimir::select1();
	
	foreach($qres as $qrow){
		
		$medicamento = $qrow->medicamento;
		$codigo_de_barra = $qrow->codigo_de_barra;
		$anaquel = $qrow->id_anaquel;
		$cantidad = $qrow->cantidad;
		
		
		
		$row = array($anaquel,$codigo_de_barra,$medicamento,$cantidad);
		
		
		fputcsv($output, $row);
		
		
	}
	
	
?>