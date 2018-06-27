<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_fiscal_stat.php');
	
?>
<style type="text/css">
	
	.red {
	background-color: red;
	color: white;
	}
	.white {
	background-color: white;
	color: black;
	}
	.green {
	background-color: green;
	color: white;
	}
	
	.blue {
	background-color: #0066FF;
	color: white;
	}
	.red, .white, .blue, .green {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}
	
	
	
	
	
</style>

<?php
	
	$factura = $_GET['factura'];
	
	$res = imprimir::select1($factura);
	
	foreach($res as $row){
		$total = $row->total;
		$FA = $row->FA;
		$car = $row->cargo;
		$cama = $row->no_cama;
		$hist = $row->historia;
		$trata = $row->tratamiento;
		$stat = $row->stat;
		$bodega = $row->bodega;
		
		$resd = imprimir::select2($car,$hist,$trata);
		
		foreach($resd as $rowd){
			$nombre = $rowd->nombre_paciente;
			$id_paciente = $rowd->id_paciente;
		}
		
	}
	
	//$factura = '77';
	
	//definir si es stat o bodega 
	
	$txt = "**STAT**";
	
	if ($bodega != '1'){
		
		$fres = imprimir::select3($bodega);
		
		foreach($fres as $frow){
			$txt = "**BAN** ".$frow->descripcion ;
		}
		
		
	}
	
	
	
	//fin de definir si es stat o bodega
	
	
	$fact_long = "FACTI".str_pad($FA, 7, 0, STR_PAD_LEFT);
	$fact_long_min = "facti".str_pad($FA, 7, 0, STR_PAD_LEFT);
	
	
	$empresa = trim($nombre.' Hab: '.$cama.' Hist: '.$hist);
	$ruc = trim($id_paciente);
	$direccion= 'SAN FRANCISCO, URB. PAITILLA '.$txt;
	
	/*añado parametrización de impresoras fiscales*/
	
	$pe = "select nombre_carpeta, nombre_carpeta2 from impresoras_fiscales where tipo_impresion = 'STA'";
	
	$respe = imprimir::select4();
	
	foreach($respe as $rowspe){
		$nombre_carpeta = $rowspe->nombre_carpeta;
		$nombre_carpeta2 = $rowspe->nombre_carpeta2;
	}
	
	/* fin de añado parametrización de impresoras fiscales */
	
	
	
	$fp = fopen("/opt/factura/".$nombre_carpeta."/".$fact_long.".txt","a");
	fwrite($fp, "$fact_long\t$empresa\t$ruc\t$direccion\t0\t0\t$total\t0\t0\t0\t0\t0\t0\t0\t0\t0");
	//fwrite($fp, "$fact_long\t$empresa\t$ruc\t$direccion\t0\t0\t$total\t0\t0\t0\t0\t0\t0\t0\t0");
	fclose($fp);
	
	$fact_long_mov = "FACMV".str_pad($FA, 7, 0, STR_PAD_LEFT);
	
	$fp2 = fopen("/opt/factura/".$nombre_carpeta."/".$fact_long_mov.".txt","a");
	$res1 = imprimir::select5();
	
	foreach($res1 as $row1){
		
		if ($row1->tipo_de_dosis == 'M'){
			$cantidad_uni = ceil($row1->cantidad);
			}else{
			$cantidad_uni = $row1->cantidad;
		}
		
		
		$id = $row1->medicamento_id;
		$med = trim(substr($row1->medicamento,0,115));
		$dosis = $row1->dosis;
		$cant = $cantidad_uni;
		$precio = $row1->precio_unitario;
		$impuesto = $row1->impuesto;
		fwrite($fp2, "$fact_long\t$id\t$med\t$dosis\t$cant\t$precio\t$impuesto\t2".PHP_EOL);
	}
	fclose($fp2);
	
	
	echo "<p>Espere hasta que se imprima en su totalidad la factura fiscal y de clic al botón Obtener Número Fiscal</p><p></p>";
	
	echo "<INPUT TYPE=\"button\" class='blue' value='Obtener Número Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_stat.php?archivo=".$fact_long_min.".txt&FA=".$FA."&factura=".$factura."&carpeta=".$nombre_carpeta2."'\" >";
	
	
	
	//echo "<a href='numero_fiscal_stat.php?archivo=".$fact_long_min.".txt&FA=".$FA."'>Obtener Numero Fiscal</a>";
	
	
	
	
?>
<script type="text/javascript">
	function change( el )
	{
		if ( el.value === "Obtener Número Fiscal" )
        el.value = "Obteniendo!!!!";
		else
        el.value = "Obtener Número Fiscal";
	}
</script>