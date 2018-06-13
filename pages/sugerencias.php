<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/sugerencias.php');
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
		<center><h1>Sugerencias de Medicamentos</h1></center>
		<?php
			if(isset($_GET['men'])){
				$men = 1;
				}else {
				$men = 0;
			}
			if($men == 1){			
				echo "No puede enviar ni el medicamento ni la forma farmaceutica en blanco";
			}
		?>
		<table width="780" border="0" cellspacing="0" align="center" >
			
			<tr>
				<td>
					<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
						<tr>
							<td>Nombre de Medicamento:</td>
							<td><input name="medicamento" type="text" size="80" required="required" /></td>
						</tr>
						<tr>
							<td>Forma Farmaceutica:</td>
							<td><input name="forma_farmaceutica" type="text" size="50" required="required" /></td>
						</tr>
						<tr>
							<td width="194">Observacion:</td>
							<td width="278"><textarea name="observacion"></textarea> </td>
						</tr>
					</table>
					
					
					<div align="center">
						<input name="enviar" type="submit" value="Enviar" />  
					</div>
					
				</td>
			</tr>
		</table>
		
	</form>
	<?php     
		if(isset($_POST['enviar'])){
			
			$men = 0;
			if(isset($_POST['medicamento'])){
				$medicamento = $_POST['medicamento']; 
				}else{
				$men = 1;
			}
			if(isset($_POST['forma_farmaceutica'])){
				$forma_farmaceutica = $_POST['forma_farmaceutica'];
				}else{
				$men = 1;
			}
			if(isset($_POST['observacion'])) {
				$observacion = $_POST['observacion'];
				}else{
				$observacion = 'Ninguna';
			}
			
			
			if($men == 1) {
				echo "<script language='javascript'>window.location='sugerencias.php?men=1&userid=$userid&session=$session'</script>";
			}
			
			
			
			sugerencias::insert1($medicamento,$forma_farmaceutica,$observacion,$userid);
			//	$resulta = mysql_query($f, $conn) or die(mysql_error());
			
			echo "<p> La sugerencia fue enviada a farmacia! </p>";
			
			
			
			//echo "  <hr /><p>";
			
		}
		
		
		
		
		/*
		$d = "select registro.historia, registro.nombre_paciente, registro.estado, registro.cargo from registro, tratamiento where registro.tratamiento = tratamiento.tratamiento and tratamiento.historia = registro.historia and tratamiento.estado = 'A' and ".implode(" AND ",$where);*/
		
		
		
		
		
		} else { 
		
	echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>"; }  
	
	layout::fin_content();
?> 				