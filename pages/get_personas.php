<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;	
	
	$rsd = getgen::get_personas1($q);
	$return_arr = array();
	foreach($rsd as $rs){
		$row_array['value'] = $rs->id_cliente;
		$row_array['id_cliente'] = $rs->id_cliente;
		$row_array['nombre_completo']= $rs->nombre_completo;
		$row_array['apellido'] = $rs->apellido;
		$row_array['identificacion'] = $rs->identificacion;
		$row_array['telefono'] = $rs->telefono;
		$row_array['saldo_actual'] = $rs->saldo_actual;
		$row_array['descuento_maximo'] = $rs->descuento_maximo;
		$row_array['tipo_cliente'] = $rs->tipo_cliente;
		$row_array['limite_credito'] = $rs->limite_credito;
		
		array_push($return_arr,$row_array);
		
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>