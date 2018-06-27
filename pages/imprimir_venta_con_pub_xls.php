<?php
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=reporte_ventas.csv');
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_venta_con_pub_xls.php');
	
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
	fputcsv($output, array('ID INTERNO','EQUIPO FISCAL','FACTURA FISCAL', 'FECHA', 'IDENTIFICACION', 'NOMBRE', 'TOTAL', 'IMPUESTO'));
	
	$qres = imprimir::select1($fecha1,$fecha2);
	
	foreach($qres as $qrow){		
		$fu = $qrow->FA;
		$id_paciente = $qrow->id_paciente;
		$factura_fiscal = $qrow->factura_fiscal;
		$fecha = $qrow->fecha;
		$nombre_paciente = $qrow->nombre_paciente;
		$total = $qrow->total;
		$factura = $qrow->factura;
		$equipo_fiscal = $qrow->equipo_fiscal;
		$tipo = $qrow->tipo;
		
		
		if($tipo == 1){
			
			$fres = imprimir::select2($factura);
			foreach($fres as $frow){
				$impuesto = $frow->impuesto;
			}
			
			} else if ($tipo == 2){
			
			$fres = imprimir::select3($factura);
			foreach($fres as $frow){
				$impuesto = $frow->impuesto;
			}	
			
		}
		
		
		
		$row = array($factura,$equipo_fiscal,$factura_fiscal,$fecha,$id_paciente,$nombre_paciente,$total, $impuesto);
		
		fputcsv($output, $row);
		
	}
	
	
?>