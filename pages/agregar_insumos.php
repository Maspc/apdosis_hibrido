<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	require_once('../modulos/agregar_insumos.php');
	$cont = 0;
	if (isset($_GET['no_code'])){
		$no_code = $_GET['no_code'];
		} else {
		$no_code = 0;
	}
	
	
	
	function generaGrupos()
	{
		//include 'conexion.php';
		//conectar();
		$consulta=ainsumos::gmedica();
		//desconectar();
		
		// Voy imprimiendo el primer select compuesto por los paises
		echo "<select name='grupo_medicamento' id='grupo_medicamento' onChange='cargaContenido(this.id)'>";
		echo "<option value='0'>Elige</option>";
		foreach($consulta as $con){
			echo "<option value='".$con->codigo_grupo."'>".$con->descripcion."</option>";
		}
		echo "</select>";
	}
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
	?>
<center>    <h1>Agregar Productos</h1></center>
<div class="content_box_inner">
	<form action="<? $_SERVER['PHP_SELF']; ?>" method="post" name="agregar_med" id="agregar_med">
		<table width="1000" border="0">
			<tr><td><input type="checkbox" name="no_code" id="no_code" value="1" onclick="if (this.checked) { enable(); } else { disable(); }" <?php if ($no_code == '1') { echo " checked"; } ?>/></td><td>Este producto NO tiene codigo de barra</td></tr>
			<tr>
				<td width="100">Código de Barra </td>
				<td width="608">
				<input type="text" name="codigo_de_barra" size="50"  <?php if ($no_code != '1') { echo "required=\"required\""; } else { echo "disabled"; } ?> />   </td>
			</tr>
			<tr>
				<td width="100">Descripción </td>
				<td><input type="text" name="nombre_comercial" size="100" required="required" /></td>
			</tr>
			<tr>
				<td width="100">Marca</td>
				<td><input type="text" name="nombre_generico" size="100" required="required" /></td>
			</tr>
			
			<tr>
				<td width="100">Codigo Proveedor</td>
				<td><input type="text" name="codigo_proveedor" size="100"  /></td>
			</tr>
			<tr>
				<td width="100">Proveedor Principal </td>
				<td><select name="proveedor_principal" >
					<?php 
						$provee = ainsumos::provee();
						foreach($provee as $pr){
							echo '<option value="'.$pr->id_proveedor.'">'.$pr->nombre.'</option>';
						}
					?> 
				</select></td>
			</tr>
			<tr>
				<td width="100">Cantidad M&iacute;nima para Proveedor Principal </td>
				<td><input type="text" name="cant_max_prov" size="25"  /></td>
			</tr>
			
			
			<!-- <tr>
				<td>Costo Unitario</td>
				<td><label>Bl/.<input type="text" name="costo_unitario" size="20" align="right" /></label></td>
			</tr> -->
			<tr>
				<td width="100">Cantidad Inicial </td>
				<td><input type="text" name="cantidad_inicial" size="20" align="right" readonly /></td>
			</tr>
			<tr>
				<td width="100">Tipo de Impuesto </td>
				<td><label><select name="tipo_impuesto"> 
					<?php 
						$timpuesto = ainsumos::timpuesto();
						foreach($timpuesto as $tp){
							echo '<option value="'.$tp->tipo_impuesto.'">'.$tp->factor.'</option>';
						}
					?> 
					
				</select></label></td> </tr>
				
				
				<tr><td width="100">Aplica Decto. Jubilado</td>
					<td><label><input name='jubilado' size='50' type='checkbox'  value='S' /></label></td>
				</tr>
				
				<tr><td width="100">Aplica Decto. Tipo de Cliente</td>
					<td><label><input name='descuento_total' size='50' type='checkbox'  value='S' /></label></td>
				</tr>
				
				<tr><td width="100">Grupo de Productos</td>
					<td><label><?php generaGrupos(); ?></label></td>
				</tr>
				<tr><td width="100">Subgrupo de Productos</td>
					<td><label><select disabled="disabled" name="sub_grupo" id="sub_grupo">
						<option value="0">Selecciona opci&oacute;n...</option>
					</select></label></td>
				</tr>
				
				
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit" value="Guardar Producto"/></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<?  
							if(isset($_POST['submit'])){
								if(isset($_POST['codigo_de_barra'])){
									$codigo_de_barra = $_POST['codigo_de_barra'];
									} else {		
									
									$codigo_de_barra = ainsumos::codigoBarra();														
								}
								
								
								if(isset($_POST['nombre_generico'])){
									$nombre_generico= $_POST['nombre_generico'];
								}
								
								if(isset($_POST['codigo_enlace'])){
									$codigo_enlace = $_POST['codigo_enlace'];
								}
								
								if(isset($_POST['nombre_comercial'])){
									$nombre_comercial= $_POST['nombre_comercial'];
								}
								
								
								if(isset($_POST['proveedor_principal'])){
									$proveedor_principal= $_POST['proveedor_principal'];
								}												
								
								
								if(isset($_POST['sub_grupo'])){
									$sub_grupo= $_POST['sub_grupo'];
									} else {
									$sub_grupo = 1;
								}
								
								if(isset($_POST['cantidad_inicial'])){
									$cantidad_inicial = $_POST['cantidad_inicial'];
									} else {
									$cantidad_inicial = 0;
								}
								if(isset($_POST['costo_unitario'])){
									$costo_unitario = $_POST['costo_unitario'];
									} else {
									$costo_unitario = 0;
								}
								
								if(isset($_POST['codigo_proveedor'])){
									$codigo_prov = $_POST['codigo_proveedor'];
									} else {
									$codigo_prov = ' ';
								}
								
								if(isset($_POST['tipo_impuesto'])){
									$tipo_impuesto = $_POST['tipo_impuesto'];
								} else
								{
									$tipo_impuesto = 0;
								}
								
								if(isset($_POST['grupo_medicamento']) || $_POST['grupo_medicamento'] == 0 ){
									$grupo_medicamento = $_POST['grupo_medicamento'];
									} else {
									$grupo_medicamento = 12;
								}	
								
								
								if(isset($_POST['jubilado'])){
									$jubilado = $_POST['jubilado'];
									} else {
									$jubilado = 'N';
								}	
								
								
								if(isset($_POST['descuento_total'])){
									$descuento_total = $_POST['descuento_total'];
									} else {
									$descuento_total = 'N';
								}	
								
								if(isset($_POST['cant_max_prov'])){
									$cant_max_prov = $_POST['cant_max_prov'];
									} else {
									$cant_max_prov = '0';
								}												
								
								
								$porcentaje_ganancia = ainsumos::PorcenGana($grupo_medicamento,$sub_grupo);
								
								ainsumos::procesaInfo($codigo_de_barra, $nombre_generico,  $nombre_comercial, $_SESSION['MM_user'], $cantidad_inicial, $codigo_prov, $costo_unitario, $tipo_impuesto, $grupo_medicamento, $sub_grupo, $jubilado, $descuento_total,$cant_max_prov,$porcentaje_ganancia,$proveedor_principal);
								
								echo "<font color='blue'><b>Se ha insertado el producto ".$nombre_generico." ".$nombre_comercial." con ÃƒÂ©xito</b></font>";
								
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
		
		window.location='agregar_insumos.php?no_code=1';
		
	}
	
	function disable()
	{
		// content
		//alert("uncheck");
		window.location='agregar_insumos.php?no_code=0'
	}
	// End -->
</script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../js/select_dependientes.js"></script>