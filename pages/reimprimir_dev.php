<?php
	
	
	$devolucion = 56609;
	$z= 56609;
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/reimprimir_dev.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	
	
	echo "<html>
	<head>  <link href='estilo.css' rel='stylesheet' type='text/css' /> </head> <body>
	<center><h1>Devoluci&oacute;n  No.".$z."</h1></center><p>";
	
	
	/*
		echo "<table border='1'>
		<tr>
		
		<th>Nombre del Paciente</th>
		<th>Historia</th>
		
		</tr>";
		
		while($row = mysql_fetch_array($result))
		{
		echo "<tr>";
		echo "<td>" . $row['nombre_paciente'] . "</td>";
		echo "<td>" . $row['historia'] . "</td>";
		
		echo "</tr>";
		}
	echo "</table>";*/
	
	//echo "3";
	
	$resulta=redv::select1($z);
	
	echo "<table border='1'>
	<tr>
	
	<th>Medicamento</th>
	<th>Cantidad</th>
	
	</tr>";
	foreach($resulta as $rows)
	
	{
		echo "<tr>";
		echo "<td>" . $rows->medicamento . "</td>";
		echo "<td>" . $rows->cantidad . "</td>";
		
		
		echo "</tr>";
	}
	//echo "4";
	
	echo "</table>";
	
	
	$dev_long = "NCTIC".str_pad(trim($devolucion), 7, 0, STR_PAD_LEFT);
	$dev_long_min = "nctic".str_pad(trim($devolucion), 7, 0, STR_PAD_LEFT);
	
	$wres=redv::select2($devolucion);
	foreach($wres as $wrow)
	{
		
		$factura = $wrow->factura;
	}
	
	$gres =redv::select3($devolucion);
	foreach($gres as $grow)
	
	{
		$total = $grow->total;
	}
	
	
	
	$res =redv::select4($factura);
	
	
	
	$result =redv::select5($factura);
	foreach($res as $row )
	
	{
		
		$factura = $row->factura;
		$fecha = $row->fecha;
		$nom_cliente = $row->nombre;
		
		foreach($result as $rowl)
		{
			$nombre = $rowl->nombre;
			$id_paciente = $rowl->identificacion;
		}
		
		
		$resd =redv::select6($devolucion);
		foreach($resd  as $rowd)
		
		{
			$factura_fiscal = $rowd->factura_fiscal;
			$archivo_fiscal = $rowd->archivo_fiscal;
			$equipo_fiscal = $rowd->equipo_fiscal;
			$FA = $rowd->FA;
			$factura = $rowd->factura;
			//$factura_fiscal = '000000007';
			//$archivo_fiscal = 'FACTI0000077';
			//$equipo_fiscal = 'CLOK311101129';
		}
		
		
		
		$empresa = $nombre;
		$ruc = trim($id_paciente);
		$direccion= '**';
		
		if($ruc == ''){
			$ruc = '**';
		}
		
		/*añado parametrización de impresoras fiscales*/
		
		
		$kores = redv::select7($_SESSION['MM_iduser']);
		foreach($kores as $korow)
		
		{
			$caja_id = $korow->caja_id;
			
		}
		
		/*añado parametrización de impresoras fiscales*/
		
		$respe = redv::select8($caja_id);
		
		foreach($respe as $rowspe)
		{
			$nombre_carpeta = $rowspe->ruta_entrada;
			$nombre_carpeta2 = $rowspe->ruta_salida;
		}
		
		/* fin de añado parametrización de impresoras fiscales */
		
		
		
		//$fp = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long.".txt","a");
		$fp = fopen($nombre_carpeta."//".$dev_long.".txt","a");
		fwrite($fp, "1\t$dev_long\t$empresa\t$ruc\t$direccion\t$total\t0\tDEVOLUCION\t$fecha\t$equipo_fiscal\t$factura_fiscal\t$factura");
		fclose($fp);
		
		$dev_long_mov = "NCMVC".str_pad($devolucion, 7, 0, STR_PAD_LEFT);
	}
	
	$res1 = redv::select9($devolucion);
	//$fp2 = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long_mov.".txt","a");
	$fp2 = fopen($nombre_carpeta."//".$dev_long_mov.".txt","a");
	foreach($res1 as $row1)
	{
		
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
		
		/**agrego tipo de impuesto**/
		
		$cres =redv::select10($id);
		foreach($cres as $crow)
		{
			$tipo_impuesto = $crow->tipo_impuesto;
		}
		
		
		/**fin de agrego tipo de impuesto**/
		
		
		fwrite($fp2, "$dev_long\t$id\t$med\t$dosis\t$cant\t$precio\t$impuesto\t2\t$tipo_impuesto".PHP_EOL);
	}
	fclose($fp2);
	
	
	
	
	echo "<INPUT TYPE=\"button\" class='blue' value='Obtener N&uacute;mero Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_dev_cierre.php?archivo=".$dev_long_min.".txt&devolucion=".$devolucion."&carpeta=".addslashes($nombre_carpeta2)."'\" >";
	
	layout::fin_content();
?>
