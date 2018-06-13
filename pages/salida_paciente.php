<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/salida_paciente.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	if (isset($_GET->userid)){
	$userid = $_GET->userid;}
	if (isset($_GET->session)){
	$session = $_GET->session;}
	include('sesion_activa.php');
	if ($estado_sesion == 'A') {
	?>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%"><font color="#B8C0F0" face="Arial" size="2">
				
				<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
				<!-- End css3menu.com BODY section --><ul id="css3menu1" class="topmenu">
					<li class="topfirst"><a href="historia.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>&username=<?php echo urlencode($username) ?>" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Principal</a></li>
					<li class="topmenu"><a href="historia.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>&username=<?php echo urlencode($username) ?>" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Ordenes</span></a>
						<li class="topmenu"><a href="devolucion.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/register.png" alt=""/>Devoluciones</a></li>
						<li class="topmenu"><a href="http://192.168.3.2/CMP_CONTRAINDICACIONES/_contraindicaciones.aspx?UserId=<?php echo $userid ?>&IdSession=<?php echo $session ?>&userName=<?php echo $userName ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contraindicaciones</a></li>
						<li class="topmenu"><a href="estado_cargos.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
						<li class="topmenu"><a href="interrumpir_medicamento.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Interrumpir Medicamentos</a></li>
						<li class="topmenu"><a href="salida_paciente.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Salida de Paciente</a></li>
						<li class="topmenu"><a href="perfil_farmaceutico_h.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/register.png" alt=""/>Perfil Farmaceutico</a></li>
						<li class="topmenu"><a href="sugerencias.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/register.png" alt=""/>Sugerencias</a></li>
						<li class="topmenu"><a href="imprimir_inv_hosp.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Listado de Medicamentos</a></li>
						<li class="toplast"><a href="http://192.168.3.2/cmp_appdosis/"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Salir</a></li>
					</ul>
					<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
					<!-- End css3menu.com BODY section -->
					
					
				</font></td>
			</tr>
		</table>
		<form action="<?php $_SERVER->PHP_SELF; ?>" method="post" name="estado" id="estado">
            <center><h1>Salida del Paciente</h1></center>
			<table width="780" border="0" cellspacing="0" >
				
				<tr>
					<td>
						<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
							<tr>
								<td>Historia</td>
								<td><input name="historia" type="text" size="20" required /></td>
							</tr>
							<tr>
								<td width="194">Razón de Salida</td>
								<td width="278"><select name="razon"><option value="1">Salida del Paciente</option><option value="2">Deceso del Paciente</option></select></td>
							</tr>
							
						</table>
						
						
						<div align="center">
							<input name="buscar" type="submit" value="Visualizar Ordenes" />  
						</div></td>
				</tr>
			</table>
		</form>
		<?php     
			if(isset($_POST->buscar)){
				$historia = $_POST->historia;
				//$tratamiento = $_POST->tratamiento;
				$razon = $_POST->razon;
				
				
				
				$resulta = salida_p::select1($historia);
				
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
					echo "<p>";
					echo "<input type='button' name='salida' value = 'Salida de Paciente' onClick=\"window.location.href='procesar_salida.php?tratamiento=".$tratamiento."&historia=".$historia."&userid=".$userid."&session=".$session."&razon=".$razon."'\"/>";
					echo "<p>";
					
					echo "<center><h1>No. de Orden ". $rows7->cargo."</h1></center>";
					echo "<p><table border='1' align='center'>
					<th>Historia</th>
					<th>Nombre</th>
					<th>Estado de Orden</th>
					";
					if ($rows7->stat == 'S')  {
						echo "<th>Tipo</th>";
					}
					
					$tratamiento = $rows7->tratamiento;
					
					echo "<tr>
					<td>".$rows7->historia."</td>
					<td>".$rows7->nombre_paciente."</td>
					<td><font color='green'><b>".$esta."</b></font></td>";
					if ($rows7->stat == 'S') {
						echo "<td><font color='red'><b>STAT</b></font></td>";
					}
					echo "</tr></table>";
					
					
					
					
					$resulta2 = salida_p ::select2($_POST->historia,$rows7->cargo);
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
					
				}
			}
			
			
			
			} else { 
			
		echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>"; } 
		
		layout::fin_content();
	?>
	
	<script type="text/javascript">
		function toggleDiv(divId) {
			$("#"+divId).toggle();
		}
	</script>		