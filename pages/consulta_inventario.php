<?php
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/consulta_inventario.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
?>
<center>  <h1>Consultar y Actualizar Inventario</h1> </center>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table height="69" border="0" cellspacing="0">
			<tr>
				<td width="100">Anaquel</td>
				<td><label><select name="anaquel" id="anaquel"> <?php for ($i=0;$i<=25;$i++) {	  
				?>
				<option value="<? echo $i ?>"><? echo $i ?></option>
				<?php } ?> </select></label></td>
			</tr>
			<tr>
				<td width="100">Producto </td>
				<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
			</tr>
			<tr>
				<td width="100">C&oacute;digo de Barras</td>
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
					<input name="tipo_mercancia" id="tipo_mercancia" size="50" type="hidden" readonly />
				<input name="buscar" id="buscar"  type="submit" value="Consultar" /></label></td>
			</tr>
		</table>
		
		<p><label>
			
		</label>
		</form>
		
		<?php
			if (isset($_POST['buscar'])){
				if($_POST['anaquel'] != 0){
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
						$anaquel = $_POST['anaquel'];
						$tipomer = $_POST['tipomer'];
						
						
						$fres=consulta_inv::select1($medicamento_id);
						foreach($fres as $frow){				
							$cantidad_inicial_tienda = $frow->cantidad_inicial;
						}
						
						
						
						} else {
						//si lo leo dsede el lector
						
						
						$dres=consulta_inv::select2($_POST['codigo_barras']);		  
						foreach($dres as $drow){		
							
							
							$dnum = count($dres);
							
							if ($dnum > 0) {
								
								
								$medic = $drow->nombre;
								$medicamento_id = $drow->codigo_interno;
								$descri_forma = $drow->forma_descri;
								$forma_farma = $drow->forma_farma;
								$precio_unitario = $drow->precio_unitario;
								$tipo_posologia = $drow->tipo_posologia;
								$tipo_de_dosis = $drow->tipo_de_dosis;
								$posologia = $drow->posologia;
								$codigo_barras = $drow->codigo_de_barra;
								$precio_unitario = $drow->precio_unitario;
								$nombre_comercial = $drow->nombre_comercial;
								$nombre_generico = $drow->nombre_generico;
								$presentacion = $drow->descr_presentacion;
								$codigo_presentacion = $drow->presentacion;
								$cantidad_x_empaque = $drow->cantidad_x_empaque;
								$volumen = $drow->volumen;
								$fabricante = $drow->descr_fabricante;
								$codigo_fabricante = $drow->fabricante;
								$costo_unitario = $drow->costo_unitario;
								$costo_caja = $drow->costo_caja;
								$precio_caja = $drow->precio_caja;
								$cantidad_inicial = $drow->cantidad_inicial;
								$tipo_dosis = $drow->tipo_de_dosis;
								$descr_tipo_dosis = $drow->descr_tipo_dosis;
								$antibiotico = $drow->antibiotico;
								$narcotico = $drow->narcotico;
								$preparacion = $drow->preparacion;
								$devolver = $drow->permite_devol;
								$codigo_proveedor = $drow->codigo_proveedor;
								$tipo_volumen = $drow->tipo_volumen;
								$grupo_medicamento = $drow->grupo_medicamento;
								$multiple_principio = $drow->multiple_principio;
								$tipo_impuesto = $drow->tipo_impuesto;
								$precio_publico = $drow->precio_publico;
								$importacion = $drow->importacion;
								$anaquel = $drow->anaquel;
								$tipo_mercancia = $drow->tipo_mercancia;
								
								
								$fres=consulta_inv::select3($medicamento_id);	
								
								foreach($fres as $frow){
									
									$cantidad_inicial_tienda = $frow->cantidad_inicial;
								}
								
								
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
							$tipo_mercancia = ' ';
							
						}
						
						
					}
					
					
					
					
					
					echo   "<form id='form1' name='form1' method='post' action='actualizar_exist_us.php' onSubmit=\"popupform(this, 'join')\" >
					<table  border='0' cellspacing='0'>";
					echo "<tr>
					<td width='200'>Codigo de Barras </td>";
					echo "<td><label><input type='text' name='codigo_barras' id='codigo_barras' size='15' value='".$codigo_barras."' readonly /><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /></label></td>
					</tr>";
					
					echo "<tr><td width='200'>Nombre Producto</td>
					<td><label><input name='nombre' id='nombre' size='100' type='text'  value='".$medic."' readonly /></label></td>
					</tr>";
					if($tipo_mercancia == 1){
						$tipomer = 'MEDICAMENTO';
						} else {
						$tipomer = 'PRODUCTO';
					}
					
					echo "<tr><td width='200'>Tipo Producto</td>
					<td><label><input name='tipo_mercancia' id='tipo_mercancia' size='100' type='text'  value='".$tipomer."' readonly /></label></td>
					</tr>";
					
					echo "<tr><td width='200'>Existencia Sistema</td>
					<td><label><input name='cantidad_inicial_almacen' size='15' type='text'  value='".$cantidad_inicial."' readonly /></label></td>
					</tr>"; 
					echo "<tr><td width='200'>Existencia F&iacute;sica</td>
					<td><label><input name='cantidad_inicial_fisico' size='15' type='text'  value='".$cantidad_inicial."'  /></label></td>
					</tr>"; 
					echo "<tr><td width='200'>Anaquel</td>
					<td><label><input name='anaquel' size='15' type='text'  value='".$anaquel."' readonly /></label></td>
					</tr>"; 
					
					echo "</table>
					</form>";
					
					
				} else { echo "<P>DEBE ESCOGER UN ANAQUEL!"; } }
				
				layout::fin_content();
		?>         
		
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
			$().ready(function() {
				
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
						$("#precio_publico").val(data.precio_unitario_pub);
						$("#importacion").val(data.importacion);
						$("#jubilado").val('');
						$("#descuento_total").val('');
						$("#anaquel").val('');
						$("#tipo_mercancia").val(data.tipo_mercancia);
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
						$("#precio_publico").val(data.precio_unitario_pub);
						$("#importacion").val(data.importacion);
						$("#jubilado").val('');
						$("#descuento_total").val('');
						$("#anaquel").val('');
						$("#tipo_mercancia").val(data.tipo_mercancia);
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