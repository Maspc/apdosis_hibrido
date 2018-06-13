<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_medica2($q);
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
		$row_array['tipo_grupo'] = $rs->tipo_grupo;
		$row_array['multiple_principio'] = $rs->multiple_principio;
		$row_array['grupo_medicamento'] = $rs->grupo_medicamento;
		$row_array['volumen'] = $rs->volumen;
		$row_array['tipo_volumen'] = $rs->tipo_volumen;
		$row_array['vol_desc'] = $rs->vol_desc;
		$row_array['dosis_desc'] = $rs->dosis_desc;
		$row_array['precio_unitario'] = $rs->precio_unitario;
		//echo "$mdesc|$mid|$mforma|$mposo|$mtipo|$mfdescr|$mposo2|$mcodi|$mgru|$mprin|$mgrupo|$mvolu|$mtipovol|$mvoldesc|$mdosisdesc|$mprecio\n";
	    array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

