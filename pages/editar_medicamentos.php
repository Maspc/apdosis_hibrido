<?php
	ob_start();
	require_once('../modulos/editar_medicamentos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>
<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="2">&nbsp;</font></b><font face="Arial" size="2" color="#000000">
	
	<h2>Editar Medicamentos</h2>
	<div class="content_box_inner">								
		
		<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<table width="438" height="69" border="0" cellspacing="0">
				<tr>
					<td height="33">Medicamento </td>
					<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
				</tr>
				<tr>
					<td>Forma Farmaceutica</td>
					<td><label><input name="descri_forma" id="descri_forma" size="50" type="text"  readonly /> <input name="forma_farma" id="forma_farma" size="50" type="hidden"  readonly /></label></td>
				</tr>
				<tr>
					<td></td>
					<td><label>
						<input name="tipo_posologia" id="tipo_posologia" size="50" type="hidden" readonly />
						<input name="tipo_de_dosis" id="tipo_de_dosis" size="50" type="hidden" readonly />
						<input name="posologia" id="posologia" size="50" type="hidden" readonly />
						<input name="codigo_barras" id="codigo_barras" size="50" type="hidden" readonly />
						<input name="precio_unitario" id="precio_unitario" size="50" type="hidden" readonly />
						<input name="nombre_comercial" id="nombre_comercial" size="50" type="hidden" readonly />
						<input name="nombre_generico" id="nombre_generico" size="50" type="hidden" readonly />
						<input name="presentacion" id="presentacion" size="50" type="hidden" readonly />
						<input name="codigo_presentacion" id="codigo_presentacion" size="50" type="hidden" readonly />
						<input name="cantidad_x_empaque" id="cantidad_x_empaque" size="50" type="hidden" readonly />
						<input name="volumen" id="volumen" size="50" type="hidden" readonly />
						<input name="fabricante" id="fabricante" size="50" type="hidden" readonly />
						<input name="codigo_fabricante" id="codigo_fabricante" size="50" type="hidden" readonly />
						<input name="costo_unitario" id="costo_unitario" size="50" type="hidden" readonly />
						<input name="costo_caja" id="costo_caja" size="50" type="hidden" readonly />
						<input name="precio_caja" id="precio_caja" size="50" type="hidden" readonly />
						<input name="cantidad_inicial" id="cantidad_inicial" size="50" type="hidden" readonly />
						<input name="tipo_dosis" id="tipo_dosis" size="50" type="hidden" readonly />
						<input name="descr_tipo_dosis" id="descr_tipo_dosis" size="50" type="hidden" readonly />
						<input name="antibiotico" id="antibiotico" size="50" type="hidden" readonly />
						<input name="narcotico" id="narcotico" size="50" type="hidden" readonly />
						<input name="preparacion" id="preparacion" size="50" type="hidden" readonly />
						<input name="devolver" id="devolver" size="50" type="hidden" readonly />
					<input name="buscar" id="buscar"  type="submit" value="Modificar Medicamento" /></label></td>
				</tr>
			</table>
			
			<p><label>
				
			</label>
			</form>
			
			<?php
				if (isset($_POST['buscar'])){
					$medic = $_POST['medicamento'];
					$medicamento_id = $_POST['medicamento_id'];
					$descri_forma = $_POST['descri_forma'];
					$forma_farma = $_POST['forma_farma'];
					$precio_unitario = $_POST['precio_unitario'];
					$tipo_posologia = $_POST['tipo_posologia'];
					$tipo_de_dosis = $_POST['tipo_de_dosis'];
					$posologia = $_POST['posologia'];
					$codigo_barras = $_POST['codigo_barras'];
					$precio_unitario = $_POST['precio_unitario'];
					$nombre_comercial = $_POST['nombre_comercial'];
					$nombre_generico = $_POST['nombre_generico'];
					$presentacion = $_POST['presentacion'];
					$codigo_presentacion = $_POST['codigo_presentacion'];
					$cantidad_x_empaque = $_POST['cantidad_x_empaque'];
					$volumen = $_POST['volumen'];
					$fabricante = $_POST['fabricante'];
					$codigo_fabricante = $_POST['codigo_fabricante'];
					$costo_unitario = $_POST['costo_unitario'];
					$costo_caja = $_POST['costo_caja'];
					$precio_caja = $_POST['precio_caja'];
					$cantidad_inicial = $_POST['cantidad_inicial'];
					$tipo_dosis = $_POST['tipo_dosis'];
					$descr_tipo_dosis = $_POST['descr_tipo_dosis'];
					$antibiotico = $_POST['antibiotico'];
					$narcotico = $_POST['narcotico'];
					$preparacion = $_POST['preparacion'];
					$devolver = $_POST['devolver'];
					
					
					
					echo   "<form id='form1' name='form1' method='post' action='actualizar_med.php'><table width='600' height='69' border='0' cellspacing='0'>";
					echo "<tr>
					<td height='33'>Codigo de Barras </td>";
					echo "<td><label><input type='text' name='codigo_barras' id='codigo_barras' size='15' value='".$codigo_barras."' /><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /></label></td>
					</tr>";
					
					echo "<tr><td>Nombre Generico</td>
					<td><label><input name='nombre_generico' id='nombre_generico' size='50' type='text'  value='".$nombre_generico."' /></label></td>
					</tr>";
					echo "<tr><td>Nombre Comercial</td>
					<td><label><input name='nombre_comercial' id='nombre_comercial' size='50' type='text'  value='".$nombre_comercial."' /></label></td>
					</tr>";
					echo "<tr>
				<td>Forma Farmceutica</td>"; ?>
				<td><label><select name="forma_farmaceutica"> 
					
					<?php
						$ffarma = emedica::ffarma();
						foreach($ffarma as $ff){
							echo '<option '.(($ff->codigo_forma==$forma_farma)?'selected':'').' value="'.$ff->codigo_forma.'">'.$ff->descripcion.'</option>';
						}
					?> 
				</select></label></td>
				</tr> <?php
				
				
			echo "<tr><td>Posologia</td>";?>
			<td><input name='posologia' size='15' type='text'  value='<?php echo $posologia; ?>' /><label><select name="tipo_posologia"> 
				<?php
					$poso = emedica::posologia();
					foreach($poso as $ps){
						echo '<option '.(($ps->codigo_posologia==$tipo_posologia)?'selected':'').' value="'.$ps->codigo_posologia.'">'.$ps->descripcion.'</option>';
					}
				?> 
			</select></label></td>
			</tr> <?php 
		echo "<tr><td>Presentacion</td>";?>
		<td><label><select name="presentacion"> 
			<?php
				
				$presen = emedica::presenta();
				foreach($presen as $pr){
					echo '<option '.(($pr->codigo_presentacion==$codigo_presentacion)?'selected':'').' value="'.$pr->codigo_presentacion.'">'.$pr->descripcion.'</option>';
				}
			?> 
		</select></label></td>
		</tr> <?php "<tr><td>Cantidad por Empaque</td>
		<td><label><input name='cantidad_x_empaque' size='15' type='text'  value='".$cantidad_x_empaque."'/></label></td>
		</tr>";
		echo "<tr><td>Volumen</td>
		<td><label><input name='volumen' size='15' type='text'  value='".$volumen."' /></label></td>
		</tr>";
	echo "<tr><td>Fabricante</td>";?>
	<td><label><select name="fabricante"> 
		<?php
			$fabrica = emedica::fabricante();
			foreach($fabrica as $fb){
				echo '<option '.(($fb->codigo_fabricante==$codigo_fabricante)?'selected':'').' value="'.$fb->codigo_fabricante.'">'.$fb->descripcion.'</option>';
			}
		?> 
	</select></label></td>
	</tr> <?php 
	echo "<tr><td>Costo Unitario</td>
	<td><label><input name='costo_unitario' size='15' type='text'  value='".$costo_unitario."'  /></label></td>
	</tr>";
	echo "<tr><td>Precio Unitario</td>
	<td><label><input name='precio_unitario' size='15' type='text'  value='".$precio_unitario."'  /></label></td>
	</tr>";
	echo "<tr><td>Costo de Caja</td>
	<td><label><input name='costo_caja' size='15' type='text'  value='".$costo_caja."'/></label></td>
	</tr>";
	echo "<tr><td>Precio de Caja</td>
	<td><label><input name='precio_caja' size='15' type='text'  value='".$precio_caja."'  /></label></td>
	</tr>";
	echo "<tr><td>Cantidad Inicial</td>
	<td><label><input name='cantidad_inicial' size='15' type='text'  value='".$cantidad_inicial."'  /></label></td>
	</tr>";
echo "<tr><td>Tipo de Dosis</td>";?>
<td><label><select name="tipo_de_dosis"> 
	<?php
		$tdosis = emedica::tdosis();
		foreach($tdosis as $td){
			echo '<option '.(($td->codigo_tipo==$tipo_de_dosis)?'selected':'').' value="'.$td->codigo_tipo.'">'.$td->descripcion.'</option>';
		}
	?> 
</select></label></td>
</tr> <?php
echo "<tr><td>Antibiotico</td>
<td><label><input name='antibiotico' size='50' type='checkbox'   value='S' "; if ($antibiotico == 'S') {echo 'checked';}  echo "  /></label></td>
</tr>";
echo "<tr><td>Narcotico</td>
<td><label><input name='narcotico' size='50' type='checkbox'  value='S' "; if ($narcotico == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>Preparaci&oacute;n</td>
<td><label><input name='preparacion' size='50' type='checkbox'  value='S' "; if ($preparacion == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>¿No se puede devolver?</td>
<td><label><input name='devolver' size='50' type='checkbox'  value='S' "; if ($devolver == 'S') {echo 'checked';} echo "/></label></td>
</tr>";?>

<tr><td></td>
	<td><label><input type="button" name="actualizar_contra" value="Actualizar Contraindicaciones" id="actualizar_contra" onClick="javascript:popUp('actualizar_contra.php?codigo_de_barra=<?php echo $codigo_barras; ?>&men=0')" /></label></td>
</tr>
<tr><td></td>
	<td><label><input type="button" name="actualizar_prov" value="Actualizar Proveedores" id="actualizar_prov" onClick="javascript:popUp('actualizar_prov.php?codigo_de_barra=<?php echo $codigo_barras; ?>&men=0')" /></label></td>
</tr>
<tr><td></td>
	<td><label><input type="button" name="actualizar_bancos" value="Actualizar Bancos" id="actualizar_bancos" onClick="javascript:popUp('actualizar_bancos.php?codigo_de_barra=<?php echo $codigo_barras; ?>&men=0')" /></label></td>
	</tr><?php
	echo "<tr><td></td>
	<td><label><input name='actualizar' type='submit' value='Actualizar'/></label></td>
	</tr>";
	
	echo "</table>
	</form>";						
	
}

?>         

<div class="cleaner"></div>
</div>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript">
	function clearText(field)
	{
		if (field.defaultValue == field.value) field.value = '';
		else if (field.value == '') field.value = field.defaultValue;
	}
</script>

<script type="text/javascript">
	$().ready(function() {
		
		$("#form").validate();
		function log(event, data, formatted) {
			$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
		}
		
		function formatItem(row) {
			return row[0] + " (<strong>id: " + row[1] + "</strong>)";
		}
		function formatResult(row) {
			return row[0].replace(/(<.+?>)/gi, '');
		}
		
		
		$("#medicamento").autocomplete("get_medicamento_edit.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#medicamento").result(function(event, data, formatted) {
			$("#medicamento_id").val(data[1]);
			$("#forma_farma").val(data[2]);
			$("#tipo_posologia").val(data[3]);
			$("#tipo_de_dosis").val(data[4]);
			$("#descri_forma").val(data[5]);
			$("#posologia").val(data[6]);
			$("#codigo_barras").val(data[7]);
			$("#precio_unitario").val(data[8]);
			$("#nombre_comercial").val(data[9]);
			$("#nombre_generico").val(data[10]);
			$("#presentacion").val(data[11]);
			$("#codigo_presentacion").val(data[12]);
			$("#cantidad_x_empaque").val(data[13]);
			$("#volumen").val(data[14]);
			$("#fabricante").val(data[15]);
			$("#codigo_fabricante").val(data[16]);
			$("#costo_unitario").val(data[17]);
			$("#precio_unitario").val(data[18]);
			$("#costo_caja").val(data[19]);
			$("#precio_caja").val(data[20]);
			$("#cantidad_inicial").val(data[21]);
			$("#tipo_dosis").val(data[22]);
			$("#descr_tipo_dosis").val(data[23]);
			$("#antibiotico").val(data[24]);
			$("#narcotico").val(data[25]);
			$("#preparacion").val(data[26]);
			$("#devolver").val(data[27]);
			
		});
		
		$("#clear").click(function() {
			$(":input").unautocomplete();
		});
		
		
		
	});
	
	
</script>


<script type="text/javascript">
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=500');");
	}
</script>
<script language="javascript" type="text/javascript" src="../js/script_com_or.js"></script>
