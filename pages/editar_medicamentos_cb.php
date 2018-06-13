<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/editar_medicamentos_cb.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
?>
<center>  <h1>Imprimir C&oacute;digos de Barra</h1> </center>
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
						
					}
					
					
				}									
				
				echo   "<form id='form1' name='form1' method='post' action='imprimir_codigo.php' onSubmit=\"popupform(this, 'join')\" >
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
			
		echo "<tr><td>Concentraci&oacute;n</td>";?>
		<td><input name='posologia' size='15' type='text'  value='<?php echo $posologia; ?>' /><label><select name="tipo_posologia"> 
			<?php 
				$poso = emedica::posologia();
				foreach($poso as $ps){
					echo '<option '.(($ps->codigo_posologia==$tipo_posologia)?'selected':'').' value="'.$ps->codigo_posologia.'">'.$ps->descripcion.'</option>';
				}
			?> 
		</select></label></td>
	</tr>
	
	<?php
		echo "<tr><td></td>
		<td><label><input name='actualizar' type='submit' value='Imprimir Código' /></label></td>
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
			serviceUrl : 'get_medicamento_edit_us_cb.php',
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
			}
		});
		
		$("#codigo_barras").autocomplete({
			serviceUrl : 'get_barras_edit_us_cb.php',
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
<script language="javascript" type="text/javascript" src="../js/script_com_or.js"></script>