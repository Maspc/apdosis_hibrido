<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_barras_com1($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
		$row_array['value'] = $rs->codigo_interno;
		$row_array['nombre'] = $rs->nombre;
		$row_array['forma_farma'] = $rs->forma_farma;
		$row_array['tipo_posologia'] = $rs->tipo_posologia;
		$row_array['tipo_de_dosis'] = $rs->tipo_de_dosis;
		$row_array['forma_descri'] = $rs->forma_descri;
		$row_array['posologia'] = $rs->posologia;
		$row_array['codigo_de_barra'] = $rs->codigo_de_barra;
		$row_array['tipo_impuesto'] = $rs->tipo_impuesto;
		$row_array['cantidad'] = $rs->cantidad;
		$row_array['costo_unitario'] = $rs->costo_unitario;
		//$mtipogru = $rs->tipo_de_grupo;
		//echo "$mcod|$mid|$mforma|$mposo|$mtipo|$mfdescr|$mposo2|$mdesc|$mtipoimp|$mcant|$mcosto \n";
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

