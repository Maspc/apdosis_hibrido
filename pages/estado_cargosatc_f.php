<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/estado_cargosatc_f.php');
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
										
					$resulta = estadoc_f::select1($where);
					
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
							
							$res = estadoc_f::select2($historia,$tratamiento,$cargo);
							
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
												
						$resulta2 = estadoc_f::select3($historia,$cargo,$tratamiento);
						echo "<table border='1' align='center'>
						<tr>
						
						<th>Medicamento</th>
						<th>Forma Farmaceutica</th>
						<th>Dosis</th>
						<th>Cada Horas</th>
						<th>Por Días</th>
						<th>Cantidad Total</th>
						<th>Estado del Medicamento</th>
						<th>Interrumpido por</th>
						<th>Fecha de Interrupcion</th>
						<th>Razon de Interrupcion </th>
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
							
							if ($rows->razon_int == '1') {
								$razon = 'Cambio de Medicamento';
								}else if ($rows->razon_int == '2'){ 
								$razon = 'Suspension de Medicamentos';
								} else { 
								$razon = ' ';
							}
							
							echo "<tr>";
							echo "<td>" . $rows->medicamento . "</td>";
							echo "<td>" . $rows->descripcion . "</td>";
							echo "<td>" . $rows->dosis . "</td>";
							echo "<td>" . $rows->horas . "</td>";
							echo "<td>" . $rows->dias . "</td>";
							echo "<td>" . $rows->cantidad . "</td>";
							echo "<td><font color='green'><b>" . $esta1 . "</b></font></td>";
							echo "<td>" . $rows->interrumpido_por . "</td>";
							echo "<td>" . $rows->fecha_interrupcion . "</td>";
							echo "<td>" . $razon . "</td>";
							echo "</tr>";
						}
						echo "</table> <p>"; 
						
						
						echo "<p>";
						echo "<input type='button' name='detalle' value='Ver Detalle de Entregas/Devoluciones' onClick=\"modalWin('ver_entregas.php?historia=".$rows7->historia."&tratamiento=".$rows7->tratamiento."&cargo=".$rows7->cargo."')\" /> ";
						echo "<p>";
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