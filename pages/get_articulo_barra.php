<?php
	
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$rsd = getgen::get_barticulo1($q);
	$return_arr = array();
	
	foreach($rsd as $rs){
		$row_array['value'] = $rs->codigo_de_barra;
		$row_array['codigo_interno'] = $rs->codigo_interno;
		$row_array['nombre'] = $rs->nombre;
		$row_array['precio_unitario'] = $rs->precio_unitario;
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
		
		$grow = getgen::get_artgrupo1($grupo);
		if(count($grow) > 0){
			foreach($grow as $gw){
				$row_array['porcentaje'] = $gw->porcentaje;
			}
			}else{
			$row_array['porcentaje'] = 0;
		}
		
		array_push($return_arr,$row_array);
	}
	
	echo json_encode(array('suggestions' =>$return_arr));

	/*include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	$c = strtolower($_GET["json"]);
	if (!$q) return;
	
	$rsd = getgen::get_barticulo1($q);
	foreach($rsd as $rs){
		$mid = $rs->codigo_interno;
		$mdesc = $rs->nombre;
		$mprecio = $rs->precio_unitario;
		$mbarra = $rs->codigo_de_barra;
		$mtipo = $rs->tipo_de_dosis;
		$mfdescr = $rs->forma_descri;
		$mposo2 = $rs->posologia;
		$mgru = $rs->tipo_de_grupo;
		$mtipoimp = $rs->tipo_impuesto;
		$mdescmax = $rs->descuento_maximo;
		$mjubilado = $rs->jubilado;
		//$mtipogru = $rs->tipo_de_grupo;
		$grupo =$rs->grupo_medicamento;
		$mdesctotal =$rs->descuento_total;
		
		$grow = getgen::get_artgrupo1($grupo);
		if(count($grow) > 0){
			foreach($grow as $gw){
				$mdescdia = $gw->porcentaje;
			}
			}else{
			$mdescdia = 0;
		}		
		
		if(!empty($c)){
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
		}
	}*/
?>

