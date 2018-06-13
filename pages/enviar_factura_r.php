<?php 
	include('./clases/session.php');
	require_once('../modulos/reimprimir_fiscal.php');
	$userid=$_SESSION['MM_iduser'];
	$g = $_GET['no_factura'];
	
	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
	echo "<html>
	<head>    <style type='text/css'>
	
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
	background-color: blue;
	color: white;
	}
	.red, .white, .blue, .green {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	}
	
	table {
    border-collapse:separate;
    border:solid 1px;
    border-radius:10px;
    -moz-border-radius:10px;
	
	
	
	}
	
	td, th {
    border-left:solid 1px;
    border-top:solid 1px;
	}
	
	th {
    background-color: #2E7AD2;
	color:#FFFFFF;
    border-top: none;
	}
	
	td:first-child {
	border-left: solid 1px;
	}
	
	body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	}
	
	
	</style>
	
	
	<script language='javascript'>
	<!-- Begin
	function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval('page' + id + ' = window.open(URL, '' + id + '', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=50,height=50');');
	}
	
	
	
	</script>
	
	
	
	</head> <body>
	
	
	<center><h2>Previsualizaci&oacute;n de Factura</h2></center><p>";
	
	echo "<table align='center'>
	<tr>
	
	<th>Id. Interno</th>
	<th>Nombre del Cliente</th>
	<th>Identificación</th>
	<th>Fecha de Factura</th>
	<th>Usuario</th>
	</tr>";
	
	$row = rfiscal::efactura_sl1($g);
	
	foreach($row as $rw1){
		echo "<tr>";
		echo "<td>" . $rw1->factura . "</td>";
		echo "<td>" . $rw1->nombre . "</td>";
		echo "<td>" . $rw1->identificacion . "</td>";
		echo "<td>" . $rw1->fecha . "</td>";
		echo "<td>" . $rw1->ordenado_por . "</td>";
		echo "</tr>";
		
		$fact_long = "FACTIC".str_pad($g, 7, 0, STR_PAD_LEFT);
		$fact_long_min = "factic".str_pad($g, 7, 0, STR_PAD_LEFT);
		
		$total_pagado = 0;
		$efectivo = 0;
		$tarjeta_debito = 0;
		$tarjeta_credito = 0;
		$credito = 0;
		$descuento_total = 0;
		$porcentaje_desc = 0;
		$cheque = 0;
		$empresa = trim($rw1->nombre);
		$ruc = $rw1->identificacion;
		$total = $rw1->total;
		$efectivo = $rw1->efectivo;
		$tarjeta_debito = $rw1->tarjeta_clave;
		$tarjeta_credito = $rw1->tarjeta_credito;
		$credito = $rw1->credito;
		$descuento_total = $rw1->descuento_total;
		$porcentaje_desc = $rw1->porcentaje_desc;
		$cheque = $rw1->cheque;
		$total_pagado = $efectivo + $tarjeta_debito + $tarjeta_credito + $cheque;
		$direccion= 'SAN FRANCISCO, URB. PAITILLA - **PUBLICO**';
		
		if ($descuento_total > 0 && $porcentaje_desc == 0){
			$porcentaje_desc = round(($descuento_total * 100 / $total),2);
		}
		
		$korow = rfiscal::efactura_sl2($_SESSION['MM_iduser']);
		
		foreach($korow as $kw){
			$caja_id = $kw->caja_id;
		}
		
		/*añado parametrización de impresoras fiscales*/
		
		$rowspe = rfiscal::efactura_sl3($caja_id);
		
		foreach($rowspe as $rwp){
			$nombre_carpeta = $rwp->ruta_entrada;
			$nombre_carpeta2 = $rwp->ruta_salida;
		}
		
		/* fin de añado parametrización de impresoras fiscales */
		
		
		if($efectivo == '0.00'){
			$efectivo = 0;
		}
		
		if($cheque == '0.00'){
			$cheque = 0;
		}
		
		if($tarjeta_credito == '0.00'){
			$tarjeta_credito = 0;
		}
		
		if($tarjeta_debito == '0.00'){
			$tarjeta_debito = 0;
		}
		
		if($descuento_total == '0.00'){
			$descuento_total = 0;
		}
		
		
		$fp = fopen($nombre_carpeta."//".$fact_long.".txt","a");
		//$fp = fopen("/home/apdosis/pos/in1/".$fact_long.".txt","a");
		
		fwrite($fp, "$fact_long\t$empresa\t$ruc\t$direccion\t$descuento_total\t$total_pagado\t$total\t$credito\t0\t$efectivo\t$cheque\t$tarjeta_credito\t$tarjeta_debito\t0\t0\t0");
		fclose($fp);
	}
	
	echo "</table> <p>";
	
	$fact_long_mov = "FACMVC".str_pad($g, 7, 0, STR_PAD_LEFT);
	
	$fp2 = fopen($nombre_carpeta."//".$fact_long_mov.".txt","a");
	//$fp2 = fopen("/home/apdosis/pos/in1/".$fact_long_mov.".txt","a");
	echo "<table align='center'>
	<tr>
	
	<th>Producto</th>
	<th>Cantidad</th>
	<th>Precio Unitario</th>
	<th>Descuento Unit.</th>
	<th>Itbms Unit.</th>
	<th>Precio Venta</th>
	
	</tr>";
	$resulta = rfiscal::efactura_sl4($g);
	
	foreach($resulta as $res){
		echo "<tr>";
		echo "<td>" . $res->medicamento . "</td>";
		echo "<td>" . $res->cantidad . "</td>";
		echo "<td>" . round($res->precio_unitario,2) . "</td>";
		echo "<td>" . round($res->descuento_unitario,2) . "</td>";
		echo "<td>" . round($res->impuesto,2) . "</td>";
		echo "<td>" . round($res->precio_venta,2) . "</td>";
		
		
		echo "</tr>";
		
		
		$id = $res->medicamento_id;
		$med = $res->medicamento;
		$dosis = 0;
		$cant = $res->cantidad;
		//$precio = (round($res->precio_unitario,2) - round($res->descuento_unitario,2)) ;
		$precio = (round($res->precio_unitario,2));
		$descuento_unitario = (round($res->descuento_unitario,2));
		$impuesto = $res->impuesto;
		
		
		/**agrego tipo de impuesto**/		
		$crow = rfiscal::efactura_sl5($id);
		
		foreach($crow as $crw){
			$tipo_impuesto = $crw->tipo_impuesto;
		}
		
		/**fin de agrego tipo de impuesto**/		
		
		
		fwrite($fp2, "$fact_long\t$id\t$med\t$dosis\t$cant\t$precio\t$impuesto\t$descuento_unitario\t$tipo_impuesto".PHP_EOL);
		
		
	}
	
	fclose($fp2);
	echo "</table>"; 
	echo "<p>Espere hasta que se imprima en su totalidad la factura fiscal y de clic al botón Obtener Número Fiscal</p><p></p>";
	
	echo "<INPUT TYPE=\"button\" class='blue' value='Obtener Número Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_cierre.php?archivo=".$fact_long_min.".txt&factura=".$g."&carpeta=".addslashes($nombre_carpeta2)."'\" >";
	echo "</body>
	
	
	</html>";
	//} else {
	/*echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>";
		}
	*/
?>

