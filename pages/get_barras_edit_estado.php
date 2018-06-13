<?php
	include('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;

	$rsd = getgen::get_barras_est($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
		$row_array['value'] = $rs->codigo_de_barra; 
		$row_array['codigo_interno'] = $rs->codigo_interno; 
		$row_array['nombre'] = $rs->nombre; 
		$row_array['codigo_de_barra'] = $rs->codigo_de_barra;
		$row_array['estado_med'] = $rs->estado_med;
		//echo "$mcodi|$mdesc|$mid|$mestado\n\n";
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

