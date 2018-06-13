<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
		
	$rsd = getgen::get_medica3($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
	    $row_array['value'] = $rs->nombre; 
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
		$row_array['codigo_de_barra'] = $rs->codigo_de_barra;
		$row_array['precio_publico'] = $rs->precio_publico; 
		$row_array['porc_vario'] = $rs->porc_vario; 
		//echo "$mdesc|$mid|$mmin|$mmax|$mideal|$mmcrit|$mcantini|$mcantfact|$mcantdev|$mcostouni|$mpreciouni|$mporcgana|$mcodi|$mpreciopub|$mporcvario\n";
	    array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

