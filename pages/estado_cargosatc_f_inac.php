<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/estado_cargosatc_f_inac.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="estado" id="estado">
	
	<table width="780" border="0" cellspacing="0" >
		
		<tr>
			<td>
				<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
					<tr>
						<td>Historia</td>
						<td><input name="historia" type="text" size="20" /></td>
					</tr>
					<tr>
						<td width="194">Orden</td>
						<td width="278"><input name="orden" type="text" size="20" /></td>
					</tr>
				</table>
				
				
				<div align="center">
					<input name="buscar" type="submit" value="Buscar Orden" />  
				</div></td>
		</tr>
	</table>
</form>
<?php     
	if(isset($_POST['buscar'])){
		if(isset($_POST['historia']) && $_POST['historia']!="")
		{
			$where[] = "registro.historia = '".$_POST['historia']."'";
		}
		if(isset($_POST['orden']) && $_POST['orden']!="")
		{
			$where[] = "registro.cargo = '".$_POST['orden']."'";
		}
		
		$u=1;	
		$v=1;	 
			
		$resulta = estado_cfi::select1($where);
		
		foreach($resulta as $rows7){
			if ($rows7->estado == 'E') {
				$esta = 'ENVIADO A FARMACIA(SIN PROCESAR)';
				}else if ($rows7->estado == 'P'){ 
				$esta = 'EN PROCESO (RECURRENCIA)';
				}else if ($rows7->estado == 'F'){ 
				$esta = 'FINALIZADO';
				}else if ($rows7->estado == 'X'){ 
				$esta = 'CANCELADO';
				} else { 
				$esta = 'Estado no definido';
			}
			echo "<center><h1>No. de Orden ". $rows7->cargo."</h1></center>";
			echo "<p><table border='1' align='center'>
			<th>Historia</th>
			<th>Nombre</th>
			<th>No. Ingreso</th>
			<th>Fecha de Solicitud</th>
			<th>Estado de Orden</th>
			";
			if ($rows7->stat == 'S')  {
				
				$res = estado_cfi::select2($historia,$tratamiento,$cargo);
				
				foreach($res as $row){
					$bodega = $row->bodega;
					$nombre = $row->descripcion;
				}
				
				if($bodega != 1){
					$banco = "- ".$nombre;
					} else {
					$banco = ' ';
				}
				echo "<th>Tipo</th>";
			}
			
			echo "<tr>
			<td>".$rows7->historia."</td>
			<td>".$rows7->nombre_paciente."</td>
			<td align='center'>".$rows7->tratamiento."</td>
			<td align='center'>".$rows7->fecha_creacion."</td>
			<td><font color='green'><b>".$esta."</b></font></td>";
			if ($rows7->stat == 'S') {
				echo "<td><font color='red'><b>STAT ".$banco."</b></font></td>";
			}
			echo "</tr></table>";
			
			$resulta2 = estado_cfi::select3($historia,$cargo,$tratamiento);
			echo "<table border='1' align='center'>
			<tr>
			
			<th>Medicamento</th>
			<th>Forma Farmaceutica</th>
			<th>Dosis</th>
			<th>Cada Horas</th>
			<th>Por Días</th>
			<th>Cantidad Total</th>
			<th>Estado del Medicamento</th>
			</tr>";
			
			foreach($resulta2 as $rows){
				if ($rows->estado == 'E') {
					$esta1 = 'ENVIADO (SIN PROCESAR)';
					}else if ($rows->estado == 'P'){ 
					$esta1 = 'EN PROCESO';
					}else if ($rows->estado == 'X'){ 
					$esta1 = 'CANCELADO';
					}else if ($rows->estado == 'F'){ 
					$esta1 = 'FINALIZADO';
					} else { 
					$esta1 = 'Estado no definido';
				}
				
				echo "<tr>";
				echo "<td>" . $rows->medicamento . "</td>";
				echo "<td>" . $rows->descripcion . "</td>";
				echo "<td>" . $rows->dosis . "</td>";
				echo "<td>" . $rows->horas . "</td>";
				echo "<td>" . $rows->dias . "</td>";
				echo "<td>" . $rows->cantidad . "</td>";
				echo "<td><font color='green'><b>" . $esta1 . "</b></font></td>";
				
				echo "</tr>";
			}
			echo "</table> <p>"; 
		
		    $Recordset1 = estado_cfi::select4($historia,$tratamiento,$cargo);
			
		?>
		
		<a href="javascript:toggleDiv('myContent<? echo $u ?>');">Ver Detalle de Entregas</a>
		<div id="myContent<? echo $u ?>" style=" padding: 5px 10px; display: none;">
			<table border="1px">
				<tr>
					<th>No. Despacho</th>
					<th>Medicamento</th>
					<th>Cantidad</th>
					<th>Precio Unitario</th>
					<th>Fecha de Solicitud</th>
					<th>Nave</th>
					<th>No. de Cargo</th>
					<th>Factura Fiscal</th>
					<th>Estado Prod</th>
					<th>Reimprimir Cargo</th>
					
				</tr>
				
				
				<?php foreach($Recordset1 as $row_Recordset1) {
					 
					if ($row_Recordset1->estado_producto == 'E'){
						$est = 'ENVIADO (SIN PROCESAR)';
						}else if  ($row_Recordset1->estado_producto == 'P'){
						$est = 'PROCESADO';
						}else if  ($row_Recordset1->estado_producto == 'X'){
						$est = 'CANCELADO';
						}else{
						$est = 'Estado no definido';
					}
					
					if ($row_Recordset1->stat == 'S') {
						$ho = 'N/A';
						} else {
						$yres = estado_cfi::select5($hora_evento_carro);
						foreach(($yres as $yrow){
							$cc = $yrow->codigo_carro;
						}
						
						$ho = $cc. '-' .$row_Recordset1->hora_evento_carro;
					}
					
					
					$imcar = $row_Recordset1->cargo;
					$imhis = $row_Recordset1->historia;
					$imtrat = $row_Recordset1->tratamiento;
					$imfact = $row_Recordset1->factura;
					$imuser = $row_Recordset1->ordenado_por;
					
					
					
				?>
				
				<tr>
					
					
					
					
					<td><?php echo $row_Recordset1->despacho; ?></td>
					<td><?php echo $row_Recordset1->medicamento ?> </td>
					<td><?php echo $row_Recordset1->cantidad ?> </td>
					<td><?php echo $row_Recordset1->precio_unitario ?> </td>
					<td><?php echo $row_Recordset1->fecha_creacion ?> </td>
					<td><?php echo $ho ?> </td>
					<td><?php if  ($row_Recordset1->estado_producto != 'X') { echo $row_Recordset1->fa; }  ?></td>
					<td><?php if  ($row_Recordset1->estado_producto != 'X') { echo $row_Recordset1->factura_fiscal; } ?> </td>
					<td><font color="green"><b><?php echo $est ?></b></font></td>
					<td><input type="button" name="reimp" id="reimp" value="Reimprimir" onClick="window.open('reimprimir_factura_atc.php?factura=<?php echo $imfact; ?>')" /></td>
					
				<?php  } ?> 
				
				</tr>
			</table>
			
			<p></p>
			
			
		</div>
		
		<?php $u = $u + 1; 
			
			$Recordset2 = estado_cfi::select6($historia,$tratamiento,$cargo);
			$num = count($Recordset2);
			if ($num > 0) {
			?>
			
			<a href="javascript:toggleDiv('my2Content<? echo $v ?>');">Ver Detalle de Devoluciones</a>
			<div id="my2Content<? echo $v ?>" style=" padding: 5px 10px; display: none;">
				
                <table border="1px">
					<tr>
						<th>No. Devolucion</th>
						<th>Medicamento</th>
						<th>Cantidad</th>
						<th>Precio Unitario</th>
						<th>Fecha de Solicitud</th>
						<th>Factura Fiscal</th>
						<th>No Aceptada?</th>
						<th>No.FA</th>
					</tr>
					
					
					<?php foreach($Recordset2 as $row_Recordset2) { ?>
						<tr>
							
							<td><?php echo $row_Recordset2->devolucion; ?></td>
							<td><?php echo $row_Recordset2->medicamento ?> </td>
							<td><?php echo $row_Recordset2->cantidad ?> </td>
							<td><?php echo $row_Recordset2->precio_unitario ?> </td>
							<td><?php echo $row_Recordset2->fecha_creacion ?> </td>
							<td><?php echo $row_Recordset2->factura_fiscal ?> </td>
							<td><font color='red'><b><?php echo $row_Recordset2->no_aceptada; ?></b></font></td>
							<td><?php echo $row_Recordset2->fa; ?></td>
							
						<?php  } ?> 
						
					</tr>
				</table>
			</div>
			
			<?php $v = $v + 1;
				
				} else {
			?>
			
			<p> No tiene devoluciones <br />
				<?php }
				
				
				
				
				
				
			}  ?>
			<?php 
				echo "  <hr /><p>";
				
			}
			/*
			$d = "select registro.historia, registro.nombre_paciente, registro.estado, registro.cargo from registro, tratamiento where registro.tratamiento = tratamiento.tratamiento and tratamiento.historia = registro.historia and tratamiento.estado = 'A' and ".implode(" AND ",$where);*/
			
			layout::fin_content();
	?>
	<script type="text/javascript">
		function toggleDiv(divId) {
			$("#"+divId).toggle();
		}
	</script>		