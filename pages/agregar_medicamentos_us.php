<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	require_once('../modulos/agregar_medicamentos_us.php');
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
<center>    <h1>Agregar Medicamentos</h1></center>
<div class="content_box_inner">
	<form action="<? $_SERVER['PHP_SELF']; ?>" method="post" name="agregar_med" id="agregar_med">
		<table width="500" border="0">
			<tr><td><input type="checkbox" name="no_code" id="no_code" value="1" onclick="if (this.checked) { enable(); } else { disable(); }" <?php if ($no_code == '1') { echo " checked"; } ?>/></td><td>Este medicamento NO tiene codigo de barra</td></tr>
			<tr>
				<td width="162">Código de Barra </td>
				<td width="608">
				<input type="text" name="codigo_de_barra" size="50"  <?php if ($no_code != '1') { echo "required=\"required\""; } else { echo "disabled"; } ?> />   </td>
			</tr>
			<tr>
				<td>Nombre Genérico </td>
				<td><input type="text" name="nombre_generico" size="100" required="required" /></td>
			</tr>
			<tr>
				<td>Nombre Comercial </td>
				<td><input type="text" name="nombre_comercial" size="100" required="required"  /></td>
			</tr>
			<tr>
				<td>Codigo Proveedor </td>
				<td><input type="text" name="codigo_proveedor" size="100"  /></td>
			</tr>
			<tr>
				<td>Forma Farmacéutica </td>
				<td><select name="forma_farma">
					<?php
						$ffarma = medicamentos::ffarma();
						foreach($ffarma as $ff){
							echo '<option value="'.$ff->codigo_forma.'">'.$ff->descripcion.'</option>';
						}
					?> 
				</select></td>
			</tr>
			<tr>
				<td>Concentraci&oacute;n</td>
				<td><input type="text" name="posologia" size="10" /> <select name="tipo_posologia">
					<?php
						$poso = medicamentos::posologia();
						foreach($poso as $ps){
							echo '<option value="'.$ps->codigo_posologia.'">'.$ps->descripcion.'</option>';
						}
					?> 
				</select></td>
			</tr>
			<tr>
				<td>Presentación</td>
				<td><select name="presentacion">
					<?php
						$present = medicamentos::present();
						foreach($present as $pr){
							echo '<option value="'.$pr->codigo_presentacion.'">'.$pr->descripcion.'</option>';
						}
					?> 
				</select></td>
			</tr>
			<tr>
				
				<td>Fabricante</td>
				<td><input type="text" name="fabricante" id="fabricante" size="50" required="required"><input name="fabricantes" type="button" value="Crear Nuevo Fabricante" onClick="javascript:popUp('anadir_fabricante.php')"/> 
					
				<input name="fabricante_id" type="hidden" id="fabricante_id" size="50" />				</td>
			</tr>
			
			<tr>
				<td>Volumen </td>
				<td><input type="text" name="volumen" size="20"  /><select name="tipo_volumen">
					<?php
						$volumen = medicamentos::posologia();
						foreach($volumen as $vl){
							echo '<option value="'.$vl->codigo_posologia.'">'.$vl->descripcion.'</option>';
						}
					?> 
				</select></td>
			</tr>
			
			<tr><td>Aplica Decto. Jubilado</td>
				<td><label><input name='jubilado' size='50' type='checkbox'   value='S'  /></label></td>
			</tr>
			
			<tr><td>Aplica Decto. Tipo de Cliente</td>
				<td><label><input name='descuento_total' size='50' type='checkbox'   value='S'  /></label></td>
			</tr>
			
			<tr><td>Grupo de Medicamentos</td>
				<td><label><select name="grupo_medicamento">
					<?php 
						$gmedica = medicamentos::gmedica();
						foreach($gmedica as $gm){
							echo '<option value="'.$gm->codigo_grupo.'">'.$gm->descripcion.'</option>';
						}
					?> 
				</select></label></td>
			</tr>
			
			
			<!--  <tr>
				<td>Costo</td>
				<td><label>Bl/.<input type="text" name="costo" size="20" align="right" readonly /></label></td>
			</tr> -->
			<tr>
				<td>Precio de Venta </td>
				<td><label>Bl/.<input type="text" name="precio_venta" size="20" align="right" readonly  /></label></td>
			</tr>
			<tr>
				<td>Cantidad Inicial </td>
				<td><input type="text" name="cantidad_inicial" size="20" align="right" readonly/></td>
			</tr>
			<tr><td>Antibiotico</td>
				<td><label><input name='antibiotico' size='50' type='checkbox'   value='S'  /></label></td>
			</tr>
			<tr><td>Narcotico</td>
				<td><label><input name='narcotico' size='50' type='checkbox'  value='S' /></label></td>
			</tr>
			<tr><td>Importación</td>
				<td><label><input name='importacion' size='50' type='checkbox'  value='S' /></label></td>
			</tr>
			<tr><td>&iquest;No se puede devolver?</td>
				<td><label><input name='devolver' size='50' type='checkbox'  value='S' /></label></td>
			</tr>
			<tr><td>Multiple Principio Activo</td>
				<td><label><input name='multiple_principio' size='50' type='checkbox'  value='S' /></label></td>
			</tr>
			<tr>
				
				<td>Contraindicaciones</td>
				<td>
					<?php
						$contrai = medicamentos::contrai();
						foreach($contrai as $ci){												
							echo '<label><input name="contraindicacion[]" type="checkbox" value="'.$ci->codigo_contraindicacion.'">'.$ci->descripcion.'</label><br/>';
						} 
					?>
				</td>
			</tr>
			<tr>
				<td>Otras Contraindicaciones (separar con comas)</td>
				<td><textarea name="otras" cols="50" rows="5"></textarea></td>
			</tr>
			<tr>
				<td>Tipo de Impuesto </td>
				<td><label><select name="tipo_impuesto"> 
					
					<?php
						$impuesto = medicamentos::impuesto();
						foreach($impuesto as $imp){
							echo '<option value="'.$imp->tipo_impuesto.'">'.$imp->factor.'</option>';
						}
					?> 
				</select></label></td>
			</tr> 
			<tr>
				<td>Anaquel </td>
				<td><label><select name="anaquel"> <?php for ($i=0;$i<=25;$i++) {	  
				?>
				<option value="<? echo $i ?>"><? echo $i ?></option>
				<?php } ?> </select></label></td>
			</tr> 
			<tr>
				<td>Proveedor Principal </td>
				<td><select name="proveedor_principal" >
					<?php
						$provee = medicamentos::provee();
						foreach($provee as $pr){
							echo '<option value="'.$pr->id_proveedor.'">'.$pr->nombre.'</option>';
						}
					?> 
				</select></td>
			</tr>
			<tr>
				<td>Cantidad M&iacute;nima para Proveedor Principal </td>
				<td><input type="text" name="cant_max_prov" size="25"  /></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><button type="submit" id="send">Guardar Medicamento</button></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<?  
						if(isset($_POST['submit'])){
							if(isset($_POST['codigo_de_barra'])){
								$codigo_de_barra = $_POST['codigo_de_barra'];
								} else {		
								$codigo_de_barra = medicamentos::codigoBarra();												
							}
							
							
							if(isset($_POST['nombre_generico'])){
								$nombre_generico = $_POST['nombre_generico'];
							}
							if(isset($_POST['nombre_comercial'])){
								$nombre_comercial = $_POST['nombre_comercial'];
							}
							if(isset($_POST['forma_farma'])){
								$forma_farmaceutica = $_POST['forma_farma'];
							}
							if(isset($_POST['posologia'])){
								$posologia = $_POST['posologia'];
							}
							if(isset($_POST['tipo_posologia'])){
								$tipo_posologia = $_POST['tipo_posologia'];
							}
							if(isset($_POST['presentacion'])){
								$presentacion = $_POST['presentacion'];
							}
							if(isset($_POST['fabricante_id'])){
								$fabricante = $_POST['fabricante_id'];
							}
							
							if(isset($_POST['precio_venta'])){
								$precio_venta = $_POST['precio_venta'];
								} else {
								$precio_venta = 0;
							}
							if(isset($_POST['cantidad_inicial'])){
								$cantidad_inicial = $_POST['cantidad_inicial'];
								} else {
								$cantidad_inicial = 0;
							}
							if(isset($_POST['tipo_dosis'])){
								$tipo_dosis = $_POST['tipo_dosis'];
								} else {
								$tipo_dosis = 'E';
							}
							if(isset($_POST['antibiotico'])){
								$antibiotico = $_POST['antibiotico'];
								} else {
								$antibiotico = 'N';
							}
							if(isset($_POST['narcotico'])){
								$narcotico = $_POST['narcotico'];
								} else {
								$narcotico = 'N';
							}
							if(isset($_POST['preparacion'])){
								$preparacion = $_POST['preparacion'];
								} else {
								$preparacion = 'N';
							}
							if(isset($_POST['multiple_principio'])){
								$multiple_principio = $_POST['multiple_principio'];
								} else {
								$multiple_principio  = 'N';
							}
							if(isset($_POST['devolver'])){
								$permite_devol = $_POST['devolver'];
								} else {
								$permite_devol = 'N' ;
							}
							if(isset($_POST['otras'])){
								$otras_contra = $_POST['otras'];
							}
							if(isset($_POST['codigo_proveedor'])){
								$codigo_prov = $_POST['codigo_proveedor'];
								} else {
								$codigo_prov = ' ';
							}
							if(isset($_POST['volumen'])){
								$volumen = $_POST['volumen'];
								} else
							{
								$volumen = ' ';
							}
							if(isset($_POST['tipo_volumen'])){
								$tipo_volumen = $_POST['tipo_volumen'];
							} 
							if(isset($_POST['grupo_medicamento'])){
								$grupo_medicamento = $_POST['grupo_medicamento'];
								} else {
								$grupo_medicamento = 8;
							}		
							if(isset($_POST['tipo_impuesto'])){
								$tipo_impuesto = $_POST['tipo_impuesto'];
							} else
							{
								$tipo_impuesto = 0;
							}
							
							if(isset($_POST['anaquel'])){
								$anaquel = $_POST['anaquel'];
							} else
							{
								$anaquel = 0;
							}
							
							if(isset($_POST['proveedor_principal'])){
								$proveedor_principal = $_POST['proveedor_principal'];
							} else
							{
								$proveedor_principal = 0;
							}
							
							if(isset($_POST['cant_max_prov'])){
								$cant_max_prov = $_POST['cant_max_prov'];
							} else
							{
								$cant_max_prov = 0;
							}
							
							if(isset($_POST['importacion'])){
								$importacion = $_POST['importacion'];
								} else {
								$importacion = 'N';
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
							
							
							
							$porcentaje_ganancia = medicamentos::porcentaje_ganancia($grupo_medicamento);	
							
							
							medicamentos::procesaInfo($_POST['contraindicacion'], $codigo_de_barra, $nombre_generico, $nombre_comercial, $forma_farmaceutica, $posologia, $tipo_posologia, $presentacion, $fabricante, $_SESSION['MM_user'], $cantidad_inicial, $antibiotico, $narcotico, $preparacion, $permite_devol, $otras_contra, $codigo_prov, $volumen, $tipo_volumen, $grupo_medicamento, $multiple_principio, $tipo_impuesto, $porcentaje_ganancia, $anaquel, $importacion, $jubilado, $descuento_total, $cant_max_prov, $codigo_de_barra, $proveedor_principal);
							
							
							
							echo "<font color='blue'><b>Se ha insertado el medicamento ".$nombre_comercial." con éxito</b></font>";
							
						} ?></td>
			</tr>
		</table>
		
	</form>
	
</div>
</font>


<div class="cleaner"></div>
</div>

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
		
		$("#fabricante").autocomplete({
			serviceUrl : 'get_fabricantes.php',
			paramName : 'q',
			onSelect: function (data) {			
			$("#fabricante_id").val(data.codigo_fabricante);
			}
		});
		
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