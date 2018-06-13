<?php
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=reporte_ventas.csv');
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/reporte_ventas.php');	
	
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	$id_proveedor = $_POST['proveedor'];
	$medicamento_id = $_POST['medicamento_id'];
	$codigo_cliente = $_POST['codigo_cliente'];
	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 300);
	
	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	// output the column headings
	fputcsv($output, array('FECHA','CODIGO CLIENTE', 'NOMBRE CLIENTE', 'CODIGO', 'CODIGO DE BARRA', 'PRODUCTO', 'COSTO UNITARIO', 'CANTIDAD','PRECIO UNITARIO', 'IMPUESTO', 'PRECIO VENTA', 'PROVEEDOR'));
	
	$qrow = repventas::select1($fecha1,$fecha2,$medicamento_id,$codigo_cliente);
	
	foreach($grow as $gw){
		$medicamento_id1 = $gw->medicamento_id;
		$medicamento = $gw->medicamento;
		$factura = $gw->factura;
		$codigo_de_barra = $gw->codigo_de_barra;
		$costo_unitario = $gw->costo_unitario;
		$cantidad = $gw->cantidad;
		$precio_unitario = $gw->precio_unitario;
		$impuesto = $gw->impuesto;
		$precio_venta = $gw->precio_venta;
		$fecha = $gw->fecha;
		$codigo_cliente = $gw->codigo_cliente;
		$nombre_cliente = $gw->nombre_cliente;
		
		$qrow = repventas::select2($medicamento_id1);
		
		foreach($grow as $gw1){
			$id_proveedor_1 = $gw1->id_proveedor; 
			$nombre_proveedor = $gw1->nombre;
			
			if($id_proveedor == $id_proveedor_1 or $id_proveedor == '%'){
				
				
				$row = array($fecha,$codigo_cliente,$nombre_cliente,$factura,$codigo_de_barra,$medicamento,$costo_unitario,$cantidad,$precio_unitario,$impuesto,$precio_venta,$nombre_proveedor);
				
				
				fputcsv($output, $row);
				
			}
		}
	}	
	
?>