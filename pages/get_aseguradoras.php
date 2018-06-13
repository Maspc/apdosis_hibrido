<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_asegura1($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
		$row_array['value'] = $rs->descripcion;
		$row_array['codigo_aseg'] = $rs->codigo_aseg;
		$row_array['descripcion'] = $rs->descripcion;
		$row_array['descuento_maximo'] = $rs->descuento_maximo;
		
		array_push($return_arr,$row_array);
	}
	
	echo json_encode(array('suggestions' =>$return_arr));
?>

