<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_articulo_barra($q);
	$return_arr = array();
		
	foreach($rsd as $rs){
		$row_array['codigo_interno'] = $rs->codigo_interno;
		$row_array['nombre'] = $rs->nombre;
		$row_array['precio_unitario_pub'] = $rs->precio_unitario_pub;
		$row_array['value'] = $rs->codigo_de_barra;
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
		
		$gres=getgen::get_articulo_barra_select1($grupo);
		$gnum = count($gres);
		
		if($gnum > 0){
		    foreach($gres as $grow){
				$row_array['porcentaje'] = $grow->porcentaje;
			}
			}else{
			$row_array['porcentaje'] = 0;
		}
		
		
		/*if(!empty($c)){
			echo json_encode( array( 
			"mbarra"=>$mbarra ,
			"mid"=>$mid ,
			"mdesc"=>$mdesc ,
			"mprecio"=>$mprecio ,
			"mtipoimp"=>$mtipoimp ,
			"mdescmax"=>$mdescmax ,
			"mjubilado"=>$mjubilado ,
			"mdescdia"=>$mdescdia ,
			"mdesctotal"=>$mdesctotal 
			) );
			}else{
			echo "$mbarra|$mid|$mdesc|$mprecio|$mtipoimp|$mdescmax|$mjubilado|$mdescdia|$mdesctotal\n";
		}*/
		array_push($return_arr,$row_array);
	}
	echo json_encode(array('suggestions' =>$return_arr));
?>

