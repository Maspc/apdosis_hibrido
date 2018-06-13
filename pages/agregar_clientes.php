<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/agregar_clientes.php');
	$cont = 0;
	if (isset($_GET['no_code'])){
		$no_code = $_GET['no_code'];
		} else {
		$no_code = 0;
	}
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
?>
<center>    <h1>Agregar Clientes</h1></center>
<div class="content_box_inner">
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="agregar_med" id="agregar_med">
		<table  border="0">
			<tr>
				<td width="100">Cédula / RUC </td>
				<td width="608">
				<input type="text" name="cedula" size="50" required="required"/>   </td>
			</tr>
			<tr>
				<td width="100">Nombre </td>
				<td><input type="text" name="nombre" size="100" required="required" /></td>
			</tr>
			<tr>
				<td width="100">Apellido</td>
				<td><input type="text" name="apellido" size="100" required="required"  /></td>
			</tr>
			<tr>
				<td width="100">Teléfono </td>
				<td><input type="text" name="telefono" size="25"  /></td>
			</tr>
			<tr>
				<td width="100">Límite de Crédito </td>
				<td><input type="text" name="limite_credito" size="25"  /></td>
			</tr>
			<tr>
				<td width="100">Tipo Cliente </td>
				<td><select name="tipo_cliente">
					<?php 
						$cols = clientes::tclientes();
						foreach($cols as $cs){
							echo '<option value="'.$cs->codigo_tipo.'">'.$cs->descripcion.'</option>';
						}
					?> 
				</select></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="Guardar Cliente"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<?  
						if(isset($_POST['submit'])){
							
							
							
							if(isset($_POST['nombre'])){
								$nombre = $_POST['nombre'];
							}
							if(isset($_POST['apellido'])){
								$apellido = $_POST['apellido'];
							}
							if(isset($_POST['cedula'])){
								$cedula = $_POST['cedula'];
							}
							if(isset($_POST['telefono'])){
								$telefono = $_POST['telefono'];
							}
							if(isset($_POST['tipo_cliente'])){
								$tipo_cliente = $_POST['tipo_cliente'];
							}
							if(isset($_POST['limite_credito'])){
								$limite_credito = $_POST['limite_credito'];
							}
							
							clientes::guarda_cliente($cedula, $nombre, $apellido, $telefono, $tipo_cliente, $limite_credito, $_SESSION['MM_iduser']);
							
							//$id = mysql_insert_id();
							
							echo "<font color='blue'><b>Se ha insertado el cliente ".$nombre.' '.$apellido." con éxito</b></font>";
							
						} ?></td>
			</tr>
		</table>
		
	</form>
	
</div>
<?=layout::fin_content()?>
<script type="text/javascript">
	$(document).ready(function() {
		
		//$("#agregar_med").validate();
		
		function log(event, data, formatted) {
			$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
		}
		
		function formatItem(row) {
			return row[0] + " (<strong>id: " + row[1] + "</strong>)";
		}
		function formatResult(row) {
			return row[0].replace(/(<.+?>)/gi, '');
		}
				
		
		$("#clear").click(function() {
			$(":input").unautocomplete();
		});
		
		
	});
	
	
	
</script>



<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=200');");
	}
	// End -->
</script>


<script language="javascript">
	<!-- Begin
	function enable()
	{
		// content  
		//alert("check");
		
		window.location='agregar_medicamentos_us.php?no_code=1';
		
	}
	
	function disable()
	{
		// content
		//alert("uncheck");
		window.location='agregar_medicamentos_us.php?no_code=0'
	}
	// End -->
</script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>