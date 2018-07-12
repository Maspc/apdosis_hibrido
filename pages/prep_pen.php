<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/prep_pen.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	$cont = 0;
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
	.yellow {
	background-color: #FFFF00;
	color: black;
	}
	.purple {
	background-color: #BF5FFF;
	color: white;
	}
	
	.orange {
	background-color: #FFA500;
	color: black;
	}
	
	.red, .white, .blue, .green, .yellow, .purple, .orange {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}
</style>
<?php
	layout::menu();
	layout::ini_content();
	
	$pres = pre_pen::select1($_SESSION['MM_iduser']);
	
	foreach($pres as $prow){
		$username = $prow->nombre;
	}
	
	$fres = pre_pen::select2();
	
	foreach($fres as $frow){
		$codigo_carro = $frow->codigo_carro;
		$intervalo1 = $frow->intervalo1;
	}
?>
<center>   <h1>Cronograma de Preparaciones para la nave del <?php echo $intervalo1.' - '.$codigo_carro; ?></h1> </center>
<div class="content_box_inner" style="font-size:smaller">
	
	
	
	<?php
		
		echo "<div align='right'><h3>Usuario: ".$username."</h3></div>";  
		
		
	?>
	
	<p>
		<center>
			<table border="1" cellpadding="1" cellspacing="1">
				<tr><th>Estado</th><th>Descripci&oacute;n</th></tr>
				<tr><td>PENDIENTE</td><td>Preparaci&oacute;n Pendiente por Entrega</td></tr>
				<tr><td>PROCESADO</td><td>Preparaci&oacute;n Entregada</td></tr>
				<tr><td>DEVUELTO</td><td>Preparaci&oacute;n ya facturada el d&iacute;a de hoy a las 5:00 a.m, no requerida por el paciente. No debe ser preparada.</td></tr>
				<tr><td>CANCELADO</td><td>Preparaci&oacute;n no facturada que se cancela antes de la nave de las 5:00 a.m.</td></tr>
			</table>
		</center>
	</p>
	
	<?php
		
		
		
		$m = 0;
		
		
		
		/*
			
			$x = "select distinct factura_detalle.factura from factura_detalle, factura where factura_detalle.codigo_carro = '$codigo_carro_p' and factura.factura = factura_detalle.factura and factura_detalle.linea > 0 and factura_detalle.preparacion = 'S' order by factura.no_cama";
			$xres = mysql_query($x, $conn) or die(mysql_error());
			
			while ($xrow = mysql_fetch_array($xres)) {
			
			
		$factura = $xrow->factura;*/
		
		
		echo "<center><h1>Preparaciones STAT</h1>";
		echo "</center>";
		
		$resulta2 = pre_pen::select3($codigo_carro);
		
		
		$tbl = '<table border="1" cellspacing="1" cellpadding="1" align="center">
		<tr><td colspan="7"><b>Preparaciones de la Nave:'.$codigo_carro.'. Turno:'.$descripcion.'  </b></td></tr>	 
		<tr><th>Historia</th><th>Cama</th><th>Medicamento</th><th>Dosis</th><th>Observacion</th><th>Estado</th><th>Devoluci&oacute;n</th></tr>';
		
		
		if($id_frecuencia != 4){ 
			$gres = pre_pen::select4($codigo_carro,$id_frecuencia);
			} else {
			$gres = pre_pen::select5($codigo_carro,$id_frecuencia);
			
		}
		
		foreach($gres as $grow){
			
			if($grow->estado_producto == 'X'){
				$estado = 'CANCELADO';
				} else if ($grow->estado_producto == 'E') {
				$estado = 'NUEVO';
				} else if ($grow->estado_producto == 'P') {
				$estado = 'PENDIENTE';
			}
			
			
			$hora_actual = date('Y-m-d H:i:s', time());
			
			$hora_actual_hr = date('H:i:s', time());
			
			
			if($hora_actual_hr >= '00:00:00' and $hora_actual_hr < '05:00:00'){
				
				$hora_actual = date('Y-m-d H:i:s', strtotime($hora_actual. ' - 1 days'));
			}
			
			
			//$turno = date('Y-m-d', time()).' '.
			
			
			$pires = pre_pen::select6($id_frecuencia);
			
			foreach($pires as $pirow){
				$turnoP = date('Y-m-d', time()).' '.$pirow->hora;				
			}
			
			
			if ($id_frecuencia == 4){
				$turnoP = date('Y-m-d H:i:s', strtotime($turnoP. ' + 1 days'));
			}
			
			/*echo "<p>hora actual: ".$hora_actual;
			echo "<p>turno: ".$turnoP;*/
			
			
			if(strtotime($hora_actual) > strtotime($turnoP)){
				if($estado == 'PENDIENTE') {
					$estado = 'PROCESADO';
				}
				
			}
			
			if($grow->devolucion > 0){
				$devolucion = 'DEVUELTO';
				$estado = 'DEVUELTO';
				} else {
				$devolucion = ' ';
			}
			
			$tbl .=  '<tr'; 
			
			if ($devolucion == 'DEVUELTO' || $estado == 'CANCELADO') {
				$tbl .= ' bgcolor="#A4A4A4"';
			}
			
			$tbl .= '><td>'.$grow->historia.'</td><td>'.$grow->no_cama.'</td><td>'.$grow->medicamento.'</td><td>'.$grow->dosis.'</td><td>'.$grow->observacion_farma.'</td><td>'.$estado.'</td><td>'.$devolucion.'</td></tr>';
			
		}
		
		$tbl .=  '</table>';
		
		
		echo $tbl;
		
		
		
		//echo "m ".$m;
		
		
		$pres = pre_pen::select7();	
		
		foreach($pres as $prow){
			$id_frecuencia =$prow->id_frecuencia;
			$descripcion = $prow->descripcion;
			
			
		echo "<center><h1>Turno de las ".$descripcion."</h1>";?>
		
		<input type='button' value='Imprimir Listado'  class='green' onClick="window.open('imprimir_preparacion_lista.php?codigo_carro=<?php echo  $codigo_carro ?>&id_frecuencia=<?php echo  $id_frecuencia ?>','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');" />
		<input type='button' value='Imprimir Labels'  class='green' onClick="window.open('reimprimir_labels_prep.php?codigo_carro=<?php echo  $codigo_carro ?>&id_frecuencia=<?php echo  $id_frecuencia ?>','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');" />
		
		<?php
			
			
			$tbl = '<table border="1" cellspacing="1" cellpadding="1" align="center">
			<tr><td colspan="7"><b>Preparaciones de la Nave:'.$codigo_carro.'. Turno:'.$descripcion.'  </b></td></tr>	 
			<tr><th>Historia</th><th>Cama</th><th>Medicamento</th><th>Dosis</th><th>Observacion</th><th>Estado</th><th>Devoluci&oacute;n</th></tr>';
			
			
			if($id_frecuencia != 4){ 
				$gres = pre_pen::select8($codigo_carro,$id_frecuencia);
				} else {
				$gres = pre_pen::select9($codigo_carro,$id_frecuencia);
				
			}
			
			foreach($gres as $grow){
				
				if($grow->estado_producto == 'X'){
					$estado = 'CANCELADO';
					} else if ($grow->estado_producto == 'E') {
					$estado = 'NUEVO';
					} else if ($grow->estado_producto == 'P') {
					$estado = 'PENDIENTE';
				}
				
				
				$hora_actual = date('Y-m-d H:i:s', time());
				
				$hora_actual_hr = date('H:i:s', time());
				
				
				if($hora_actual_hr >= '00:00:00' and $hora_actual_hr < '05:00:00'){
					
					$hora_actual = date('Y-m-d H:i:s', strtotime($hora_actual. ' - 1 days'));
				}
				
				
				//$turno = date('Y-m-d', time()).' '.
				
				$pires = pre_pen::select10($id_frecuencia);
				
				foreach($pires as $pirow){
					$turnoP = date('Y-m-d', time()).' '.$pirow->hora;					
				}
				
				
				if ($id_frecuencia == 4){
					$turnoP = date('Y-m-d H:i:s', strtotime($turnoP. ' + 1 days'));
				}
				
				/*echo "<p>hora actual: ".$hora_actual;
				echo "<p>turno: ".$turnoP;*/
				
				
				if(strtotime($hora_actual) > strtotime($turnoP)){
					if($estado == 'PENDIENTE') {
						$estado = 'PROCESADO';
					}
					
				}
				
				if($grow->devolucion > 0){
					$devolucion = 'DEVUELTO';
					$estado = 'DEVUELTO';
					} else {
					$devolucion = ' ';
				}
				
				$tbl .=  '<tr'; 
				
				if ($devolucion == 'DEVUELTO' || $estado == 'CANCELADO') {
					$tbl .= ' bgcolor="#A4A4A4"';
				}
				
				$tbl .= '><td>'.$grow->historia.'</td><td>'.$grow->no_cama.'</td><td>'.$grow->medicamento.'</td><td>'.$grow->dosis.'</td><td>'.$grow->observacion_farma.'</td><td>'.$estado.'</td><td>'.$devolucion.'</td></tr>';
				
			}
			
			$tbl .=  '</table>';
			
			
			echo $tbl;
		}
	?>
</div>
<?=layout::fin_content()?>
<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1500px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=600,width=1500,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>