<?php
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=reporte_compras.csv');
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_compra_comp_xls.php');
	
	$fecha1 = $_GET['fecha1'];
	$fecha2 = $_GET['fecha2'];
	
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 300);
	
	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	// output the column headings
	fputcsv($output, array('ID COMPRA','NOMBRE PROVEEDOR','PRODUCTO', 'FECHA', 'IMPUESTO', 'TOTAL'));
	
	$qres = imprimir::select1($fecha1,$fecha2);
	
	foreach($qres as $qrow){
		
		$id_compra = $qrow->id_compra;
		$nombre_proveedor = $qrow->nombre;
		$nombre_producto = addslashes($qrow->nombre_producto);
		$fecha_proceso = $qrow->fecha_proceso;
		$impuesto = $qrow->impuesto_total;
		$total = $qrow->total;		
		
		$row = array($id_compra,$nombre_proveedor,$nombre_producto,$fecha_proceso,$impuesto,$total);
		
		fputcsv($output, $row);
		
	}
?>