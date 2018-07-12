<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_fiscal_dev.php');
	require_once('../modulos/layout.php');
	layout::encabezado();	
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
	layout::menu();
	layout::ini_content();
	
	$devolucion = $_GET['devolucion'];
	$dev_long = "NCTI".str_pad(trim($devolucion), 7, 0, STR_PAD_LEFT);
	$dev_long_min = "ncti".str_pad(trim($devolucion), 7, 0, STR_PAD_LEFT);
	
	$gres = imprimir_fd::select7($devolucion);
	
	foreach($gres as $grow){
		$total = $grow->total;
	}
	
	
	$res = imprimir_fd::select8($devolucion);	
	
	foreach($res as $row){
		
		$factura = $row->factura;
		$fecha = $row->fecha_creacion;
		$hist = $row->historia;
		$cama = $row->no_cama;
		$FA = $row->FA;
		
		$resl = imprimir_fd:: select9($hist);		
		
		foreach($resl as $rowl){
			$nombre = $rowl->nombre_paciente;
			$id_paciente = $rowl->id_paciente;
		}		
		
		$resd = imprimir_fd::select10($factura);
		
		foreach($resd as $rowd){
			$factura_fiscal = $rowd->factura_fiscal;
			$archivo_fiscal = $rowd->archivo_fiscal;
			$equipo_fiscal = $rowd->equipo_fiscal;
			//$FA = $rowd->FA;
			//$factura_fiscal = '000000007';
			//$archivo_fiscal = 'FACTI0000077';
			//$equipo_fiscal = 'CLOK311101129';
		}
		
		
		
		$empresa = $nombre.' Hab: '.$cama.' Hist: '.$hist;
		$ruc = trim($id_paciente);
		$direccion= 'SAN FRANCISCO, URB. PAITILLA  **DEV**';
		
		
		/*añado parametrización de impresoras fiscales*/
		
		$respe = imprimir_fd::select11();
		
		foreach($respe as $rowspe){
			$nombre_carpeta = $rowspe->nombre_carpeta;
			$nombre_carpeta2 = $rowspe->nombre_carpeta2;
		}
		
		/* fin de añado parametrización de impresoras fiscales */
		
		
		
		$fp = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long.".txt","a");
		fwrite($fp, "1\t$dev_long\t$empresa\t$ruc\t$direccion\t$total\t0\tDEVOLUCION\t$fecha\t$equipo_fiscal\t$factura_fiscal\t$FA");
		fclose($fp);
		
		$dev_long_mov = "NCMV".str_pad($devolucion, 7, 0, STR_PAD_LEFT);
	}
	
	$fp2 = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long_mov.".txt","a");
	
	$res1 = imprimir_fd::select12($devolucion);
	foreach($res1 as $row1){
		
		if ($row1->tipo_de_dosis == 'M'){
			$cantidad_uni = ceil($row1->cantidad);
			}else{
			$cantidad_uni = $row1->cantidad;
		}
		
		
		$id = $row1->medicamento_id;
		$med = $row1->medicamento;
		$dosis = $row1->dosis;
		$cant = $cantidad_uni;
		$precio = $row1->precio_unitario;
		$impuesto = $row1->impuesto;
		fwrite($fp2, "$dev_long\t$id\t$med\t$dosis\t$cant\t$precio\t$impuesto\t2".PHP_EOL);
	}
	fclose($fp2);
	
	
	
	
	echo "<INPUT TYPE=\"button\" class='blue' value='Obtener N&uacute;mero Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_dev.php?archivo=".$dev_long_min.".txt&FA=".$FA."&devolucion=".$devolucion."&carpeta=".$nombre_carpeta2."'\" >";
	//echo "<a href='numero_fiscal_dev.php?archivo=".$dev_long_min.".txt'>Obtener Numero Fiscal</a>";
	
	layout::fin_content();
?>