<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/devolucion.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	if (isset($_GET['userid'])){
	$userid = $_GET['userid'];}
	if (isset($_GET['session'])){
	$session = $_GET['session'];}
	include('sesion_activa.php');
	if ($estado_sesion == 'A') {
		
		
	?>
	
	
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="estado" id="estado">
		<center><h1>Devoluciones</h1></center>
		
		<table width="780" border="0" cellspacing="0" align="center" >
			
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
						<tr>
							<td width="194">C&oacute;digo de Barra</td>
							<td width="278"><input name="codigo" type="text" size="20" /></td>
						</tr>
					</table>
					
					
					<div align="center">
						<input name="buscar" type="submit" value="Buscar Orden" />  
					</div></td>
			</tr>
		</table>
		
		<center>	<p>Para realizar una devoluci&oacuten debe existir la factura fiscal del medicamento a devolver.</p></center>
	</form>
	<?php     
		if(isset($_POST['buscar'])){
			if(isset($_POST['codigo']) && $_POST['codigo']!=""){
				$codigo = $_POST['codigo'];
				$factura_codigo = ltrim(substr($codigo, 0,9),'0');
				$linea_codigo = ltrim(substr($codigo, 9,2),'0');
				//echo "codigo: ".$codigo;
				//echo "factura: ".$factura_codigo;
				//echo "linea: ".$linea_codigo;
				
				
				
				$Recordset1 = dv::select1($factura_codigo);
				
			?>
			
			
			<table border="1px" align="center">
				<tr>
					<th>No. Despacho</th>
					<th>Medicamento</th>
					<th>Cantidad</th>
					<th>Fecha de Factura</th>
					<th>Nave</th>
					<th>No. de Cargo</th>
					<th>Devolucion?</th>
				</tr>
				
				
				<?php foreach($Recordset1 as $row_Recordset1){
					
					if ($row_Recordset1->estado_producto == 'E'){
						$est = 'ENVIADO (SIN PROCESAR)';
						}else if  ($row_Recordset1->estado_producto == 'P'){
						$est = 'PROCESADO';
						}else if  ($row_Recordset1->estado_producto == 'X'){
						$est = 'CANCELADO';
						}else{
						$est = 'Estado no definido';
					}
				?>
				
				<tr>
					
					
					
					
					<td><?php echo $row_Recordset1->despacho; ?></td>
					<td><?php echo $row_Recordset1->medicamento ?> </td>
					<td><?php echo $row_Recordset1->cantidad ?> </td>
					<td><?php echo $row_Recordset1->fecha_creacion ?> </td>
					<td><?php echo $row_Recordset1->hora_evento_carro ?> </td>
					<td><?php echo $row_Recordset1->fa; ?></td>
					<td><input type="button" name="devolver" value="Devolver de este Cargo" onClick="parent.location='devolucion_proceso.php?cargo=<?php echo $row_Recordset1->fa; ?>&userid=<?php echo $userid ?>&session=<?php echo $session ?>'" <?php if ($row_Recordset1->fa == '') { echo " disabled "; } ?>></td>
					
				<?php   } ?> 
				
				</tr>
			</table>
			
			
			<?
				
				
				} else {	
				
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
				
				
				
				$resulta = dv::select2($where);
				
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
					
					";
					if ($rows7->stat == 'S')  {
						echo "<th>Tipo</th>";
					}
					
					echo "<tr>
					<td>".$rows7->historia."</td>
					<td>".$rows7->nombre_paciente."</td>";
					echo "</tr></table>";
					
					
					$resulta2 = dv::select3($_POST->historia,$rows7->cargo);
					echo "<table border='1' align='center'>
					<tr>
					
					<th>Medicamento</th>
					<th>Forma Farmaceutica</th>
					<th>Dosis</th>
					<th>Cada Horas</th>
					<th>Por Días</th>
					<th>Cantidad Total</th>
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
						
						
						echo "</tr>";
					}
					echo "</table> <p>"; 
					
					
					$Recordset1 = dv::select4($rows7->historia,$rows7->tratamiento,$rows7->cargo);
					
				?>
				
				<a href="javascript:toggleDiv('myContent<? echo $u ?>');">Ver Detalle de Entregas</a>
				<div id="myContent<? echo $u ?>" style=" padding: 5px 10px; display: none;">
					<table border="1px" align="center">
						<tr>
							<th>No. Despacho</th>
							<th>Medicamento</th>
							<th>Cantidad</th>
							<th>Fecha de Factura</th>
							<th>Nave</th>
							<th>No. de Cargo</th>
							<th>Devolucion?</th>
						</tr>
						
						
						<?php foreach($Recordset1 as $row_Recordset1){ 
							
							if ($row_Recordset1->estado_producto == 'E'){
								$est = 'ENVIADO (SIN PROCESAR)';
								}else if  ($row_Recordset1->estado_producto == 'P'){
								$est = 'PROCESADO';
								}else if  ($row_Recordset1->estado_producto == 'X'){
								$est = 'CANCELADO';
								}else{
								$est = 'Estado no definido';
							}
						?>
						
						<tr>
							<td><?php echo $row_Recordset1->despacho; ?></td>
							<td><?php echo $row_Recordset1->medicamento ?> </td>
							<td><?php echo $row_Recordset1->cantidad ?> </td>
							<td><?php echo $row_Recordset1->fecha_creacion ?> </td>
							<td><?php echo $row_Recordset1->hora_evento_carro ?> </td>
							<td><?php echo $row_Recordset1->fa; ?></td>
							<td><input type="button" name="devolver" value="Devolver de este Cargo" onClick="parent.location='devolucion_proceso.php?cargo=<?php echo $row_Recordset1->fa; ?>&userid=<?php echo $userid ?>&session=<?php echo $session ?>'" <?php if ($row_Recordset1->fa == '') { echo " disabled "; } ?>></td>
							
						<?php  $u = $u + 1; }?> 
						
						</tr>
					</table>
				</div>
				
				
				<?php 
					echo "  <hr /><p>";
					
				}
				
				
				
				
				/*
				$d = "select registro.historia, registro.nombre_paciente, registro.estado, registro.cargo from registro, tratamiento where registro.tratamiento = tratamiento.tratamiento and tratamiento.historia = registro.historia and tratamiento.estado = 'A' and ".implode(" AND ",$where);*/
				
				
			}
			
		}
		
		
		} else {
		echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>"; 
	}	
	
	layout::fin_content();
?>
<script type="text/javascript">
	function toggleDiv(divId) {
		$("#"+divId).toggle();
	}
</script><!-- End css3menu.com HEAD section -->