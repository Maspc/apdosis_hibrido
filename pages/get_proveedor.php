<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_provee2($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
	    $row_array['value'] = $rs->nombre;
		$row_array['id_proveedor'] = $rs->id_proveedor;
		$row_array['nombre'] = $rs->nombre;
		//echo "$mdesc|$mid\n";
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

