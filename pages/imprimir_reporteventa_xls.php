<?php
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=reporte_ventas_detalle.csv');
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/reporte_ventasxls.php');
	
	if($_POST['tiempo_inicial'] == 2){
		$hora_inicial = $_POST['hora_inicial'] + 12;
		} else {
		$hora_inicial = $_POST['hora_inicial'];
	}
	
	if($_POST['tiempo_final'] == 2){
		$hora_final = $_POST['hora_final'] + 12;
		} else {
		$hora_final = $_POST['hora_final'];
	}
    //Title
	//$fecha1 = $_POST['fecha1'];
	//    $fecha2 = $_POST['fecha2'];
	
	$fecha1 = $_POST['fecha1'].' '.$hora_inicial.':'.$_POST['minuto_inicial'];
	$fecha2 = $_POST['fecha2'].' '.$hora_final.':'.$_POST['minuto_final'];
	
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 300);
	
	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	
	fputcsv($output, array('FECHA', 'HORA', 'USUARIO', 'CAJA', 'SEC.', 'CODIGO DE BARRA','PRODUCTO', 'GRUPO', 'SUB GRUPO', 'PROVEEDOR', 'CANTIDAD', 'PRECIO', 'DESCUENTO', 'IMPUESTO'));
		
	$rows = repventasxls::select1($fecha1,$fecha2);
	foreach($rows as $rw){
		$fecha = $rw->fecha;
		$hora = $rw->hora;
		$ordenado_por = $rw->ordenado_por;
		$caja_id = $rw->caja_id;
		$factura = $rw->factura;
		$codigo_de_barra = $rw->codigo_de_barra;
		$medicamento = $rw->medicamento;
		$grupo_medicamento = $rw->grupo_medicamento;
		$sub_grupo = $rw->sub_grupo;
		$cantidad = $rw->cantidad;
		$precio_unitario = $rw->precio_unitario;
		$descuento_unitario = $rw->descuento_unitario;
		$impuesto = $rw->impuesto;
		
		
		/*  $g = "select a.id_proveedor, b.nombre, max(fecha_creacion) from medicamento_x_proveedor a, proveedor b where a.medicamento_id = '".$rw->medicamento_id."' and a.id_proveedor = b.id_proveedor group by a.id_proveedor, b.nombre";*/
				
	
		$grow = repventasxls::select2($rw->medicamento_id);
		if(count($grow) > 0){
			foreach($grow as $gw){
				$proveedor = $gw->nombre;
			}
			
			}else {
			$proveedor = ' ';
		}
		
		
		$row = array($fecha,$hora,$ordenado_por,$caja_id,$factura,$codigo_de_barra,$medicamento,$grupo_medicamento,$sub_grupo,$proveedor,$cantidad,$precio_unitario,$descuento_unitario,$impuesto);
		
		
		fputcsv($output, $row);
		
	}
	
	
?>