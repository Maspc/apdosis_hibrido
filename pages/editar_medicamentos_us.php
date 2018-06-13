<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	require_once('../modulos/editar_medicamentos_us.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
?>	
<center>  <h1>Editar Medicamentos</h1> </center>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="438" height="69" border="0" cellspacing="0">
			<tr>
				<td height="33">Medicamento </td>
				<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
			</tr>
			<tr>
				<td>C&oacute;digo de Barras</td>
				<td><label><input name="codigo_barras" id="codigo_barras" size="50" type="text"  /><input name="descri_forma" id="descri_forma" size="50" type="hidden"  readonly /> <input name="forma_farma" id="forma_farma" size="50" type="hidden"  readonly /></label></td>
			</tr>
			<tr>
				<td></td>
				<td><label>
					<input name="tipo_posologia" id="tipo_posologia" size="50" type="hidden" readonly />
					<input name="tipo_de_dosis" id="tipo_de_dosis" size="50" type="hidden" readonly />
					<input name="posologia" id="posologia" size="50" type="hidden" readonly />
					
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
					<input name="codigo_proveedor" id="codigo_proveedor" size="50" type="hidden" readonly />
					<input name="tipo_volumen" id="tipo_volumen" size="50" type="hidden" readonly />
					<input name="grupo_medicamento" id="grupo_medicamento" size="50" type="hidden" readonly />
					<input name="multiple_principio" id="multiple_principio" size="50" type="hidden" readonly />
					<input name="tipo_impuesto" id="tipo_impuesto" size="50" type="hidden" readonly />
					<input name="precio_publico" id="precio_publico" size="50" type="hidden" readonly />
					<input name="importacion" id="importacion" size="50" type="hidden" readonly />
					<input name="jubilado" id="jubilado" size="50" type="hidden" readonly />
					<input name="descuento_total" id="descuento_total" size="50" type="hidden" readonly />
					<input name="cant_max_prov" id="cant_max_prov" size="50" type="hidden" readonly />
					<input name="anaquel" id="anaquel" size="50" type="hidden" readonly />
					
				<input name="buscar" id="buscar"  type="submit" value="Modificar Medicamento" /></label></td>
			</tr>
		</table>
		
		<p><label>
			
		</label>
		</form>
		
		<?php
			if (isset($_POST['buscar'])){
				if (!empty($_POST['medicamento'])) {
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
					$codigo_proveedor = $_POST['codigo_proveedor'];
					$tipo_volumen = $_POST['tipo_volumen'];
					$grupo_medicamento = $_POST['grupo_medicamento'];
					$multiple_principio = $_POST['multiple_principio'];
					$tipo_impuesto = $_POST['tipo_impuesto'];
					$precio_publico = $_POST['precio_publico'];
					$importacion = $_POST['importacion'];
					$jubilado = $_POST['jubilado'];
					$descuento_total = $_POST['descuento_total'];
					$cant_max_prov = $_POST['cant_max_prov'];
					$anaquel = $_POST['anaquel'];
					
					$cantidad_inicial_tienda = emedica::cant_ini($medicamento_id);
					
					} else {
					//si lo leo dsede el lector
					$drow = emedica::medicam($_POST['codigo_barras']);
					
					if (count($drow) > 0) {
						
						foreach($drow as $dr){
							$medic = $dr->nombre;
							$medicamento_id = $dr->codigo_interno;
							$descri_forma = $dr->forma_descri;
							$forma_farma = $dr->forma_farma;
							$precio_unitario = $dr->precio_unitario;
							$tipo_posologia = $dr->tipo_posologia;
							$tipo_de_dosis = $dr->tipo_de_dosis;
							$posologia = $dr->posologia;
							$codigo_barras = $dr->codigo_de_barra;
							$precio_unitario = $dr->precio_unitario;
							$nombre_comercial = $dr->nombre_comercial;
							$nombre_generico = $dr->nombre_generico;
							$presentacion = $dr->descr_presentacion;
							$codigo_presentacion = $dr->presentacion;
							$cantidad_x_empaque = $dr->cantidad_x_empaque;
							$volumen = $dr->volumen;
							$fabricante = $dr->descr_fabricante;
							$codigo_fabricante = $dr->fabricante;
							$costo_unitario = $dr->costo_unitario;
							$costo_caja = $dr->costo_caja;
							$precio_caja = $dr->precio_caja;
							$cantidad_inicial = $dr->cantidad_inicial;
							$tipo_dosis = $dr->tipo_de_dosis;
							$descr_tipo_dosis = $dr->descr_tipo_dosis;
							$antibiotico = $dr->antibiotico;
							$narcotico = $dr->narcotico;
							$preparacion = $dr->preparacion;
							$devolver = $dr->permite_devol;
							$codigo_proveedor = $dr->codigo_proveedor;
							$tipo_volumen = $dr->tipo_volumen;
							$grupo_medicamento = $dr->grupo_medicamento;
							$multiple_principio = $dr->multiple_principio;
							$tipo_impuesto = $dr->tipo_impuesto;
							$precio_publico = $dr->precio_publico;
							$importacion = $dr->importacion;
							$jubilado = $dr->jubilado;
							$descuento_total = $dr->descuento_total;
							$cant_max_prov = $dr->cant_max_prov;
							$anaquel =  $dr->anaquel;
							
							$cantidad_inicial_tienda = emedica::cant_ini($medicamento_id);
						}
						
						} else {
						
						$medic = ' ';
						$medicamento_id = ' ';
						$descri_forma = ' ';
						$forma_farma = ' ';
						$precio_unitario = ' ';
						$tipo_posologia = ' ';
						$tipo_de_dosis = ' ';
						$posologia = ' ';
						$codigo_barras = ' ';
						$precio_unitario = ' ';
						$nombre_comercial = ' ';
						$nombre_generico = ' ';
						$presentacion = ' ';
						$codigo_presentacion = ' ';
						$cantidad_x_empaque = ' ';
						$volumen = ' ';
						$fabricante = ' ';
						$codigo_fabricante = ' ';
						$costo_unitario = ' ';
						$costo_caja = ' ';
						$precio_caja = ' ';
						$cantidad_inicial = ' ';
						$tipo_dosis = ' ';
						$descr_tipo_dosis = ' ';
						$antibiotico = ' ';
						$narcotico = ' ';
						$preparacion = ' ';
						$devolver = ' ';
						$codigo_proveedor = ' ';
						$tipo_volumen = ' ';
						$grupo_medicamento = ' ';
						$multiple_principio = ' ';
						$tipo_impuesto = ' ';
						
						$precio_publico = ' ';
						$importacion = ' ';
						$jubilado = ' ';
						$cantidad_inicial_tienda = ' ';
						$descuento_total = ' ';
						$cant_max_prov = ' ';
						$anaquel = ' ';
					}
					
					
				}
				
				echo   "<form id='form1' name='form1' method='post' action='actualizar_med_us.php' onSubmit=\"popupform(this, 'join')\" >
				<table width='600' height='69' border='0' cellspacing='0'>";
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
				echo "<tr><td>Codigo Proveedor</td>
				<td><label><input name='codigo_proveedor' id='codigo_proveedor' size='50' type='text'  value='".$codigo_proveedor."' /></label></td>
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
			
			echo "<tr><td>Multiple Principio Activo</td>
			<td><label><input name='multiple_principio' size='50' type='checkbox'   value='S' "; if ($multiple_principio == 'S') {echo ' checked';}  echo "  /></label></td>
			</tr>";
		echo "<tr><td>Concentraci&oacute;n</td>";?>
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
	echo "<tr><td>Aplica Dect. Jubilado</td>
	<td><label><input name='jubilado' size='50' type='checkbox'   value='S' "; if ($jubilado == 'S') {echo 'checked';}  echo "  /></label></td>
	</tr>";
	echo "<tr><td>Aplica Dect. por Tipo de Cliente</td>
	<td><label><input name='descuento_total' size='50' type='checkbox'   value='S' "; if ($descuento_total == 'S') {echo 'checked';}  echo "  /></label></td>
	</tr>";
	
echo "<tr><td>Grupo de Medicamentos</td>";?>
<td><label><select name="grupo_medicamento"> 
	<?php 
		$gmedica = emedica::gmedica();
		foreach($gmedica as $gm){
			echo '<option '.(($gm->codigo_grupo==$grupo_medicamento)?'selected':'').' value="'.$gm->codigo_grupo.'">'.$gm->descripcion.'</option>';
		}
	?> 
</select></label></td>
</tr>


<?php
echo "<tr><td>Volumen</td>";?>
<td><input name='volumen' size='15' type='text'  value='<?php echo $volumen; ?>' /><label><select name="tipo_volumen"> 
	<?php 
		$tposo = emedica::posologia();
		foreach($tposo as $tps){
			echo '<option '.(($tps->codigo_posologia==$tipo_volumen)?'selected':'').' value="'.$tps->codigo_posologia.'">'.$tps->descripcion.'</option>';
		}
	?> 
</select></label></td>
</tr> <?php
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
/* echo "<tr><td>Costo Unitario</td>
	<td><label><input name='costo_unitario' size='15' type='text'  value='".$costo_unitario."' readonly  /></label></td>
</tr>"; */
echo "<tr><td>Precio Unitario</td>
<td><label><input name='precio_unitario' size='15' type='text'  value='".$precio_unitario."' readonly   /></label></td>
</tr>";

echo "<tr><td>Existencia Almacen</td>
<td><label><input name='cantidad_inicial_almacen' size='15' type='text'  value='".$cantidad_inicial."' readonly /></label></td>
</tr>"; 
echo "<tr><td>Existencia Tienda</td>
<td><label><input name='cantidad_inicial_tienda' size='15' type='text'  value='".$cantidad_inicial_tienda."' readonly /></label></td>
</tr>"; 

echo "<tr><td>Antibiotico</td>
<td><label><input name='antibiotico' size='50' type='checkbox'   value='S' "; if ($antibiotico == 'S') {echo 'checked';}  echo "  /></label></td>
</tr>";
echo "<tr><td>Narcotico</td>
<td><label><input name='narcotico' size='50' type='checkbox'  value='S' "; if ($narcotico == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>Importaci&oacute;n</td>
<td><label><input name='importacion' size='50' type='checkbox'  value='S' "; if ($importacion == 'S') {echo 'checked';} echo "/></label></td>
</tr>";

echo "<tr><td>¿No se puede devolver?</td>
<td><label><input name='devolver' size='50' type='checkbox'  value='S' "; if ($devolver == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>Cantidad M&iacute;nima para Proveedor Principal</td>
<td><label><input name='cant_max_prov' size='25' type='text' value='".$cant_max_prov."' /></label></td>
</tr>";
echo "<tr>
<td>Tipo de Impuesto</td>"; ?>
<td><label><select name="tipo_impuesto"> 
	<?php 
		$timpuesto = emedica::timpuesto();
		foreach($timpuesto as $tp){
			echo '<option '.(($tp->tipo_impuesto==$tipo_impuesto)?'selected':'').' value="'.$tp->tipo_impuesto.'">'.$tp->factor.'</option>';
		}
	?> 
</select></label></td>
</tr>

<tr>
	<td>Anaquel </td>
	<td><label><select name="anaquel"> 
		<?php 
			for ($i=1;$i<=25;$i++) {	  
				
				echo '<option value="'.$i.'" '.(($i==$anaquel)?'selected':'').'>'.$i.'</option>';
			} 
		?> 
	</select></label></td>
</tr> 

<tr><td></td>
	<td><label><input type="button" name="actualizar_contra" value="Actualizar Contraindicaciones" id="actualizar_contra" onClick="javascript:popUp('actualizar_contra.php?codigo_de_barra=<?php echo $codigo_barras; ?>&men=0')" /></label></td>
</tr>
<tr><td></td>
	<td><label><input type="button" name="actualizar_prov" value="Actualizar Proveedores" id="actualizar_prov" onClick="javascript:popUp('actualizar_prov.php?codigo_de_barra=<?php echo $medicamento_id; ?>&men=0')" /></label></td>
</tr>
<tr><td></td>
	<td><label><input type="button" name="lotes" value="Revisar Lotes" id="lotes" onClick="javascript:popUp('lotes_activos.php?medicamento_id=<?php echo $medicamento_id; ?>')" /></label></td>
</tr>
<?php
	echo "<tr><td></td>
	<td><label><input name='actualizar' type='submit' value='Actualizar' /></label></td>
	</tr>";
	
	echo "</table>
	</form>";
	
	
}

?>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript">
	function clearText(field)
	{
		if (field.defaultValue == field.value) field.value = '';
		else if (field.value == '') field.value = field.defaultValue;
	}
</script>

<script>
	function teclas(event) {
		tecla=(document.all) ? event.keyCode : event.which;
		
		if (tecla==13) {
			
			event.keyCode = 40; event.charCode = 40; event.which = 1199; break;
			
			return false;
		}
		
		return true;
	}
</script>


<script type="text/javascript">
	$(document).ready(function() {
		
		//$("#form").validate();
		function log(event, data, formatted) {
			$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
		}
		
		function formatItem(row) {
			return row[0] + " (<strong>id: " + row[1] + "</strong>)";
		}
		function formatResult(row) {
			return row[0].replace(/(<.+?>)/gi, '');
		}
		
		$("#medicamento").autocomplete({
			serviceUrl : 'get_medicamento_edit_us_con.php',
			paramName : 'q',
			onSelect: function (data) {			
			$("#medicamento_id").val(data.codigo_interno);
			$("#forma_farma").val(data.forma_farma);
			$("#tipo_posologia").val(data.tipo_posologia);
			$("#tipo_de_dosis").val(data.tipo_de_dosis);
			$("#descri_forma").val(data.forma_descri);
			$("#posologia").val(data.posologia);
			$("#codigo_barras").val(data.codigo_de_barra);
			$("#precio_unitario").val(data.precio_unitario);
			$("#nombre_comercial").val(data.nombre_comercial);
			$("#nombre_generico").val(data.nombre_generico);
			$("#presentacion").val(data.descr_presentacion);
			$("#codigo_presentacion").val(data.presentacion);
			$("#cantidad_x_empaque").val(data.cantidad_x_empaque);
			$("#volumen").val(data.volumen);
			$("#fabricante").val(data.descr_fabricante);
			$("#codigo_fabricante").val(data.fabricante);
			$("#costo_unitario").val(data.costo_unitario);
			$("#precio_unitario").val(data.precio_unitario);
			$("#costo_caja").val(data.costo_caja);
			$("#precio_caja").val(data.precio_caja);
			$("#cantidad_inicial").val(data.cantidad_inicial);
			$("#tipo_dosis").val(data.tipo_de_dosis);
			$("#descr_tipo_dosis").val(data.descr_tipo_dosis);
			$("#antibiotico").val(data.antibiotico);
			$("#narcotico").val(data.narcotico);
			$("#preparacion").val(data.preparacion);
			$("#devolver").val(data.permite_devol);
			$("#codigo_proveedor").val(data.codigo_proveedor);
			$("#tipo_volumen").val(data.tipo_volumen);
			$("#grupo_medicamento").val(data.grupo_medicamento);
			$("#multiple_principio").val(data.multiple_principio);
			$("#tipo_impuesto").val(data.tipo_impuesto);
			$("#precio_publico").val(data.precio_publico);
			$("#importacion").val(data.importacion);
			$("#jubilado").val(data.jubilado);
			$("#descuento_total").val(data.descuento_total)
			$("#anaquel").val(data.ubicacion);
			
			}
		});
		
		$("#codigo_barras").autocomplete({
			serviceUrl : 'get_barras_edit_us_con.php',
			paramName : 'q',
			onSelect: function (data) {			
			$("#medicamento_id").val(data.codigo_interno);
			$("#forma_farma").val(data.forma_farma);
			$("#tipo_posologia").val(data.tipo_posologia);
			$("#tipo_de_dosis").val(data.tipo_de_dosis);
			$("#descri_forma").val(data.forma_descri);
			$("#posologia").val(data.posologia);
			$("#medicamento").val(data.nombre);
			$("#precio_unitario").val(data.precio_unitario);
			$("#nombre_comercial").val(data.nombre_comercial);
			$("#nombre_generico").val(data.nombre_generico);
			$("#presentacion").val(data.descr_presentacion);
			$("#codigo_presentacion").val(data.presentacion);
			$("#cantidad_x_empaque").val(data.cantidad_x_empaque);
			$("#volumen").val(data.volumen);
			$("#fabricante").val(data.descr_fabricante);
			$("#codigo_fabricante").val(data.fabricante);
			$("#costo_unitario").val(data.costo_unitario);
			$("#precio_unitario").val(data.precio_unitario);
			$("#costo_caja").val(data.costo_caja);
			$("#precio_caja").val(data.precio_caja);
			$("#cantidad_inicial").val(data.cantidad_inicial);
			$("#tipo_dosis").val(data.tipo_de_dosis);
			$("#descr_tipo_dosis").val(data.descr_tipo_dosis);
			$("#antibiotico").val(data.antibiotico);
			$("#narcotico").val(data.narcotico);
			$("#preparacion").val(data.preparacion);
			$("#devolver").val(data.permite_devol);
			$("#codigo_proveedor").val(data.codigo_proveedor);
			$("#tipo_volumen").val(data.tipo_volumen);
			$("#grupo_medicamento").val(data.grupo_medicamento);
			$("#multiple_principio").val(data.multiple_principio);
			$("#tipo_impuesto").val(data.tipo_impuesto);
			$("#precio_publico").val(data.precio_publico);
			$("#importacion").val(data.importacion);
			$("#jubilado").val(data.jubilado);
			$("#descuento_total").val(data.descuento_total)
			$("#anaquel").val(data.ubicacion);
			
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
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
	}
	
	
	
	function popupform(myform, windowname)
	{
		
		if (! window.focus)return true;
		
		window.open('', windowname, 'width=500,height=200, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		myform.target=windowname;
		return true;
	}
	
	
	// End -->
</script>

<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:500px;dialogHeight:200px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
	</script>	