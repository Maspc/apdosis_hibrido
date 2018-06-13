<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/interrumpir_medicamento.php');
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
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="interrupcion" id="interrupcion">
		
		<center><h1>Interrupci&oacute;n de Medicamentos</h1></center>
		<table width="780" border="0" cellspacing="0" >
			
			<tr>
				<td>
					<table width="780" border="0" cellspacing="0" >
						
						<tr>
							<td>
								<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
									<tr>
										<td>Historia</td>
										<td><input name="historia" id="historia" type="text" size="20" required="required" /></td>
									</tr>
									<tr>
										<td width="194">Orden</td>
										<td width="278"><input name="cargo" id="cargo" type="text" size="20" required="required" /></td>
									</tr>
								</table>
								
								
								
								<div align="center">
									<input name="buscar" type="submit" value="Buscar Orden" />
								</div>
							</td>
						</tr>
						
					</table>
				</form>
				<?php     
					if(isset($_POST['buscar'])){
						$cargo = $_POST['cargo'];
						$historia = $_POST['historia'];
						
						//echo "<h1>Orden No. 000".$historia."-000".$tratamiento."-000".$cargo."  </h1>";
						
						
						
						$resulta = int_m::select1($cargo,$historia);
						
						
						
						$resulta6 = int_m::select2($cargo,$historia);
						$resnum = count($resulta6);
						echo "<table border='1' align='center'>
						<th>Historia</th>
						<th>Nombre</th>
						";
						
						foreach($resulta6 as $rows6){
							$tratamiento = $rows6->tratamiento;
							
							$stat = $rows6->stat;						
							
							echo "
							<tr>
							<td>".$rows6->historia."</td>
							<td>".$rows6->nombre_paciente."</td>
							</tr>
							";
							
						}
						
						if ($stat != 'S') {
							
							echo "</table>";
							echo "<table border='1' align='center'>
							<tr>
							
							<th>Medicamento</th>
							<th>Forma Farmaceutica</th>
							<th>Dosis</th>
							<th>Cada Horas</th>
							<th>Por D&iacute;as</th>
							</tr>";
							
							foreach($resulta as $rows){
								{
									echo "<tr>";
									echo "<td>" . $rows->medicamento . "</td>";
									echo "<td>" . $rows->descripcion . "</td>";
									echo "<td>" . $rows->dosis . "</td>";
									echo "<td>" . $rows->horas . "</td>";
									echo "<td>" . $rows->dias . "</td>";
									
									echo "</tr>";
								}
								echo "</table> <p>";
								
								
								
								echo "  <hr /><p>";
								
								//echo "<h1>Interrupci&oacute;n de Medicamentos </h1> <p>";
								
								
								
								$gres = int_m::select3($cargo,$historia);
								
								$gnum = count($gres);
								
								if ($gnum > 0){
									
									echo "<form name='int' method='post' action='enviar_int_medicamento.php' onsubmit='return checkCheckBoxes(this);'>";
									
									echo "<table border='1' align='center'>
									<tr>
									
									<th>Medicamento</th>
									<th>Forma Farmaceutica</th>
									<th>Dosis</th>
									<th>Cada Horas</th>
									<th>Por D&iacute;as</th><th>Cantidad de Dosis</th><th>Interrupci&oacute;n</th><th>Causa de Interrupci&oacute;n</th>
									</tr>";
									
									
									
									$cargo2 = $_POST['cargo'];
									
									
									
									
									$resulta2 = int_m::select4($cargo2,$historia);
									
									
									foreach($resulta2 as $rows){
										echo "<tr>";
										echo "<td> <input type='text' name= 'medicamento[]' value='" . $rows->medicamento ."' readonly /> <input type='hidden' name='medicamento_id[]' value='" . $rows->medicamento_id ."'/> <input type='hidden' name='cargo' value='" . $cargo2 ."'/></td>";
										echo "<td> <input type='text' name='forma[]' value='" . $rows->descripcion ."' readonly /></td>";
										echo "<td> <input type='text' name='dosis[]' value='" . $rows->dosis ."' readonly /></td>";
										echo "<td> <input type='text' name='horas[]' value='" . $rows->horas ."' readonly /></td>";
										echo "<td> <input type='text' name='dias[]' value='" . $rows->dias ."' readonly /></td>";
										echo "<td> <input type='text' name='cant[]' value='" . $rows->cantidad_de_dosis ."' readonly /></td>";
										echo "<td> <input type='checkbox' name='ine[]' value='".$rows->linea."'/></td>";
										echo "<td> <select name='razon[]' /><option value='1'>Cambio de Medicamento</option><option value='2'>Suspension de Medicamentos</option><option value='3'>Rechazo del Paciente</option></td>";
										echo "<input type='hidden' name='tratamiento' value='" . $tratamiento ."' readonly />";
										echo "<input type='hidden' name='historia' value='" . $historia ."' readonly />";
										echo "<input type='hidden' name='userid' value='" . $userid ."' readonly />";
										echo "<input type='hidden' name='session' value='" . $session ."' readonly />";
										
										
										echo "</tr>";
									}
									
									echo "</table> <p>";
									
									echo "<input name='devolu' type='submit' value='Interrumpir Seleccionados' />";
									
									if ($resnum > 0) {
										
										echo "<p><p><a href='interrumpir.php?cargo=".$cargo2."&historia=".$historia."&tratamiento=".$tratamiento."&razon=2&userid=".$userid."&session=".$session."'>INTERRUMPIR EL CARGO COMPLETO </a><p>";
										
									}
									echo "</form>";
									
									echo "";
									
									
									
									} else {
									echo "<p><h2>Ya fueron procesados todos los cargos pendientes para esta orden, deber&aacute; realizar una devoluci&oacute;n cuando reciba la factura fiscal</h2>";
									
								}
								
								} else {
								echo "<p><h2>No se pueden interrumpir cargos STAT!!!</h2>";
							}
							
							
							} else { 
							
							echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>"; 
						} 
					}
	
					layout::fin_content();
				?>
				
				<script>
					$().ready(function() {
						
						$("#interrupcion").validate();
						
					});
				</script>
				
				
				<script type="text/javascript" language="JavaScript">
					<!--
					function checkCheckBoxes(theForm) {
						if (
						theForm.ine.checked == false) 
						{
							alert ('Debe escoger un medicamento para interrumpir');
							return false;
							} else { 	
							return true;
						}
					}
				//-->
			</script> 														