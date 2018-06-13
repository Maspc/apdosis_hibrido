<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;

	$rsd = getgen::get_medicae2($q);
	$return_arr = array();
	foreach($rsd as $rs){
	    $row_array['value'] = $rs->nombre; 
		$row_array['codigo_interno'] = $rs->codigo_interno; 
		$row_array['nombre'] = $rs->nombre; 
		$row_array['forma_farma'] = $rs->forma_farma; 
		$row_array['tipo_posologia'] = $rs->tipo_posologia; 
		$row_array['tipo_de_dosis'] = $rs->tipo_de_dosis; 
		$row_array['forma_descri'] = $rs->forma_descri; 
		$row_array['posologia'] = $rs->posologia; 
		$row_array['codigo_de_barra'] = $rs->codigo_de_barra; 
		$row_array['precio_unitario'] = $rs->precio_unitario; 
		$row_array['nombre_comercial'] = $rs->nombre_comercial; 
		$row_array['nombre_generico'] = $rs->nombre_generico; 
		$row_array['descr_presentacion'] = $rs->descr_presentacion; 
		$row_array['presentacion'] = $rs->presentacion; 
		$row_array['cantidad_x_empaque'] = $rs->cantidad_x_empaque; 
		$row_array['volumen'] =  $rs->volumen; 
		$row_array['descr_fabricante'] = $rs->descr_fabricante; 
		$row_array['fabricante'] = $rs->fabricante; 
		$row_array['costo_unitario'] = $rs->costo_unitario; 
		$row_array['precio_unitario'] = $rs->precio_unitario; 
		$row_array['costo_caja'] = $rs->costo_caja; 
		$row_array['precio_caja'] = $rs->precio_caja; 
		$row_array['cantidad_inicial'] = $rs->cantidad_inicial; 
		$row_array['tipo_de_dosis'] = $rs->tipo_de_dosis; 
		$row_array['descr_tipo_dosis'] = $rs->descr_tipo_dosis; 
		$row_array['antibiotico'] = $rs->antibiotico; 
		$row_array['narcotico'] = $rs->narcotico; 
		$row_array['preparacion'] = $rs->preparacion; 
		$row_array['permite_devol'] = $rs->permite_devol; 
		$row_array['codigo_proveedor'] = $rs->codigo_proveedor; 
		$row_array['tipo_volumen'] = $rs->tipo_volumen;
		$row_array['grupo_medicamento'] = $rs->grupo_medicamento;
		$row_array['multiple_principio'] = $rs->multiple_principio;
		$row_array['tipo_impuesto'] = $rs->tipo_impuesto;
		$row_array['precio_publico'] = $rs->precio_publico;
		$row_array['importacion'] = $rs->importacion;
		$row_array['jubilado'] = $rs->jubilado;
		$row_array['descuento_total'] = $rs->descuento_total;
		$row_array['ubicacion'] = $rs->ubicacion;
		//echo "$mdesc|$mid|$mforma|$mposo|$mtipo|$mfdescr|$mposo2|$mcodi|$mpre|$mcom|$mgen|$mpres|$mcodpres|$mcantemp|$mvol|$mfab|$mcodfab|$mcosuni|$mpreuni|$mcoscaja|$mprecaja|$mcantini|$mtipodosis|$mtipodesc|$manti|$mnarco|$mprepa|$mdevol|$mcodprov|$mtipovol|$mgrupomed|$mmultiprin|$mtipoim|$mpreciop|$mimportacion|$mjubilado|$mdesctotal|$mubica\n";
	    array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

