<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_medicamento_union($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
		$row_array['codigo_interno'] = $rs->codigo_interno; 
		$row_array['value'] = $rs->nombre; 
		//echo "$mdesc|$mid\n";
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

