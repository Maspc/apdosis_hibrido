<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_devolucion_pub_manual.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	error_reporting(E_ALL & ~E_NOTICE);
	if (isset($_POST['medicamento'])) { 
	$medicamento = $_POST['medicamento'];}
	if (isset($_POST['medicamento_id'])) { 
	$medicamento_id = $_POST['medicamento_id'];}
	if (isset($_POST['forma'])) { 
	$forma = $_POST['forma'];}
	if (isset($_POST['dosis'])) { 
	$dosis = $_POST['dosis'];}
	if (isset($_POST['horas'])) { 
	$horas = $_POST['horas'];}
	if (isset($_POST['dias'])) { 
	$dias = $_POST['dias'];}
	if (isset($_POST['cantidad'])) { 
	$cantidad = $_POST['cantidad'];}
	if (isset($_POST['cant'])) { 
	$cantidad_de_dosis = $_POST['cant'];}
	if (isset($_POST['cargo'])) { 
	$cargo = $_POST['cargo'];}
	if (isset($_POST['devol'])) { 
	$devol = $_POST['devol'];}
	if (isset($_POST['historia'])) { 
	$historia = $_POST['historia'];}
	if (isset($_POST['tratamiento'])) { 
	$tratamiento = $_POST['tratamiento'];}
	if (isset($_POST['despacho'])) { 
	$despacho = $_POST['despacho'];}
	if (isset($_POST['precio_unitario'])) { 
	$precio_unitario= $_POST['precio_unitario'];}
	if (isset($_POST['costo_insumo'])) { 
	$costo_insumo= $_POST['costo_insumo'];}
	if (isset($_POST['impuesto'])) { 
	$impuesto= $_POST['impuesto'];}
	if (isset($_POST['precio_venta'])) { 
	$precio_venta = $_POST['precio_venta'];}
	if (isset($_POST['stat'])) { 
	$stat = $_POST['stat'];}
	if (isset($_POST['userid'])) { 
	$userid = $_POST['userid'];}
	if (isset($_POST['session'])) { 
	$session = $_POST['session'];}
	if (isset($_POST['fa'])) { 
	$fa = $_POST['fa'];}
	if (isset($_POST['tipo_de_dosis'])) { 
	$tipo_de_dosis = $_POST['tipo_de_dosis'];}
	if (isset($_POST['bodega'])) { 
	$bodega = $_POST['bodega'];}
	if (isset($_POST['motivo'])) { 
	$motivo = $_POST['motivo'];}
	if (isset($_POST['cantprep'])) { 
	$cantidad_prep = $_POST['cantprep'];}
	if (isset($_POST['cantidad_por_dosis'])) { 
	$cantidad_por_dosis = $_POST['cantidad_por_dosis'];}
	
	
	
	//include('seguridad.php');
	
	
	$w = 0;			
	for($k = 0; $k < sizeof($medicamento); $k++) {
		
		
		//echo "<br>LA CANTIDAD DE DOSIS ES: ".$cantidad_de_dosis[$c];
		if ($devol[$k] > 0) {
			$w = $w + 1;
		}
		
		
		$resvti= enviar_dpm::select1($medicamento_id[$k],$cargo);
		
		foreach($resvti as $rowsvti)
		{
			$dev = $rowsvti->devolucion;
			$canti = $rowsvti->cantidad;
			$dif = $canti -$dev ; 
		}
		
	}
	
	if ($w > 0 && $dif > 0) {
		
		
		$kores =enviar_dpm::select2($_SESSION['MM_iduser']); 
		
		foreach($kores as $korow)
		
		{
			$caja_id = $korow->caja_id;
			$nombre = $korow->nombre;
			
		}			
		
		$fecha_creacion = date("Y-m-d H:i:s", time());
		
		$res5 = enviar_dpm::insert1($fecha_creacion,$stat,$userid,$bodega,$motivo,$caja_id,$cargo); 
		
		
		
		$resd =enviar_dpm::select3(); 
		
		
		foreach($resd as $rowd )
		{
			$z = $rowd->dev;
		}
		
		//echo "devolucion ".$z;
		
		//echo "1";
		$l=0;
		for($c = 0; $c < sizeof($medicamento); $c++) {
			
			
			//echo "<br>LA CANTIDAD DE DOSIS ES: ".$cantidad_de_dosis[$c];
			if ($devol[$c] > 0) {
				
				if ($devol[$c] > $cantidad_de_dosis[$c]){
					$devol[$c] = $cantidad_de_dosis[$c];
				}
				
				
				
				if ($tipo_de_dosis[$c] == 'M'){
					$cantidad_uni = ceil($devol[$c]);
					}else{
					$cantidad_uni = $devol[$c];
				}
				
				
				
				if($cantidad_uni > $cantidad_de_dosis[$c]){
					$cantidad_uni = $cantidad_de_dosis[$c];
				}
				
				$vres =enviar_dpm::select4($medicamento_id[$c]);
				
				foreach($vres as $vrow)
				{
					$costo_unitario = $vrow->costo_unitario;
				}
				
				
				$precio_venta_dev = $cantidad_uni * ($precio_unitario[$c]  + $impuesto[$c]) ;
				
				$l = $l + 1;
				
				
				$res = enviar_dpm::insert2($medicamento[$c],$forma[$c],$dosis[$c],$horas[$c], $dias[$c],$cantidad_uni,$z, $l, $medicamento_id[$c], $cargo, $precio_unitario[$c], $precio_venta_dev, $historia[$c], $costo_insumo[$c], $impuesto[$c], $costo_unitario); 
				
				
				
				
				
				
				
				/*
					$s = "update registro_detalle set cantidad_de_dosis = cantidad_de_dosis - $devol[$c] where historia = '" .$historia[$c] . "' and tratamiento = '".$tratamiento[$c]."' and cargo = '".$despacho[$c]."' and medicamento_id = '$medicamento_id[$c]'";
				$ress = mysql_query($s, $conn) or die(mysql_error());*/
				
				
				//echo "<br>1. la cantidad de dosis menos 1 es: ".($cantidad_de_dosis[$c] - $devol[$c]);
				
				$resvt=enviar_dpm::update1($devol[$c],$medicamento_id[$c],$cargo);
				
				/*
					if (($cantidad_de_dosis[$c] - $devol[$c]) == 0) { 
					echo "<br>2. el medicamento es: ".$medicamento_id[$c];
					echo"<br>3. la cantidad de dosis menos uno es: ".($cantidad_de_dosis[$c] - $devol[$c]);
					$o = "update registro_detalle set estado = 'F' where medicamento_id = '$medicamento_id[$c]'";
					$ores = mysql_query($o, $conn) or die(mysql_error());
				}*/
				
				
				$result = enviar_dpm::select5($historia[$c],$tratamiento[$c],$despacho[$c]);
				
				
				$resvg=  enviar_dpm::update2($devol,$medicamento_id);
				
				
				/*
					$r = "select sum(cantidad_de_dosis) as valido from registro_detalle where historia = '" .$historia[$c] . "' and tratamiento = '".$tratamiento[$c]."' and cargo = '".$despacho[$c]."'";
					$rres = mysql_query($r, $conn) or die(mysql_error());
					
					while ($rrow = mysql_fetch_array($rres)){
					$valido = $rrow['valido'];
					}
					
					if ($valido == 0) {
					$t = "update registro set estado = 'F' where historia = '" .$historia[$c] . "' and tratamiento = '".$tratamiento[$c]."' and cargo = '".$despacho[$c]."'";
					$tres = mysql_query ($t, $conn) or die(mysql_error());
				}*/
				
				$precio_venta1 = $precio_venta1 + $precio_venta_dev ;
				
				$hist = $historia[$c];
			}}
			
			$ru = enviar_dpm::update3($precio_venta1,$z);
			
			
			
			$insi = enviar_dpm::update4($precio_venta1,$z);
			
			
			//echo "2";
			
			/*añado codigo ´para enviar devolucionse por equivocacion de bodega automaticamente como webservice*/
			
			
			
			$devolucion = $z;
			
			
			
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
			
			$resulta =enviar_dpm::select6($z); 
			
			
			echo "<table border='1'>
			<tr>
			
			<th>Medicamento</th>
			<th>Cantidad</th>
			
			</tr>";
			foreach($resulta as $rows )
			
			{
				echo "<tr>";
				echo "<td>" . $rows->medicamento . "</td>";
				echo "<td>" . $rows->cantidad. "</td>";
				
				
				echo "</tr>";
			}
			//echo "4";
			
			echo "</table>";
			
			
			$dev_long = "NCTIC".str_pad(trim($devolucion), 7, 0, STR_PAD_LEFT);
			$dev_long_min = "nctic".str_pad(trim($devolucion), 7, 0, STR_PAD_LEFT);
			
			$wres =enviar_dpm::select7($devolucion); 
			
			foreach($wres as $wrow )
			{
				
				$factura = $wrow->factura;
			}
			
			$gres =enviar_dpm::select8($devolucion); 
			
			foreach($gres as $grow)
			{
				$total = $grow->total;
			}
			
			
			$res =enviar_dpm::select9($factura);
			
			
			
			$result = enviar_dpm::select10($factura);
			
			foreach($res as $row)
			
			{
				
				$factura = $row->factura;
				$fecha = $row->fecha;
				$nom_cliente = $row->nombre;
				
				foreach($result as $rowl)
				{
					$nombre = $rowl->nombre;
					$id_paciente = $rowl->identificacion;
				}
				
				$resd =enviar_dpm::select11($devolucion);
				
				foreach($resd as $rowd)
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
				
				
				$respe =enviar_dpm::select12();
				
				foreach($respe as $rowspe )
				
				{
					$nombre_carpeta = $rowspe->nombre_carpeta;
					$nombre_carpeta2 = $rowspe->nombre_carpeta2;
				}
				
				/* fin de añado parametrización de impresoras fiscales */
				
				//echo "<p>nombre carpeta: ".$nombre_carpeta;
				//echo "<p>nombre carpeta2: ".$nombre_carpeta2;
				
				//$fp = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long.".txt","a");
				$fp = fopen("/opt/factura/".$nombre_carpeta."//".$dev_long.".txt","a");
				fwrite($fp, "1\t$dev_long\t$empresa\t$ruc\t$direccion\t$total\t0\tDEVOLUCION\t$fecha\t$equipo_fiscal\t$factura_fiscal\t$factura");
				fclose($fp);
				
				$dev_long_mov = "NCMVC".str_pad($devolucion, 7, 0, STR_PAD_LEFT);
			}
			
			$res1 =enviar_dpm::select13($devolucion); 
			
			//$fp2 = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long_mov.".txt","a");
			$fp2 = fopen("/opt/factura/".$nombre_carpeta."//".$dev_long_mov.".txt","a");
			$res1 = mysql_query($s, $conn) or die(mysql_error());
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
				$cres =enviar_dpm::select14($id); 
				foreach($cres  as $crow)
				
				{
					$tipo_impuesto = $crow->tipo_impuesto;
				}
				
				
				/**fin de agrego tipo de impuesto**/
				
				
				fwrite($fp2, "$dev_long\t$id\t$med\t$dosis\t$cant\t$precio\t$impuesto\t2\t$tipo_impuesto".PHP_EOL);
			}
			fclose($fp2);
			
			
			
			
			echo "<INPUT TYPE=\"button\" class='blue' value='Obtener N&uacute;mero Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_dev_cierre_manual.php?archivo=".$dev_long_min.".txt&devolucion=".$devolucion."&carpeta=".addslashes($nombre_carpeta2)."'\" >";
			} else{ 
			echo "<script language='javascript'>window.location='devolucion_proceso.php?cargo=$factura&men=1&userid=$userid&session=$session'</script>";   
	}  
	
	layout::fin_content();
?>
