<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/ver_detalle_factura.php');
	
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
	
	
	
	$result =verdf::select1($g);
	
	
	
	
	echo "<table align='center'>
	<tr>
	
	<th>Id. Interno</th>
	<th>Nombre del Cliente</th>
	<th>Identificación</th>
	<th>Fecha de Factura</th>
	<th>Usuario</th>
	</tr>";
	foreach($result as $row)
	
	{
		
		echo "<tr>";
		echo "<td>" . $row->factura . "</td>";
		echo "<td>" . $row->nombre. "</td>";
		echo "<td>" . $row->identificacion . "</td>";
		echo "<td>" . $row->fecha . "</td>";
		echo "<td>" . $row->ordenado_por . "</td>";
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
		$empresa = trim($row->nombre);
		$ruc = $row->identificacion;
		$total = $row->total;
		$efectivo = $row->efectivo;
		$tarjeta_debito = $row->tarjeta_clave;
		$tarjeta_credito = $row->tarjeta_credito;
		$credito = $row->credito;
		$descuento_total = $row->descuento_total;
		$porcentaje_desc = $row->porcentaje_desc;
		$cheque = $row->cheque;
		$total_pagado = $efectivo + $tarjeta_debito + $tarjeta_credito + $cheque;
		$direccion= 'SAN FRANCISCO, URB. PAITILLA - **PUBLICO**';
		
		if ($descuento_total > 0 && $porcentaje_desc == 0){
			$porcentaje_desc = round(($descuento_total * 100 / $total),2);
		}
		
		
		
		$kores =verdf::select2($_SESSION['MM_iduser']);
		foreach($kores as $korow)
		
		{
			$caja_id = $korow->caja_id;
			
		}
		
		/*añado parametrización de impresoras fiscales*/
		
		
		$respe = verdf::select3($caja_id);
		foreach($respe as $rowspe)
		
		{
			$nombre_carpeta = $rowspe->ruta_entrada;
			$nombre_carpeta2 = $rowspe->ruta_salida
			;
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
		
		
		
	}
	echo "</table> <p>";
	
	
	
	
	
	$resulta = verdf::select4($g);
	
	
	
	echo "<table align='center'>
	<tr>
	
	<th>Producto</th>
	<th>Cantidad</th>
	<th>Precio Unitario</th>
	<th>Descuento Unit.</th>
	<th>Itbms Unit.</th>
	<th>Precio Venta</th>
	
	</tr>";
	foreach($resulta as $rows)
	
	{
		echo "<tr>";
		echo "<td>" . $rows->medicamento . "</td>";
		echo "<td>" . $rows->cantidad . "</td>";
		echo "<td>" . round($rows->precio_unitario,2) . "</td>";
		echo "<td>" . round($rows->descuento_unitario,2) . "</td>";
		echo "<td>" . round($rows->impuesto,2) . "</td>";
		echo "<td>" . round($rows->precio_venta,2) . "</td>";
		
		
		echo "</tr>";
		
		
		$id = $rows->medicamento_id;
		$med = $rows->medicamento;
		$dosis = 0;
		$cant = $rows->cantidad;
		//$precio = (round($rows['precio_unitario'],2) - round($rows['descuento_unitario'],2)) ;
		$precio = (round($rows->precio_unitario,2));
		$descuento_unitario = (round($rows->descuento_unitario,2));
		$impuesto = $rows->impuesto;
		
		
		/**agrego tipo de impuesto**/
		
		$cres = verdf::select5($id);
		foreach($cres as $crow )
		{
			$tipo_impuesto = $crow->tipo_impuesto;
		}
		
		
		/**fin de agrego tipo de impuesto**/
		
		
		
		
		
		
	}
	
	echo "</table>"; 
	
	echo "</body>
	
	
	</html>";
	//} else {
	/*echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>";
		}
	*/
?>

