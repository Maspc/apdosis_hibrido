<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_articulo($q);
	$return_arr = array();
		
	foreach($rsd as $rs){
		$row_array['codigo_interno'] = $rs->codigo_interno;
		$row_array['value'] = $rs->nombre;
		$row_array['precio_unitario_pub'] = $rs->precio_unitario_pub;
		$row_array['codigo_de_barra'] = $rs->codigo_de_barra;
		$row_array['tipo_de_dosis'] = $rs->tipo_de_dosis;
		$row_array['forma_descri'] = $rs->forma_descri;
		$row_array['posologia'] = $rs->posologia;
		$row_array['tipo_de_grupo'] = $rs->tipo_de_grupo;
		$row_array['tipo_impuesto'] = $rs->tipo_impuesto;
		$row_array['descuento_maximo'] = $rs->descuento_maximo;
		$row_array['jubilado'] = $rs->jubilado;
		//$mtipogru = $rs->tipo_de_grupo;
		$row_array['grupo_medicamento'] =$rs->grupo_medicamento;
		$row_array['descuento_total'] =$rs->descuento_total;
		
		
		$gres=getgen::get_articulo_select1($grupo);
		$gnum = count($gres);
		if($gnum > 0){
		    foreach($gres as $grow){
				$row_array['porcentaje'] = $grow->porcentaje;
			}
			}else{
			$row_array['porcentaje'] = 0;
		}
		
		//echo "$mdesc|$mid|$mbarra|$mprecio|$mtipoimp|$mdescmax|$mjubilado|$mdescdia|$mdesctotal\n";
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

