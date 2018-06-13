<?php
	include ('./clases/session.php');
	require_once('../modulos/get_general.php');
	
	$q = strtolower($_GET["q"]);
	$bodega_origen = $_GET['bodega_origen'];
	$bodega_destino = $_GET['bodega_destino'];
	if (!$q) return;

	$rsd = getgen::get_barrab1($bodega_origen,$q);
	foreach($rsd as $rs){
		$mid = $rs->codigo_interno;
		$mdesc = $rs->nombre;
		$mforma = $rs->forma_farma;
		$mposo = $rs->tipo_posologia;
		$mtipo = $rs->tipo_de_dosis;
		$mfdescr = $rs->forma_descri;
		$mposo2 = $rs->posologia;
		$mgru = $rs->tipo_de_grupo;
		$mtipoimp = $rs->tipo_impuesto;
		$mcod = $rs->codigo_de_barra;
		$mcantmax = $rs->cant_max_prov;
		//$mtipogru = $rs->tipo_de_grupo;
		
		$cantori = 0;
		
		$rrow = getgen::get_medicab1_slt1($mid,$bodega_origen);
		foreach($rrow as $rrw){
			$cantori = $rrw->cantidad;
		}		
		
		$rirow = getgen::get_medicab1_slt2($mid,$bodega_destino);
		
		if(count($rirow) > 0){
			foreach($rirow as $riw){
				$cantdes = $riw->cantidad;
				$invideal = $riw->inventario_ideal;
			}
			
			} else {
			$cantdes = 'No existe!';
			$invideal = 0;
		}
		
		
		
		echo "$mcod|$mid|$mforma|$mposo|$mtipo|$mfdescr|$mposo2|$mdesc|$mtipoimp|$mcantmax|$cantori|$cantdes|$invideal\n";
	}
?>

