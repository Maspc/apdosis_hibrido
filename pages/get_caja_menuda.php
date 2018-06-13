<?php
	include('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
		
	$rsd = getgen::get_rubros($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
	    $row_array['value'] = $rs->descripcion;
		$row_array['codigo_rubro'] = $rs->codigo_rubro;
		$row_array['descripcion'] = $rs->descripcion;
		
		//echo "$mdesc|$mid\n";
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

