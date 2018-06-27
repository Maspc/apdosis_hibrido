<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_barras_edit_inv($q);
	$return_arr = array();
		
	foreach($rsd as $rs){
		$row_array['value'] = $rs->codigo_de_barra;
		$row_array['codigo_interno'] = $rs->codigo_interno; 
		$row_array['nombre'] = $rs->nombre; 
		$row_array['inventario_minimo'] = $rs->inventario_minimo; 
		$row_array['inventario_maximo'] = $rs->inventario_maximo; 
		$row_array['inventario_ideal'] = $rs->inventario_ideal; 
		$row_array['inventario_critico'] = $rs->inventario_critico; 
		$row_array['cantidad_inicial'] = $rs->cantidad_inicial; 
		$row_array['cantidad_factura'] = $rs->cantidad_factura; 
		$row_array['cantidad_devolucion'] = $rs->cantidad_devolucion; 
		$row_array['costo_unitario'] = $rs->costo_unitario; 
		$row_array['precio_unitario'] = $rs->precio_unitario; 
		$row_array['porc_ganancia'] = $rs->porc_ganancia;
		$row_array['cantidad_existencia'] = $rs->cantidad_existencia;
		$row_array['precio_unitario_pub'] = $rs->precio_unitario_pub; 	
		//echo "$mcodi|$mdesc|$mid|$mmin|$mmax|$mideal|$mmcrit|$mcantini|$mcantfact|$mcantdev|$mcostouni|$mpreciouni|$mporcgana|$mexist|$mpreciounipub\n";
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

